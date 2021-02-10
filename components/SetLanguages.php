<?php

namespace app\components;


use yii\base\Behavior;
use Yii;
use yii\web\Application;

class SetLanguages extends Behavior {
    public function events()
    {
        return [ Application::EVENT_BEFORE_REQUEST => 'set'];
    }
    public function set() {
        if (Yii::$app->session->has('language')) {
            Yii::$app->language = Yii::$app->session->get('language');
        }
    }
}