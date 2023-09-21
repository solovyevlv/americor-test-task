<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use app\widgets\HistoryList\HistoryList;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Americor Test';

?>

<div class="site-index">
    <?= HistoryList::widget([
            'dataProvider' => $dataProvider,
            'linkExport' => Url::to(
                ArrayHelper::merge(
                    ['site/export'],
                    ['exportType' => ExportMenu::FORMAT_CSV],
                    Yii::$app->request->get()
                )
            )
        ]) ?>
</div>
