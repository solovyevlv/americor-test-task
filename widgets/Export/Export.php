<?php

namespace app\widgets\Export;

use kartik\export\ExportMenu;
use Yii;

class Export extends ExportMenu
{
    public function init()
    {
        $this->exportRequestParam = $this->exportRequestParam ?? 'exportFull_' . $this->getId();

        Yii::$app->request->setBodyParams([
            Yii::$app->request->methodParam => 'POST',
            $this->exportRequestParam => true,
            $this->colSelFlagParam => false,
            $this->exportTypeParam => $this->exportType
        ]);

        parent::init();
    }
}
