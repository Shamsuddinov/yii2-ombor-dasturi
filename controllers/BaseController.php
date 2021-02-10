<?php


namespace app\controllers;

/**
 * Class BaseController
 * @package app\controllers
 */

class BaseController extends \yii\web\Controller
{
    public $layout = 'yangilayout';
    public function beforeAction($action)
    {
        if($action->id == 'index' || $action->id == 'info'){
            \Yii::$app->session->setFlash('modal-on', 'Okay');
        }
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
    }
}