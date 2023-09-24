<?php

namespace app\domain;

use app\domain\entity\History;

interface HistoryRepositoryInterface
{
    /**
     * @param array $filter
     * @return \Generator<History>
     */
    public function findByFilter(array $filter = []): \Generator;
}
