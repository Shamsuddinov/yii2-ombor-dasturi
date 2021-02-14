<?php


namespace app\controllers;

use DirectoryIterator;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

/**
 * Class BaseController
 * @package app\controllers
 */

class BaseController extends Controller
{
    public $layout = 'yangilayout';
    public function beforeAction($action)
    {
        if($action->id == 'index' || $action->id == 'info'){
            \Yii::$app->session->setFlash('modal-on', 'Okay');
        }

        if (Yii::$app->authManager->getPermission(Yii::$app->controller->id . "/" . Yii::$app->controller->action->id)) {
            if (!Yii::$app->user->can(Yii::$app->controller->id . "/" . Yii::$app->controller->action->id)) {
                throw new ForbiddenHttpException(Yii::t('app', 'Permission not available!'));
            }
        }
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
    }

    public function actionCont()
    {
        $controllerlist = [];
        if ($handle = opendir('../controllers')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
                    $controllerlist[] = $file;
                }
            }
            closedir($handle);
        }
        asort($controllerlist);
        $fulllist = [];
        foreach ($controllerlist as $controller):
            $handle = fopen('../controllers/' . $controller, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    if (preg_match('/public function action(.*?)\(/', $line, $display)):
                        if (strlen($display[1]) > 2):
                            $fulllist[substr($controller, 0, -4)][] = strtolower($display[1]);
                        endif;
                    endif;
                }
            }
            fclose($handle);
        endforeach;

        echo "<pre>";
        print_r($fulllist);
        echo "</pre>";
        exit();
    }
}