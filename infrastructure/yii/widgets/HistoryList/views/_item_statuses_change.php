<?php

use app\infrastructure\orm\models\User;

/* @var $user User */
/* @var $eventText string */
/* @var $oldValue string */
/* @var $newValue string */
/* @var $bodyDatetime string */
?>

<div class="bg-success ">
    <?= $eventText ?>
    <span class="badge badge-pill badge-warning"><?= $oldValue ?? '<i>not set</i>' ?></span>
    &#8594;
    <span class="badge badge-pill badge-success"><?= $newValue ?? '<i>not set</i>' ?></span>'
    <span><?= \app\infrastructure\yii\widgets\DateTime\DateTime::widget(['dateTime' => $bodyDatetime]) ?></span>
</div>

<?php if (isset($model->user)): ?>
    <div class="bg-info"><?= $model->user->username; ?></div>
<?php endif; ?>

<?php if (isset($content) && $content): ?>
    <div class="bg-info">
        <?php echo $content ?>
    </div>
<?php endif; ?>
