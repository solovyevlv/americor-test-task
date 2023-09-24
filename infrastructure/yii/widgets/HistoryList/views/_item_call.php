<?php

use yii\helpers\Html;

/* @var $userName string */
/* @var $footerDatetime string */
/* @var $bodyDatetime string */
/* @var $totalDisposition string */
/* @var $totalStatusText string */
/* @var $isCall bool */
/* @var $isFooter bool */
/* @var $isAnswered bool */
/* @var $applicantName string */
/* @var $content string */

echo Html::tag('i', '', [
    'class' => 'icon icon-circle icon-main white ' . $isAnswered ? 'md-phone bg-green' : 'md-phone-missed bg-red'
]);
?>

<div class="bg-success ">
    <?php if ($isCall): ?>
        <?= $totalStatusText . ' ' ?? '' ?>
        <?php if (!empty($totalDisposition)): ?>
            <span class='text-grey'><?= $totalDisposition ?></span>
        <?php endif; ?>
    <?php else: ?>
        <i>Deleted</i>
    <?php endif; ?>
    <?php if (isset($bodyDatetime)): ?>
        <span><?= \app\infrastructure\yii\widgets\DateTime\DateTime::widget(['dateTime' => $bodyDatetime]) ?></span>
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

<?php if (!empty($applicantName)) : ?>
    <div class="bg-warning">
        Called <span><?= $applicantName ?></span>

        <?php if (isset($footerDatetime)): ?>
            <span><?= \app\infrastructure\yii\widgets\DateTime\DateTime::widget(['dateTime' => $footerDatetime]) ?></span>
        <?php endif; ?>
    </div>
<?php endif; ?>
