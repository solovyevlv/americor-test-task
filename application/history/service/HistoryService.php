<?php

declare(strict_types=1);

namespace app\application\history\service;

use app\application\history\dto\AbstractHistoryDto;
use app\application\history\dto\CallHistoryDto;
use app\application\history\dto\CustomerChangeQualityHistoryDto;
use app\application\history\dto\CustomerChangeTypeHistoryDto;
use app\application\history\dto\HistoryDto;
use app\application\history\dto\SmsHistoryDto;
use app\application\history\dto\TaskHistoryDto;
use app\domain\entity\Event;
use app\domain\entity\History;
use app\domain\entity\Sms;
use app\domain\HistoryRepositoryInterface;
use yii\data\ArrayDataProvider;
use yii\data\DataProviderInterface;

class HistoryService implements HistoryServiceInterface
{
    /**
     * @var HistoryRepositoryInterface
     */
    private $historyRepository;

    public function __construct(HistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function findByFilter(array $filter = []): DataProviderInterface
    {
        $models = [];

        foreach ($this->historyRepository->findByFilter($filter) as $history) {
            $models[] = HistoryDtoFactory::createDtoByHistory($history);
        }

        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [],
            ],
        ]);
    }


}


