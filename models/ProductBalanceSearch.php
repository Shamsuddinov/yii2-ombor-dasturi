<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductBalance;
use yii\data\ArrayDataProvider;

/**
 * ProductBalanceSearch represents the model behind the search form of `app\models\ProductBalance`.
 */
class ProductBalanceSearch extends ProductBalance
{
    public $product_name;
    public $department_name;
    public $from_amount;
    public $to_amount;
    public $amount;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'department_id', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at', 'from_amount', 'to_amount'], 'integer'],
            [['quantity', 'price'], 'number'],
            [['product_name', 'department_name', 'amount'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product'),
            'product_name' => Yii::t('app', 'Product'),
            'department_name' => Yii::t('app', 'Department'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'department_id' => Yii::t('app', 'Department'),
            'status' => Yii::t('app', 'Status'),
            'from_amount' => Yii::t('app', 'From'),
            'to_amount' => Yii::t('app', 'To'),
            'created_by' => Yii::t('app', 'Created by'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_by' => Yii::t('app', 'Updated by'),
            'updated_at' => Yii::t('app', 'Updated at'),
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
    public function search($params, $as_array = false)
    {
        $query = ProductBalance::find()->joinWith(['product', 'department']);

        // add conditions that should always apply here

        if($as_array){
            $query->asArray();
            $this->load($params);

            $query->andFilterWhere([
                'id' => $this->id,
                'product_id' => $this->product_id,
                'product_balance.quantity' => $this->quantity,
                'price' => $this->price,
                'department_id' => $this->department_id,
                'status' => $this->status,
                'created_by' => $this->created_by,
                'created_at' => $this->created_at,
                'updated_by' => $this->updated_by,
                'updated_at' => $this->updated_at,
            ]);

            $query->andFilterWhere(['between', 'product_balance.quantity', $this->from_amount, $this->to_amount]);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $query->all(),
                'pagination' => false,
                'sort' => [
                    'defaultOrder' => [
                        'quantity' => SORT_ASC,
                    ],
                    'attributes' => [
                        'product_name' => [
                            'asc' => ['product.name' => SORT_ASC],
                            'desc' => ['product.name' => SORT_DESC],
                            'label' => Yii::t('app', 'Product name')
                        ],
                        'department_name' => [
                            'asc' => ['department.name' => SORT_ASC],
                            'desc' => ['department.name' => SORT_DESC],
                            'label' => Yii::t('app', 'Department name')
                        ],
                        'quantity' => [
                            'asc' => ['quantity' => SORT_ASC],
                            'desc' => ['quantity' => SORT_DESC],
                            'label' => Yii::t('app', 'Quantity')
                        ],
                    ],
                ]
            ]);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            return $dataProvider;
        }

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
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'department_id' => $this->department_id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
