<?php

declare(strict_types=1);

namespace app\domain\entity;

class Task
{
    /**
     * @var string
     */
    private $title;

    public function __construct(?string $title = '')
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

}
