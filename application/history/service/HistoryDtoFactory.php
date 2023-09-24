<?php

declare(strict_types=1);

namespace app\application\history\service;

use app\application\history\dto\AbstractHistoryDto;
use app\application\history\dto\CallHistoryDto;
use app\application\history\dto\CustomerChangeQualityHistoryDto;
use app\application\history\dto\CustomerChangeTypeHistoryDto;
use app\application\history\dto\HistoryDto;
use app\application\history\dto\SmsHistoryDto;
use app\application\history\dto\TaskHistoryDto;
use app\domain\entity\Event;
use app\domain\entity\History;

class HistoryDtoFactory
{
    public static function createDtoByHistory(History $history): AbstractHistoryDto
    {
        switch ($history->getEvent()->getType()) {
            case Event::EVENT_CREATED_TASK:
            case Event::EVENT_COMPLETED_TASK:
            case Event::EVENT_UPDATED_TASK:
                return new TaskHistoryDto();
            case Event::EVENT_INCOMING_SMS:
            case Event::EVENT_OUTGOING_SMS:
                return self::createSmsHistoryDto($history);
            case Event::EVENT_CUSTOMER_CHANGE_TYPE:
                return new CustomerChangeTypeHistoryDto();
            case Event::EVENT_CUSTOMER_CHANGE_QUALITY:
                return new CustomerChangeQualityHistoryDto();
            case Event::EVENT_INCOMING_CALL:
            case Event::EVENT_OUTGOING_CALL:
                return self::createCallHistoryDto($history);
            default:
                return new HistoryDto();
        }
    }

    public static function createSmsHistoryDto(History $history): SmsHistoryDto
    {
        return new SmsHistoryDto(
            $history->getUser()->getName(),
            $history->getSms()->getMessage(),
            $history->getSms()->isIncoming(),
            $history->getInsTs(),
            $history->getSms()->getPhoneFrom(),
            $history->getSms()->getPhoneTo()
        );
    }

    public static function createCallHistoryDto(History $history): CallHistoryDto
    {
        return new CallHistoryDto(
            $history->getInsTs(),
            '',
            $history->getCall()->getTotalDisposition(),
            $history->getCall()->getTotalStatusText(),
            $history->getCall()->isCall(),
            (bool)$history->getCall()->getApplicant(),
            $history->getCall()->isAnswered(),
            $history->getCall()->getApplicant(),
            $history->getUser()->getName(),
            $history->getCall()->getContent()
        );
    }
}
