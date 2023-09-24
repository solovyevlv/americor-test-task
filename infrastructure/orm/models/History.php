<?php

namespace app\infrastructure\orm\models;

use app\infrastructure\orm\models\traits\ObjectNameTrait;
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
 * @property Call|null $call
 */
class History extends ActiveRecord
{
    use ObjectNameTrait;

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

//    public static function getEventTexts(): array
//    {
//        return [
//            \app\domain\entity\History::EVENT_CREATED_TASK => Yii::t('app', 'Task created'),
//            \app\domain\entity\History::EVENT_UPDATED_TASK => Yii::t('app', 'Task updated'),
//            \app\domain\entity\History::EVENT_COMPLETED_TASK => Yii::t('app', 'Task completed'),
//
//            \app\domain\entity\History::EVENT_INCOMING_SMS => Yii::t('app', 'Incoming message'),
//            \app\domain\entity\History::EVENT_OUTGOING_SMS => Yii::t('app', 'Outgoing message'),
//
//            \app\domain\entity\History::EVENT_CUSTOMER_CHANGE_TYPE => Yii::t('app', 'Type changed'),
//            \app\domain\entity\History::EVENT_CUSTOMER_CHANGE_QUALITY => Yii::t('app', 'Property changed'),
//
//            \app\domain\entity\History::EVENT_OUTGOING_CALL => Yii::t('app', 'Outgoing call'),
//            \app\domain\entity\History::EVENT_INCOMING_CALL => Yii::t('app', 'Incoming call'),
//
//            \app\domain\entity\History::EVENT_INCOMING_FAX => Yii::t('app', 'Incoming fax'),
//            \app\domain\entity\History::EVENT_OUTGOING_FAX => Yii::t('app', 'Outgoing fax'),
//        ];
//    }

//    /**
//     * @param $event
//     * @return mixed
//     */
//    public static function getEventTextByEvent($event)
//    {
//        return static::getEventTexts()[$event] ?? $event;
//    }

//    /**
//     * @return mixed|string
//     */
//    public function getEventText()
//    {
//        return static::getEventTextByEvent($this->event);
//    }

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

//    public function getUsername(): string
//    {
//        return isset($this->user) ? $this->user->username : Yii::t('app', 'System');
//    }
}
