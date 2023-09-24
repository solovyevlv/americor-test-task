<?php

declare(strict_types=1);

namespace app\application\history\dto;

final class CallHistoryDto extends AbstractHistoryDto
{
    /**
     * @var string|null
     */
    private $userName;
    /**
     * @var string|null
     */
    private $content;

    /**
     * @var  string
     */
    private $footerDatetime;

    /**
     * @var  string
     */
    private $bodyDatetime;

    /**
     * @var  string
     */
    private $totalDisposition;

    /**
     * @var  string
     */
    private $totalStatusText;

    /**
     * @var  bool
     */
    private $isCall;

    /**
     * @var  bool
     */
    private $isFooter;

    /**
     * @var  bool
     */
    private $isAnswered;

    /**
     * @var  string
     */
    private $applicantName;

    public function __construct(
        ?string $footerDatetime,
        ?string $bodyDatetime,
        ?string $totalDisposition,
        ?string $totalStatusText,
        bool    $isCall,
        bool    $isFooter,
        bool    $isAnswered,
        ?string $applicantName,
        ?string $userName,
        ?string $content
    )
    {
        $this->footerDatetime = $footerDatetime;
        $this->bodyDatetime = $bodyDatetime;
        $this->totalDisposition = $totalDisposition;
        $this->totalStatusText = $totalStatusText;
        $this->isCall = $isCall;
        $this->isFooter = $isFooter;
        $this->isAnswered = $isAnswered;
        $this->applicantName = $applicantName;
        $this->userName = $userName;
        $this->content = $content;
    }

    public function getTemplate(): string
    {
        return '_item_call';
    }

    public function getTemplateData(): array
    {
        return [
            'userName' => $this->userName,
            'footerDatetime' => $this->footerDatetime,
            'bodyDatetime' => $this->bodyDatetime,
            'totalDisposition' => $this->totalDisposition,
            'totalStatusText' => $this->totalStatusText,
            'isCall' => $this->isCall,
            //'isFooter' => $this->applicantName ? "Called <span>{$call->applicant->name}</span>" : null,
            'isAnswered' => $this->isAnswered,
            'applicantName' => $this->applicantName,
            'content' => $this->content,
        ];
    }
}
