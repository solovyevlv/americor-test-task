<?php

declare(strict_types=1);

namespace app\application\history\dto;

final class CustomerChangeQualityHistoryDto extends AbstractHistoryDto
{
    public function getTemplate(): string
    {
        return '_item_statuses_change';
    }

    public function getTemplateData(): array
    {
        return [];
    }
}
