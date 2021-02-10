<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use app\models\ProductType;
use app\models\ProductTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductTypeController implements the CRUD actions for ProductType model.
 */
class ProductTypeController extends BaseController
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
     * Lists all ProductType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductType model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if($this->findModel($id)){
           if(Yii::$app->request->isAjax){
               return $this->renderAjax('view', ['model' => $this->findModel($id)]);
           }
        } else{
            Yii::$app->session->setFlash('danger', 'Item not found!');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->setAttribute('status', ProductType::STATUS_ACTIVE);
            $model->save();
            Yii::$app->session->setFlash('success', 'Product category successfully created');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('create', ['model' => $model]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->setAttribute('status', ProductType::STATUS_ACTIVE);
            $model->save();
            Yii::$app->session->setFlash('success', 'Product category successfully updated!');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update', ['model' => $model]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $response = [];
        $response['status'] = 'false';
        $item = $this->findModel($id);
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        if($item){
            $isAjax = Yii::$app->request->isAjax;
            $hasProduct = Product::findOne(['type_id' => $id]);
            $hasCategory = ProductType::findOne(['cat_id' => $id]);

            if($hasProduct !== null || $hasCategory !== null){
                if($isAjax){
                    return ProductType::getResult(false);
                }
                Yii::$app->session->setFlash('danger', ProductType::getResult(false)['error']);
            } else {
                $item->setAttributes([
                   'status' => ProductType::STATUS_INACTIVE,
                    'name' => $item->name.' (archived)'
                ]);
                if($item->save()){
                    if($isAjax){
                        return ProductType::getResult(true);
                    }
                    Yii::$app->session->setFlash('success', ProductType::getResult(true)['save']);
                }
            }
        }
        return $this->redirect(['product-type/index']);
    }

    /**
     * Finds the ProductType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
