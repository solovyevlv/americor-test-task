<?php

declare(strict_types=1);

namespace app\domain\entity;

class Call
{
    const STATUS_NO_ANSWERED = 0;
    const STATUS_ANSWERED = 1;

    const DIRECTION_INCOMING = 0;
    const DIRECTION_OUTGOING = 1;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $applicant;

    /**
     * @var int|null
     */
    private $status;

    /**
     * @var bool
     */
    private $isCall;
    /**
     * @var string
     */
    private $totalStatusText;
    /**
     * @var string|null
     */
    private $totalDisposition;

    public function __construct(
        bool $isCall = false,
        ?string $totalStatusText = '',
        ?string $totalDisposition = '',
        ?string $content = '',
        string $applicant = '',
        ?int $status = null
    ) {
        $this->content = $content;
        $this->applicant = $applicant;
        $this->status = $status;
        $this->isCall = $isCall;
        $this->totalStatusText = $totalStatusText;
        $this->totalDisposition = $totalDisposition;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getApplicant(): string
    {
        return $this->applicant;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function isAnswered(): bool
    {
        return $this->status === self::STATUS_ANSWERED;
    }

    public function isCall(): bool
    {
        return $this->isCall;
    }

    public function getTotalStatusText(): ?string
    {
        return $this->totalStatusText;
    }

    public function getTotalDisposition(): ?string
    {
        return $this->totalDisposition;
    }
}
