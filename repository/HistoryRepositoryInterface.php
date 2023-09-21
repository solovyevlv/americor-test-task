<?php

namespace app\repository;

use yii\data\DataProviderInterface;

interface HistoryRepositoryInterface
{
    public function findByFilter(array $filter = []): DataProviderInterface;
}
