<?php

declare(strict_types=1);

namespace app\application\history\dto;

final class SmsHistoryDto extends AbstractHistoryDto
{
    /**
     * @var string|null
     */
    private $userName;
    /**
     * @var string|null
     */
    private $body;

    /**
     * @var string|null
     */
    private $footerText;
    /**
     * @var bool
     */
    private $isIncome;
    /**
     * @var string|null
     */
    private $footerDatetime;
    /**
     * @var string|null
     */
    private $phoneFrom;
    /**
     * @var string|null
     */
    private $phoneTo;

    public function __construct(
        ?string $userName = '',
        ?string $body = '',
        bool    $isIncome = false,
        ?string $footerDatetime = '',
        ?string $phoneFrom = '',
        ?string $phoneTo = ''
    ) {
        $this->userName = $userName;
        $this->body = $body;
        $this->isIncome = $isIncome;
        $this->footerDatetime = $footerDatetime;
        $this->phoneFrom = $phoneFrom;
        $this->phoneTo = $phoneTo;
    }

    public function getFooter(): string
    {
        return $this->isIncome
            ? sprintf('Incoming message from %s', $this->phoneFrom)
            : sprintf('Sent message to %s', $this->phoneTo);
    }

    public function getTemplate(): string
    {
        return '_item_common';
    }

    public function getTemplateData(): array
    {
        return [
            'userName' => $this->userName,
            'body' => $this->body, //HistoryListHelper::getBodyByModel($model),
            'footer' => $this->getFooter(),
            'iconIncome' => $this->isIncome,
            'footerDatetime' => $this->footerDatetime,
            'iconClass' => 'icon-sms bg-dark-blue'
        ];
    }
}
