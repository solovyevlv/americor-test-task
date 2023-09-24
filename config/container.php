<?php

use app\application\history\service\HistoryService;
use app\application\history\service\HistoryServiceInterface;
use app\domain\HistoryBuilder;
use app\domain\HistoryBuilderInterface;
use app\domain\HistoryRepositoryInterface;
use app\infrastructure\orm\repository\HistoryRepository;

return [
    'singletons' => [
        HistoryRepositoryInterface::class => HistoryRepository::class,
        HistoryServiceInterface::class => HistoryService::class,
        HistoryBuilderInterface::class => HistoryBuilder::class
    ]
];
