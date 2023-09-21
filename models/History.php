<?php

namespace app\models;

use app\models\traits\ObjectNameTrait;
use app\widgets\HistoryList\helpers\HistoryListHelper;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%history}}".
 *
 * @property integer $id
 * @property string $ins_ts
 * @property integer $customer_id
 * @property string $event
 * @property string $object
 * @property integer $object_id
 * @property string $message
 * @property string $detail
 * @property integer $user_id
 *
 * @property string $eventText
 *
 * @property Customer $customer
 * @property User $user
 *
 * @property Task $task
 * @property Sms $sms
 * @property Call $call
 */
class History extends ActiveRecord
{
    use ObjectNameTrait;

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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%history}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ins_ts'], 'safe'],
            [['customer_id', 'object_id', 'user_id'], 'integer'],
            [['event'], 'required'],
            [['message', 'detail'], 'string'],
            [['event', 'object'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ins_ts' => Yii::t('app', 'Ins Ts'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'event' => Yii::t('app', 'Event'),
            'object' => Yii::t('app', 'Object'),
            'object_id' => Yii::t('app', 'Object ID'),
            'message' => Yii::t('app', 'Message'),
            'detail' => Yii::t('app', 'Detail'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    public function getCustomer(): ActiveQuery
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getEventTexts(): array
    {
        return [
            self::EVENT_CREATED_TASK => Yii::t('app', 'Task created'),
            self::EVENT_UPDATED_TASK => Yii::t('app', 'Task updated'),
            self::EVENT_COMPLETED_TASK => Yii::t('app', 'Task completed'),

            self::EVENT_INCOMING_SMS => Yii::t('app', 'Incoming message'),
            self::EVENT_OUTGOING_SMS => Yii::t('app', 'Outgoing message'),

            self::EVENT_CUSTOMER_CHANGE_TYPE => Yii::t('app', 'Type changed'),
            self::EVENT_CUSTOMER_CHANGE_QUALITY => Yii::t('app', 'Property changed'),

            self::EVENT_OUTGOING_CALL => Yii::t('app', 'Outgoing call'),
            self::EVENT_INCOMING_CALL => Yii::t('app', 'Incoming call'),

            self::EVENT_INCOMING_FAX => Yii::t('app', 'Incoming fax'),
            self::EVENT_OUTGOING_FAX => Yii::t('app', 'Outgoing fax'),
        ];
    }

    /**
     * @param $event
     * @return mixed
     */
    public static function getEventTextByEvent($event)
    {
        return static::getEventTexts()[$event] ?? $event;
    }

    /**
     * @return mixed|string
     */
    public function getEventText()
    {
        return static::getEventTextByEvent($this->event);
    }

    /**
     * @return null|mixed
     */
    public function getDetailChangedAttribute(string $attribute)
    {
        $detail = json_decode($this->detail);
        return $detail->changedAttributes->{$attribute} ?? null;
    }

    public function getDetailOldValue(string $attribute): ?string
    {
        $detail = $this->getDetailChangedAttribute($attribute);
        return (string)$detail->old ?? null;
    }

    public function getDetailNewValue(string $attribute): ?string
    {
        $detail = $this->getDetailChangedAttribute($attribute);
        return (string)$detail->new ?? null;
    }

    public function getDetailData(string $attribute): ?string
    {
        $detail = json_decode($this->detail);
        return (string)$detail->data->{$attribute} ?? null;
    }

    public function getUsername(): string
    {
        return isset($this->user) ? $this->user->username : Yii::t('app', 'System');
    }

    public function getFullMessage(): string
    {
        switch ($this->event) {
            case History::EVENT_CREATED_TASK:
            case History::EVENT_COMPLETED_TASK:
            case History::EVENT_UPDATED_TASK:
                return "$this->eventText: " . ($this->task->title ?? '');
            case History::EVENT_INCOMING_SMS:
            case History::EVENT_OUTGOING_SMS:
                return $this->sms->message ? $this->sms->message : '';
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return "$this->eventText " .
                    (Customer::getTypeTextByType($this->getDetailOldValue('type')) ?? "not set") . ' to ' .
                    (Customer::getTypeTextByType($this->getDetailNewValue('type')) ?? "not set");
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return "$this->eventText " .
                    (Customer::getQualityTextByQuality($this->getDetailOldValue('quality')) ?? "not set") . ' to ' .
                    (Customer::getQualityTextByQuality($this->getDetailNewValue('quality')) ?? "not set");
            case History::EVENT_INCOMING_CALL:
            case History::EVENT_OUTGOING_CALL:
                $totalDisposition = $this->call && $this->call->getTotalDisposition(false)
                    ? sprintf("<span class='text-grey'>%s</span>", $this->call->getTotalDisposition(false))
                    : '';
                return $this->call
                    ? sprintf('%s %s', $this->call->totalStatusText, $totalDisposition)
                    : '<i>Deleted</i>';
            default:
                return $this->eventText;
        }
    }

    public function getRowTemplate(): string
    {
        switch ($this->event) {
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return '_item_statuses_change';
            default:
                return '_item_common';
        }
    }

    public function getRowTemplateData(): array
    {
        switch ($this->event) {
            case History::EVENT_CREATED_TASK:
            case History::EVENT_COMPLETED_TASK:
            case History::EVENT_UPDATED_TASK:
                $task = $this->task;

                return [
                    'user' => $this->user,
                    'body' => $this->getFullMessage(),
                    'iconClass' => 'fa-check-square bg-yellow',
                    'footerDatetime' => $this->ins_ts,
                    'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
                ];
            case History::EVENT_INCOMING_SMS:
            case History::EVENT_OUTGOING_SMS:
                return [
                    'user' => $this->user,
                    'body' => $this->getFullMessage(),
                    'footer' => $this->sms->direction == Sms::DIRECTION_INCOMING ?
                        Yii::t('app', 'Incoming message from {number}', [
                            'number' => $this->sms->phone_from ?? ''
                        ]) : Yii::t('app', 'Sent message to {number}', [
                            'number' => $this->sms->phone_to ?? ''
                        ]),
                    'iconIncome' => $this->sms->direction == Sms::DIRECTION_INCOMING,
                    'footerDatetime' => $this->ins_ts,
                    'iconClass' => 'icon-sms bg-dark-blue'
                ];
            case History::EVENT_OUTGOING_FAX:
            case History::EVENT_INCOMING_FAX:
                $fax = $this->fax;

                return [
                    'user' => $this->user,
                    'body' => $this->getFullMessage() .
                        ' - ' .
                        (isset($fax->document) ? Html::a(
                            Yii::t('app', 'view document'),
                            $fax->document->getViewUrl(),
                            [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]
                        ) : ''),
                    'footer' => Yii::t('app', '{type} was sent to {group}', [
                        'type' => $fax ? $fax->getTypeText() : 'Fax',
                        'group' => isset($fax->creditorGroup) ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
                    ]),
                    'footerDatetime' => $this->ins_ts,
                    'iconClass' => 'fa-fax bg-green'
                ];
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return [
                    'model' => $this,
                    'oldValue' => Customer::getQualityTextByQuality($this->getDetailOldValue('quality')),
                    'newValue' => Customer::getQualityTextByQuality($this->getDetailNewValue('quality')),
                ];
            case History::EVENT_INCOMING_CALL:
            case History::EVENT_OUTGOING_CALL:
                $call = $this->call;
                $answered = $call && $call->status == Call::STATUS_ANSWERED;

                return [
                    'user' => $this->user,
                    'content' => $call->comment ?? '',
                    'body' => $this->getFullMessage(),
                    'footerDatetime' => $this->ins_ts,
                    'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
                    'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
                    'iconIncome' => $answered && $call->direction == Call::DIRECTION_INCOMING
                ];
            default:
                return [
                    'user' => $this->user,
                    'body' => $this->getFullMessage(),
                    'bodyDatetime' => $this->ins_ts,
                    'iconClass' => 'fa-gear bg-purple-light'
                ];
        }
    }
}
