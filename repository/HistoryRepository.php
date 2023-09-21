<?php

declare(strict_types=1);

namespace app\repository;

use app\models\History;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class HistoryRepository implements HistoryRepositoryInterface
{
    public function findByFilter(array $filter = []): DataProviderInterface
    {
        $query = History::find();
        $query->addSelect('history.*');
        $query->with(['customer', 'user', 'sms', 'task', 'call', 'fax']);

        if (!empty($filter)) {
            $query->where($filter);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'ins_ts' => SORT_DESC,
                'id' => SORT_DESC
            ],
        ]);

        return $dataProvider;
    }
}
