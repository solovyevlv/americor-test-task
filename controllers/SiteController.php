<?php

namespace app\controllers;

use app\controllers\actions\export\ExportAction;
use app\controllers\actions\index\IndexAction;
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
