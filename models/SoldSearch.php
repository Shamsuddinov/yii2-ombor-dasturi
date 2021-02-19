<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sold;
use yii\data\ArrayDataProvider;

/**
 * SoldSearch represents the model behind the search form of `app\models\Sold`.
 */
class SoldSearch extends Sold
{
    public $department_name;
    public $product_name;
    public $seller_name;
    public $date_for_search;
    public $from_date;
    public $to_date;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'seller_id', 'product_id', 'department_id'], 'integer'],
            [['date', 'department_name', 'product_name', 'seller_name', 'date_for_search', 'from_date', 'to_date'], 'safe'],
            [['quantity', 's_price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Sold::find()
            ->joinWith(['seller', 'department', 'product'])->asArray();

        $this->load($params);
        // grid filtering conditions
        $query->andFilterWhere(['between', 'date', $this->from_date, $this->to_date]);

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'sold.quantity' => $this->quantity,
            's_price' => $this->s_price,
            'seller_id' => $this->seller_id,
            'product_id' => $this->product_id,
            'sold.department_id' => $this->department_id,
        ]);

        $query->andFilterWhere(['like', 'department.name', $this->department_name]);
        $query->andFilterWhere(['like', 'product.name', $this->product_name]);
        $query->andFilterWhere(['like', 'users.username', $this->seller_name]);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->all(),
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ],
                'attributes' => [
                    'product_name' => [
                        'asc' => ['product.name' => SORT_ASC],
                        'desc' => ['product.name' => SORT_DESC],
                    ],
                    'department_name' => [
                        'asc' => ['department.name' => SORT_ASC],
                        'desc' => ['department.name' => SORT_DESC],
                    ],
                    'seller_name' => [
                        'asc' => ['users.username' => SORT_ASC],
                        'desc' => ['users.username' => SORT_DESC],
                    ],
                    's_price' => [
                        'asc' => ['s_price' => SORT_ASC],
                        'desc' => ['s_price' => SORT_DESC],
                    ],
                    'quantity' => [
                        'asc' => ['quantity' => SORT_ASC],
                        'desc' => ['quantity' => SORT_DESC],
                    ],
                    'date' => [
                        'asc' => ['date' => SORT_ASC],
                        'desc' => ['date' => SORT_DESC],
                    ]
                ],
            ]
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }


        return $dataProvider;
    }
}
