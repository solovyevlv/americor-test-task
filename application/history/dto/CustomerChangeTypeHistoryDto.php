<?php

declare(strict_types=1);

namespace app\application\history\dto;

final class CustomerChangeTypeHistoryDto extends AbstractHistoryDto
{
    public function getTemplate(): string
    {
        return '_item_statuses_change';
    }

    public function getTemplateData(): array
    {
        return [];
    }

    public function getMessage(): string
    {
        // TODO: Implement getMessage() method.
    }
}
