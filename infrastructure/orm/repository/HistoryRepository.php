<?php

declare(strict_types=1);

namespace app\infrastructure\orm\repository;

use app\domain\entity\Call;
use app\domain\entity\Customer;
use app\domain\entity\Event;
use app\domain\entity\Sms;
use app\domain\entity\Task;
use app\domain\entity\User;
use app\domain\HistoryBuilderInterface;
use app\domain\HistoryRepositoryInterface;
use app\infrastructure\orm\models\History;

class HistoryRepository implements HistoryRepositoryInterface
{
    /**
     * @var HistoryBuilderInterface
     */
    private $historyBuilder;

    public function __construct(HistoryBuilderInterface $historyBuilder)
    {
        $this->historyBuilder = $historyBuilder;
    }

    public function findByFilter(array $filter = []): \Generator
    {
        $query = History::find();
        $query->addSelect('history.*');
        $query->with(['customer', 'user', 'sms', 'task', 'call', 'fax']);

        if (!empty($filter)) {
            $query->where($filter);
        }

        /** @var History $history */
        foreach ($query->each() as $history) {
            $this->historyBuilder
                ->addSms(
                    new Sms(
                        (bool)$history->sms,
                        $history->sms->message ?? null,
                        $history->sms->direction ?? null,
                        $history->sms->phone_from ?? '',
                        $history->sms->phone_to ?? ''
                    )
                )
                ->addEvent(new Event($history->event))
                ->addCall((function (History $history): Call {
                    $call = $history->call;

                    return $call
                        ? new Call(
                            true,
                            $call->totalStatusText ?? '',
                            $call->getTotalDisposition(false),
                            $call->comment,
                            $call->applicant ?? ''
                        )
                        : new Call(false);
                })($history))
                ->addCustomer(new Customer())
                ->addTask(new Task($history->task->title ?? null))
                ->addInsTs($history->ins_ts)
                ->addUser(new User($history->user->username ?? ''));

            yield $this->historyBuilder->build();
        }
    }
}
