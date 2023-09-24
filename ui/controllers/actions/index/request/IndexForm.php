<?php

declare(strict_types=1);

namespace app\ui\controllers\actions\index\request;

use yii\base\Model;

class IndexForm extends Model
{
    // TODO: описание правил валидации
    public function rules(): array
    {
        return [];
    }

    public function getFilter(): array
    {
        // TODO: возвращает фильтр
        return [];
    }
}
