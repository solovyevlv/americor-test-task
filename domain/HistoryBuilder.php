<?php

declare(strict_types=1);

namespace app\domain;

use app\domain\entity\Call;
use app\domain\entity\Customer;
use app\domain\entity\Event;
use app\domain\entity\History;
use app\domain\entity\Sms;
use app\domain\entity\Task;
use app\domain\entity\User;

class HistoryBuilder implements HistoryBuilderInterface
{
    /**
     * @var Sms|null
     */
    private $sms;

    /**
     * @var Call
     */
    private $call;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Task
     */
    private $task;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var string
     */
    private $ts;

    public function addCall(Call $call): HistoryBuilderInterface
    {
        $this->call = $call;

        return $this;
    }

    public function addCustomer(Customer $customer): HistoryBuilderInterface
    {
        $this->customer = $customer;

        return $this;
    }

    public function addUser(User $user): HistoryBuilderInterface
    {
        $this->user = $user;

        return $this;
    }

    public function addTask(Task $task): HistoryBuilderInterface
    {
        $this->task = $task;

        return $this;
    }

    public function addSms(Sms $sms): HistoryBuilderInterface
    {
        $this->sms = $sms;

        return $this;
    }

    public function addEvent(Event $event): HistoryBuilderInterface
    {
        $this->event = $event;

        return $this;
    }

    public function addInsTs(?string $ts = ''): HistoryBuilderInterface
    {
        $this->ts = $ts;

        return $this;
    }
    public function build(): History
    {
        return new History($this->user, $this->task, $this->sms, $this->customer, $this->call, $this->event, $this->ts);
    }
}
