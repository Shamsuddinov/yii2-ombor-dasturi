<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthItem;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * AuthItemSearch represents the model behind the search form of `app\models\AuthItem`.
 */
class AuthItemSearch extends AuthItem
{
    /**
     * {@inheritdoc}
     */
    public $children;
    public function rules()
    {
        return [
            [['name', 'description', 'rule_name', 'data', 'children'], 'safe'],
            [['type', 'created_at', 'updated_at'], 'integer'],
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
     * @param int $type
     *
     * @return ActiveDataProvider
     */
    public function search($params, $type = null)
    {
        $query = AuthItem::find();
        $items = AuthItem::find();
        $items->asArray();

        if($type != null) {
            $query->where(['type' => $type]);
        }
        $query->asArray();
        $arr = [];

        foreach ($query->all() as $key => $item){
            $items->filterWhere(['like', 'name', $item['name']])->andFilterWhere(['type' => AuthItem::TYPE_PERMISSION]);
            ArrayHelper::setValue($item, 'items', $items->all());
            array_push($arr, $item);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $arr,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }
        return $dataProvider;
    }
}
