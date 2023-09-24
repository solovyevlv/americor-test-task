<?php

namespace app\application\history\service;

use yii\data\DataProviderInterface;

interface HistoryServiceInterface
{
    public function findByFilter(array $filter = []): DataProviderInterface;
}
