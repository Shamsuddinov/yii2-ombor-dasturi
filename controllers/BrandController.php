<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use app\models\Brand;
use app\models\BrandSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class BrandController
 * @package app\controllers
 */
class BrandController extends BaseController
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
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brand model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view', [
                'model' => $model,
            ]);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Brand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Brand();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Successfully created new brand');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Brand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Brand successfully updated!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Brand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $item = $this->findModel($id);
        $isAjax = Yii::$app->request->isAjax;
        $flash = Yii::$app->session;
        $result['status'] = 'false';
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        if($item){
            $hasProduct = Product::findOne(['brand_id' => $id]);
            if($hasProduct !== null){
                if($isAjax){
                    return Brand::getResult(false);
                }
                $flash->setFlash('danger', Brand::getResult(false)['error']);
            } else{
                $item->setAttributes([
                    'status' => Brand::STATUS_INACTIVE,
                    'name' => $item->name." (archived)"
                ]);
                $item->save();
                if($isAjax){
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return Brand::getResult(true);
                }
                $flash->setFlash('success', Brand::getResult(true)['save']);
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brand::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionCreateMultiple()
    {
        $brand = new Brand;
        $brands = [new Brand];
        if ($brand->load(Yii::$app->request->post())) {
            $brands = Brand::createMultiple(Brand::classname());
            Brand::loadMultiple($brands, Yii::$app->request->post());
            unset($brands[count($brands) - 1]);
            array_push($brands, $brand);
            if(Brand::validateMultiple($brands)):
                foreach ($brands as $item){
                    $item->save();
                }
                Yii::$app->session->setFlash('success', 'Successfully created');
                return $this->redirect(['index']);
            endif;
        }

        return $this->render('test', [
            'brand' => $brand,
            'brands' => (empty($brands)) ? [new Brand] : $brands
        ]);
    }
}
