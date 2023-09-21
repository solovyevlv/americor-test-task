<?php

declare(strict_types=1);

namespace app\controllers\actions\index;

use app\controllers\actions\index\request\IndexForm;
use app\repository\HistoryRepositoryInterface;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;

class IndexAction extends Action
{
    /**
     * @var HistoryRepositoryInterface
     */
    private $historyRepository;

    public function __construct($id, $controller, HistoryRepositoryInterface $historyRepository, $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->historyRepository = $historyRepository;
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
            'dataProvider' => $this->historyRepository->findByFilter($form->getFilter()),
        ]);
    }
}
