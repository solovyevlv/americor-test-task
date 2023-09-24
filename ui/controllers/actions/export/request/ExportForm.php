<?php

declare(strict_types=1);

namespace app\ui\controllers\actions\export\request;

use kartik\export\ExportMenu;
use yii\base\Model;

class ExportForm extends Model
{
    /**
     * @var string
     */
    private $exportType;

    // TODO: описание правил валидации
    public function rules(): array
    {
        return [
            ['exportType', 'in', 'range' => [
                ExportMenu::FORMAT_CSV,
                ExportMenu::FORMAT_PDF,
                ExportMenu::FORMAT_HTML,
                ExportMenu::FORMAT_EXCEL,
                ExportMenu::FORMAT_HTML
            ]]
        ];
    }

    public function getFilter(): array
    {
        // TODO: возвращает фильтр
        return [];
    }

    public function getExportType(): string
    {
        return $this->exportType ?? ExportMenu::FORMAT_CSV;
    }

    public function setExportType(string $exportType)
    {
        $this->exportType = $exportType;
    }
}
