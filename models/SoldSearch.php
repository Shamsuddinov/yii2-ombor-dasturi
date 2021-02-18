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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'seller_id', 'product_id', 'department_id'], 'integer'],
            [['date', 'department_name', 'product_name', 'seller_name'], 'safe'],
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
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'sold.quantity' => $this->quantity,
            's_price' => $this->s_price,
//            'seller_id' => $this->seller_id,
//            'product_id' => $this->product_id,
//            'department_id' => $this->department_id,
        ]);

        $query->andFilterWhere(['like', 'department.name', $this->department_name]);
        $query->andFilterWhere(['like', 'product.name', $this->product_name]);
        $query->andFilterWhere(['like', 'users.username', $this->seller_name]);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->all(),
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }


        return $dataProvider;
    }
}
