<?php

declare(strict_types=1);

namespace app\controllers\actions\export;

use app\controllers\actions\export\request\ExportForm;
use app\repository\HistoryRepositoryInterface;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;

final class ExportAction extends Action
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
        $form = new ExportForm();
        $form->load(Yii::$app->request->get(), '');

        if (!$form->validate()) {
            throw new BadRequestHttpException();
        }

        return $this->controller->render('export', [
            'dataProvider' => $this->historyRepository->findByFilter($form->getFilter()),
            'exportType' => $form->getExportType(),
            'batchSize' => 100,
            'fileName' => sprintf('history-%d', time())
        ]);
    }
}
