<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Received;

/**
 * ReceivedSearch represents the model behind the search form of `app\models\Received`.
 */
class ReceivedSearch extends Received
{
    public $contragent_id;
    public $date_for_search;
    public $from_date;
    public $to_date;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'receiver_id', 'product_id', 'details_id'], 'integer'],
            [['quantity', 'r_price'], 'number'],
            [['contragent_id', 'date_for_search', 'from_date', 'to_date'], 'safe'],
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

        $query = Received::find()->select(['r.*', 'd.date as date', 'product.name as name', 'c.id as contr', 'c.name as contragent'])
            ->alias('r')
            ->leftJoin('details d', 'd.id = r.details_id')
            ->leftJoin('product', 'product.id = r.product_id')
            ->leftJoin('contragent c', 'c.id = d.contragent_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
//                    'date_for_search' => SORT_DESC,
                    'details_id' => SORT_DESC,
                ],
                'attributes' => [
                    'product_id' => [
                        'asc' => ['name' => SORT_ASC, 'date' => SORT_DESC],
                        'desc' => ['name' => SORT_DESC, 'date' => SORT_DESC],
                    ],
                    'details_id' => [
                        'asc' => ['details_id' => SORT_ASC, 'date' => SORT_DESC],
                        'desc' => ['details_id' => SORT_DESC, 'date' => SORT_DESC],
                    ],
                    'contragent_id' => [
                        'asc' => ['c.name' => SORT_ASC],
                        'desc' => ['c.name' => SORT_DESC],
                    ],
                    'date_for_search' => [
                        'asc' => ['date' => SORT_ASC],
                        'desc' => ['date' => SORT_DESC],
                    ],
                    'r_price' => [
                        'asc' => ['r_price' => SORT_ASC, 'date' => SORT_DESC],
                        'desc' => ['r_price' => SORT_DESC, 'date' => SORT_DESC],
                    ],
                    'quantity' => [
                        'asc' => ['quantity' => SORT_DESC, 'date' => SORT_DESC],
                        'desc' => ['quantity' => SORT_ASC, 'date' => SORT_DESC],
                    ],
                ],
            ]
        ]);


        $this->load($params);
//        $this->setAttributes([
//           'from_date' =>
//        ]);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'receiver_id' => $this->receiver_id,
            'product_id' => $this->product_id,
            'r.quantity' => $this->quantity,
            'r.r_price' => $this->r_price,
            'contragent_id' => $this->contragent_id
        ]);

        $query->andFilterWhere(['between', 'date', $this->from_date, $this->to_date]);

        return $dataProvider;
    }
}
