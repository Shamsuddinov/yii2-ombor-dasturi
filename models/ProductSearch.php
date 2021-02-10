<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'properties', 'brand_id', 'type_id', 'type'], 'safe'],
            [['quantity', 'r_price'], 'number'],
//            ['brand.name', 'safe']
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
        $query = Product::find()->select(['product.*', 'brand.name as brand_name', 'product_type.name as pname'])
            ->leftJoin('brand', 'product.brand_id=brand.id')
            ->leftJoin('product_type', 'product.type_id = product_type.id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'brand_id' => [
                        'asc' => ['brand_name' => SORT_ASC],
                        'desc' => ['brand_name' => SORT_DESC]
                    ],
                    'type_id' => [
                        'asc' => ['pname' => SORT_ASC],
                        'desc' => ['pname' => SORT_DESC]
                    ],
                    'name' => [
                        'asc' => ['name' => SORT_ASC],
                        'desc' => ['name' => SORT_DESC]
                    ],
                    'quantity' => [
                        'asc' => ['quantity' => SORT_ASC],
                        'desc' => ['quantity' => SORT_DESC]
                    ]
                ],
                'defaultOrder' => [
                    'name' => SORT_ASC
                ]
            ],
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
//            'type_id' => $this->type_id,
//            'brand.name' => $this->brand_id,
            'quantity' => $this->quantity,
            'r_price' => $this->r_price,
        ]);

        $query
//            ->andFilterWhere(['like', 'product.name', $this->name])
            ->andFilterWhere(['like', 'product.name', $this->name])
            ->andFilterWhere(['like', 'product_type.name', $this->type_id])
            ->andFilterWhere(['like', 'brand.name', $this->brand_id])
            ->andFilterWhere(['like', 'properties', $this->properties]);
//        echo "<pre>";
//        print_r($query->createCommand()->getRawSql());
//        echo "</pre>";
//        exit();
        return $dataProvider;
    }
}
