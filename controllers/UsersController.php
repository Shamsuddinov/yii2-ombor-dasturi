<?php

namespace app\controllers;

use app\models\AuthAssignment;
use app\models\BaseModel;
use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\helpers\ArrayHelper;
use yii\rbac\Assignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {
            $model->password = md5($model->password);
            if(gettype($post['Users']['rules']) == 'string'){
                BaseModel::getErrorMessages(false, 'Please select user rule!');
            }
            $transaction = Yii::$app->db->beginTransaction();
            $saved = false;
            try {
                if($post['Users']['rules'] !== null){
                    if($model->save() && gettype($post['Users']['rules']) != 'string'){
                        foreach ($post['Users']['rules'] as $rule){
                            $save_rule = new AuthAssignment();
                            $save_rule->setAttributes([
                                'item_name' => $rule,
                                'user_id' => "$model->id"
                            ]);
                            if($save_rule->save()){
                                $saved = true;
                            } else{
                                $saved = false;
                            }
                        }
                        if($saved){
                            BaseModel::getMessages(true, 'added');
                            $transaction->commit();
                            return $this->redirect(['index']);
                        } else{
                            $transaction->rollBack();
                        }
                    }
                } else {
                    BaseModel::getErrorMessages(false, Yii::t('app', 'There are some mistakes!'));
                }
            } catch (\Exception $exception){
                $transaction->rollBack();
                BaseModel::getErrorMessages(false, $exception->getMessage());
            }
//            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->rules = ArrayHelper::map(AuthAssignment::find()->where(['user_id' => "$model->id"])->all(), 'item_name', 'item_name');
        $post = Yii::$app->request->post();

        if ($model->load($post) && gettype($post['Users']['rules']) === 'array') {
            $transaction = Yii::$app->db->beginTransaction();
            $saved = false;
            try {
                if($post['Users']['password'] !== ''){
                    $model->setAttributes([
                        'password' => md5($post['Users']['password'])
                    ]);
                }
                if($model->save()){
                    AuthAssignment::deleteAll(['user_id' => "$model->id"]);
                    foreach ($post['Users']['rules'] as $rule){
                        $auth_items = new AuthAssignment();
                        $auth_items->setAttributes([
                            'item_name' => $rule,
                            'user_id' => "$model->id"
                        ]);
                        if($auth_items->save()){
                            $saved = true;
                        } else {
                            $saved = false;
                        }
                    }
                }
                if($saved){
                    BaseModel::getMessages(true, 'updated');
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    BaseModel::getErrorMessages(false, 'Please check all items!');
                    $transaction->rollBack();
                }
            } catch (\Exception | \Throwable $exception){
                $transaction->rollBack();
            }
        } else {
            if(Yii::$app->request->isPost){
                BaseModel::getErrorMessages(false, Yii::t('app', 'Please select user rules!'));
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
