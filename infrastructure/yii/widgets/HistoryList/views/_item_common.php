<?php

use yii\helpers\Html;

/* @var $userName string */
/* @var $body string */
/* @var $footer string */
/* @var $footerDatetime string */
/* @var $bodyDatetime string */
/* @var $iconClass string */

echo Html::tag('i', '', ['class' => "icon icon-circle icon-main white $iconClass"]);
?>

<div class="bg-success ">
    <?php echo $body ?>

    <?php if (isset($bodyDatetime)): ?>
        <span>
       <?= \app\infrastructure\yii\widgets\DateTime\DateTime::widget(['dateTime' => $bodyDatetime]) ?>
    </span>
    <?php endif; ?>
</div>

<?php if (empty($userName)): ?>
    <div class="bg-info"><?= $userName; ?></div>
<?php endif; ?>

<?php if (!empty($content)): ?>
    <div class="bg-info">
        <?= $content ?>
    </div>
<?php endif; ?>

<?php if (isset($footer) || isset($footerDatetime)): ?>
    <div class="bg-warning">
        <?php echo $footer ?? '' ?>
        <?php if (isset($footerDatetime)): ?>
            <span><?= \app\infrastructure\yii\widgets\DateTime\DateTime::widget(['dateTime' => $footerDatetime]) ?></span>
        <?php endif; ?>
    </div>
<?php endif; ?>
