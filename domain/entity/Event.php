<?php

declare(strict_types=1);

namespace app\domain\entity;

class Event
{
    const EVENT_CREATED_TASK = 'created_task';
    const EVENT_UPDATED_TASK = 'updated_task';
    const EVENT_COMPLETED_TASK = 'completed_task';
    const EVENT_INCOMING_SMS = 'incoming_sms';
    const EVENT_OUTGOING_SMS = 'outgoing_sms';
    const EVENT_INCOMING_CALL = 'incoming_call';
    const EVENT_OUTGOING_CALL = 'outgoing_call';
    const EVENT_INCOMING_FAX = 'incoming_fax';
    const EVENT_OUTGOING_FAX = 'outgoing_fax';
    const EVENT_CUSTOMER_CHANGE_TYPE = 'customer_change_type';
    const EVENT_CUSTOMER_CHANGE_QUALITY = 'customer_change_quality';
    const EVENT_DEFAULT = 'default';
    /**
     * @var string
     */
    private $type;

    private $eventTexts = [
        self::EVENT_CREATED_TASK => 'Task created',
        self::EVENT_UPDATED_TASK => 'Task updated',
        self::EVENT_COMPLETED_TASK => 'Task completed',

        self::EVENT_INCOMING_SMS => 'Incoming message',
        self::EVENT_OUTGOING_SMS => 'Outgoing message',

        self::EVENT_CUSTOMER_CHANGE_TYPE => 'Type changed',
        self::EVENT_CUSTOMER_CHANGE_QUALITY => 'Property changed',

        self::EVENT_OUTGOING_CALL => 'Outgoing call',
        self::EVENT_INCOMING_CALL => 'Incoming call',

        self::EVENT_INCOMING_FAX => 'Incoming fax',
        self::EVENT_OUTGOING_FAX => 'Outgoing fax',
        self::EVENT_DEFAULT => ''
    ];

    public function __construct(?string $type = self::EVENT_DEFAULT)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type ?? self::EVENT_DEFAULT;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->eventTexts[$this->getType()];
    }
}
