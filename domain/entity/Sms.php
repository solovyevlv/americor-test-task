<?php

declare(strict_types=1);

namespace app\domain\entity;

class Sms
{
    const DIRECTION_INCOMING = 0;
    const DIRECTION_OUTGOING = 1;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var string|null
     */
    private $direction;
    /**
     * @var string
     */
    private $phoneFrom;
    /**
     * @var string
     */
    private $phoneTo;

    /**
     * @var bool
     */
    private $isSms;

    public function __construct(bool $isSms = false, ?string $message = '', ?int $direction = null, string $phoneFrom = '', string $phoneTo = '')
    {
        $this->message = $message;
        $this->direction = $direction;
        $this->phoneFrom = $phoneFrom;
        $this->phoneTo = $phoneTo;
        $this->isSms = $isSms;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getDirection(): ?int
    {
        return $this->direction;
    }

    public function getPhoneFrom(): string
    {
        return $this->phoneFrom;
    }

    public function getPhoneTo(): string
    {
        return $this->phoneTo;
    }

    public function isIncoming(): bool
    {
        return $this->direction === self::DIRECTION_INCOMING;
    }

    public function isSms(): bool
    {
        return $this->isSms;
    }
}
