<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sold;

/**
 * SoldSearch represents the model behind the search form of `app\models\Sold`.
 */
class SoldSearch extends Sold
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'seller_id', 'product_id', 'department_id'], 'integer'],
            [['date'], 'safe'],
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
        $query = Sold::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'quantity' => $this->quantity,
            's_price' => $this->s_price,
            'seller_id' => $this->seller_id,
            'product_id' => $this->product_id,
            'department_id' => $this->department_id,
        ]);

        return $dataProvider;
    }
}
