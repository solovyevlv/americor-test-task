<?php

declare(strict_types=1);

namespace app\domain\entity;

class History
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Task
     */
    private $task;
    /**
     * @var Sms
     */
    private $sms;
    /**
     * @var Customer
     */
    private $customer;
    /**
     * @var Call
     */
    private $call;

    /**
     * @var Event
     */
    private $event;
    /**
     * @var string|null
     */
    private $insTs;

    public function __construct(
        User     $user,
        Task     $task,
        Sms      $sms,
        Customer $customer,
        Call     $call,
        Event    $event,
        ?string  $insTs = ''
    ) {
        $this->user = $user;
        $this->task = $task;
        $this->sms = $sms;
        $this->customer = $customer;
        $this->call = $call;
        $this->event = $event;
        $this->insTs = $insTs;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function getSms(): Sms
    {
        return $this->sms;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getCall(): Call
    {
        return $this->call;
    }

    public function getInsTs(): ?string
    {
        return $this->insTs;
    }

//    public function getMessage(): string
//    {
//        switch ($this->event->getType()) {
//            case Event::EVENT_CREATED_TASK:
//            case Event::EVENT_COMPLETED_TASK:
//            case Event::EVENT_UPDATED_TASK:
//                return sprintf('%s : %s', $this->event->getText(), $this->task->getTitle());
//            case Event::EVENT_INCOMING_SMS:
//            case Event::EVENT_OUTGOING_SMS:
//                return $this->sms->getMessage();
//            case Event::EVENT_CUSTOMER_CHANGE_TYPE:
//                return $this->event->getText() .
//                    (Customer::getTypeTextByType($this->getDetailOldValue('type')) ?? "not set") . ' to ' .
//                    (Customer::getTypeTextByType($this->getDetailNewValue('type')) ?? "not set");
//            case Event::EVENT_CUSTOMER_CHANGE_QUALITY:
//                return $this->event->getText() .
//                    (Customer::getQualityTextByQuality($this->getDetailOldValue('quality')) ?? "not set") . ' to ' .
//                    (Customer::getQualityTextByQuality($this->getDetailNewValue('quality')) ?? "not set");
//            case Event::EVENT_INCOMING_CALL:
//            case Event::EVENT_OUTGOING_CALL:
//                $totalDisposition = $this->call && $this->call->getTotalDisposition(false)
//                    ? sprintf("<span class='text-grey'>%s</span>", $this->call->getTotalDisposition(false))
//                    : '';
//                return $this->call
//                    ? sprintf('%s %s', $this->call->totalStatusText, $totalDisposition)
//                    : '<i>Deleted</i>';
//            default:
//                return $this->event->getText();
//        }
//    }
}
