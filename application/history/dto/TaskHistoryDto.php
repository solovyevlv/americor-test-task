<?php

declare(strict_types=1);

namespace app\application\history\dto;

final class TaskHistoryDto extends AbstractHistoryDto
{
    public function getTemplate(): string
    {
        return '_item_call';
    }

    public function getTemplateData(): array
    {
        return [];
    }
}
