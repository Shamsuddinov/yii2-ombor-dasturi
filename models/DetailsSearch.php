<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Details;
use yii\helpers\ArrayHelper;

class DetailsSearch extends Details
{
    public $contragent_name;

    public function rules()
    {
        return [
            [['id', 'contragent_id'], 'integer'],
            [['date'], 'safe'],
            [['sum'], 'number'],
            ['contragent_name', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Details::find()->joinWith('contragent');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
                'attributes' => [
                    'id' => [
                        'asc' => ['details.id' => SORT_ASC],
                        'desc' => ['details.id' => SORT_DESC],
                    ],
                    'contragent_name' => [
                        'asc' => ['contragent.name' => SORT_ASC],
                        'desc' => ['contragent.name' => SORT_DESC]
                    ],
                    'date' => [
                        'asc' => ['date' => SORT_ASC],
                        'desc' => ['date' => SORT_DESC]
                    ],
                    'sum' => [
                        'asc' => ['sum' => SORT_ASC],
                        'desc' => ['sum' => SORT_DESC]
                    ],
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'details.id' => $this->id,
            'date' => $this->date,
            'contragent_id' => $this->contragent_id,
            'sum' => $this->sum,
        ]);

        $items = ArrayHelper::getColumn(\Yii::$app->db->createCommand("SELECT contragent.id FROM contragent WHERE name LIKE '%{$this->contragent_name}%'")->queryAll(), 'id');
        $query->andFilterWhere(['in', 'contragent_id', $items]);
        return $dataProvider;
    }
}
