<?php
namespace app\api\modules\v1\controllers;

use app\api\modules\v1\models\Yangilik;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class YangilikController extends ActiveController
{
    public $modelClass = 'app\api\modules\v1\models\Yangilik';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
    }

    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Yangilik::find()
        ]);
        return $dataProvider;
    }
}