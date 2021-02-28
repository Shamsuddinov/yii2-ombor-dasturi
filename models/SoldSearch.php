<?php

namespace app\models;

use Yii;
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
    public $sum;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'seller_id', 'product_id', 'department_id'], 'integer'],
            [['date', 'department_name', 'product_name', 'seller_name', 'date_for_search', 'from_date', 'to_date', 'sum'], 'safe'],
            [['quantity', 's_price'], 'number'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'quantity' => Yii::t('app', 'Quantity'),
            's_price' => Yii::t('app', 'Price'),
            'seller_id' => Yii::t('app', 'Seller'),
            'product_id' => Yii::t('app', 'Product'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'department_id' => Yii::t('app', 'Department'),
            'date_for_search' => Yii::t('app', 'Date'),
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
            ->select(['(sold.s_price * sold.quantity) as sum', 'sold.*'])
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
                        'label' => Yii::t('app', 'Product name')
                    ],
                    'department_name' => [
                        'asc' => ['department.name' => SORT_ASC],
                        'desc' => ['department.name' => SORT_DESC],
                        'label' => Yii::t('app', 'Department name')
                    ],
                    'seller_name' => [
                        'asc' => ['users.username' => SORT_ASC],
                        'desc' => ['users.username' => SORT_DESC],
                        'label' => Yii::t('app', 'Seller')
                    ],
                    's_price' => [
                        'asc' => ['s_price' => SORT_ASC],
                        'desc' => ['s_price' => SORT_DESC],
                        'label' => Yii::t('app', 'Price')
                    ],
                    'quantity' => [
                        'asc' => ['quantity' => SORT_ASC],
                        'desc' => ['quantity' => SORT_DESC],
                        'label' => Yii::t('app', 'Quantity')
                    ],
                    'date' => [
                        'asc' => ['date' => SORT_ASC],
                        'desc' => ['date' => SORT_DESC],
                        'label' => Yii::t('app', 'Date')
                    ],
                    'sum' => [
                        'asc' => ['sum' => SORT_ASC],
                        'desc' => ['sum' => SORT_DESC],
                        'label' => Yii::t('app', 'Sum')
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
