<?php

namespace app\infrastructure\yii\widgets\HistoryList;

use yii\base\Widget;
use yii\data\DataProviderInterface;

class HistoryList extends Widget
{
    /**
     * @var DataProviderInterface
     */
    public $dataProvider;

    /**
     * @var string
     */
    public $linkExport;

    public function run(): string
    {
        return $this->render('main', [
            'linkExport' => $this->linkExport,
            'dataProvider' => $this->dataProvider
        ]);
    }
}
