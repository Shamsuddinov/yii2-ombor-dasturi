<?php

namespace app\controllers;

use Exception;
use Yii;
use app\models\AuthItem;
use app\models\AuthItemSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends BaseController
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
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 3);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
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
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        $post = Yii::$app->request->post();
        if($model->load($post)){
            $transaction = Yii::$app->db->beginTransaction();
            $saved = false;
            try {
                $model->setAttributes([
                    'type' => $model::TYPE_CONTROLLER_NAME
                ]);
                if($model->save()){
                    $models = $post['AuthItem']['tabular'];
                    foreach ($models as $post_item){
                        $new_model = new AuthItem();
                        $new_model->setAttributes([
                            'name' => $model->name."/".$post_item['name'],
                            'description' => $post_item['description'],
                            'type' => $new_model::TYPE_PERMISSION
                        ]);
                        if($new_model->save()){
                            $saved = true;
                        } else {
                            $saved = false;
                            break;
                        }
                    }
                }
                if ($saved) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', '');
                } else {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('danger', '');
                }
            } catch (Exception $e){
                $transaction->rollBack();
                Yii::info('Error Permission Saved ' . $e->getMessage(), 'error');
            }
            return $this->redirect(['index']);
        }
        $model->tabular = ['index', 'create', 'update', 'delete', 'view'];
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
