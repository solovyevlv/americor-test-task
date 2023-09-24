<?php

declare(strict_types=1);

namespace app\ui\controllers\actions\index;

use app\application\history\service\HistoryServiceInterface;
use app\domain\HistoryRepositoryInterface;
use app\ui\controllers\actions\index\request\IndexForm;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;

class IndexAction extends Action
{
    /**
     * @var HistoryServiceInterface
     */
    private $historyService;

    public function __construct($id, $controller, HistoryServiceInterface $historyService, $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->historyService = $historyService;
    }

    /**
     * @throws BadRequestHttpException
     */
    public function run(): string
    {
        $form = new IndexForm();
        $form->load(Yii::$app->request->get());

        if (!$form->validate()) {
            throw new BadRequestHttpException();
        }

        return $this->controller->render('index', [
            'dataProvider' => $this->historyService->findByFilter($form->getFilter()),
        ]);
    }
}
