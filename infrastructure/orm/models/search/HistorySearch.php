<?php

namespace app\infrastructure\orm\models\search;

use app\infrastructure\orm\models\History;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HistorySearch represents the model behind the search form about `app\models\History`.
 *
 * @property array $objects
 */
class HistorySearch extends History
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search(): ActiveDataProvider
    {
        $query = History::find();
        $query->addSelect('history.*');
        $query->with(['customer', 'user', 'sms', 'task', 'call', 'fax']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'ins_ts' => SORT_DESC,
                'id' => SORT_DESC
            ],
        ]);

        return $dataProvider;
    }
}
