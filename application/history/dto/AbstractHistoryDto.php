<?php

declare(strict_types=1);

namespace app\application\history\dto;

abstract class AbstractHistoryDto
{
    public abstract function getTemplate(): string;

    public abstract function getTemplateData(): array;
}
