<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $exportType string
 * @var $batchSize integer
 * @var $fileName string
 */

use app\models\History;
use app\widgets\Export\Export;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');

echo Export::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'ins_ts',
            'label' => Yii::t('app', 'Date'),
            'format' => 'datetime'
        ],
        [
            'attribute' => 'username',
            'label' => Yii::t('app', 'User'),
        ],
        [
            'attribute' => 'object',
            'label' => Yii::t('app', 'Type')
        ],
        [
            'attribute' => 'eventText',
            'label' => Yii::t('app', 'Event')
        ],
        [
            'value' => function(History $model) {
                return strip_tags($model->getFullMessage());
            },
            'label' => Yii::t('app', 'Message')
        ]
    ],
    'exportType' => $exportType,
    'batchSize' => $batchSize,
    'filename' => $fileName
]);
