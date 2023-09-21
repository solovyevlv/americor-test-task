<?php

use app\repository\HistoryRepository;
use app\repository\HistoryRepositoryInterface;

return [
    'singletons' => [
        HistoryRepositoryInterface::class => HistoryRepository::class
    ]
];
