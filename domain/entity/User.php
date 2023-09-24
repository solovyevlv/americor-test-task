<?php

declare(strict_types=1);

namespace app\domain\entity;

class User
{
    /**
     * @var string|null
     */
    private $name;

    public function __construct(?string $name = '')
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
