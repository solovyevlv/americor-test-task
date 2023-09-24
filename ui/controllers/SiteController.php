<?php

namespace app\ui\controllers;

use app\ui\controllers\actions\export\ExportAction;
use app\ui\controllers\actions\index\IndexAction;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions(): array
    {
        return [
            'index' => [
                'class' => IndexAction::class
            ],
            'export' => [
                'class' => ExportAction::class
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }
}
