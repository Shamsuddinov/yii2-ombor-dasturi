<?php

namespace app\controllers;

use app\models\BaseModel;
use app\models\Product;
use app\models\ProductBalance;
use Yii;
use app\models\Sold;
use app\models\SoldSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SoldController implements the CRUD actions for Sold model.
 */
class SoldController extends BaseController
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
                    'price-and-quantity' => ['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all Sold models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SoldSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sold model.
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
     * Creates a new Sold model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->request->isPost){
            $post_items = Yii::$app->request->post()['Sold']['tabular'];
            $transaction = Yii::$app->db->beginTransaction();
            $saved = false;
            try {
                foreach ($post_items as $post_item){
                    $product = Product::find()->where(['id' => $post_item['product_id']])->asArray()->one();
                    if($product){
                        $product_balance = ProductBalance::find()
                            ->where(['and',
                                ['department_id' => Yii::$app->user->identity->department_id],
                                ['product_id' => $post_item['product_id']],
                                ])
                            ->andWhere(['>','quantity', $post_item['quantity']])
                            ->one();
                        $product_balance->setAttributes([
                            'quantity' => $product_balance['quantity'] - $post_item['quantity']
                        ]);
                        if($product_balance->save()){
                            $selled_product = new Sold();
                            $price_i = $product_balance['price'] * 1.1;

                            $selled_product->setAttributes([
                                'date' => date('Y-m-d h:i:s'),
                                'quantity' => $post_item['quantity'],
                                's_price' => $price_i,
                                'seller_id' => Yii::$app->user->id,
                                'product_id' => $product['id'],
                                'status' => Sold::STATUS_INACTIVE,
                                'department_id' => Yii::$app->user->identity->department_id
                            ]);
                            if($selled_product->save()){
                                $saved = true;
                            } else {
                                $saved = false;
                                break;
                            }
                        }
                    }
                }
                if($saved){
                    BaseModel::getMessages(true, 'updated');
                    $transaction->commit();
                    return $this->redirect(['sold/index']);
                } else {
                    BaseModel::getMessages(false);
                    $transaction->rollBack();
                }
            } catch (\Exception | \Throwable $exception){
                $transaction->rollBack();
            }
        }

        $model = new Sold();
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionPriceAndQuantity($id){
        $response = [];
        $response['status'] = false;
        $response['message'] = Yii::t('app','Data is empty');
        Yii::$app->response->format = Response::FORMAT_JSON;
        $product_balance = ProductBalance::find()
            ->where(['department_id' => Yii::$app->user->identity->department_id, 'product_id' => $id])
            ->asArray()
            ->one();
        if($product_balance){
            $response['status'] = true;
            $response['result'] = $product_balance;
            $response['message'] = 'OK';
        }
        return $response;
    }

    public function actionSaveAndFinish(){
        echo "<pre>";
        print_r(Yii::$app->request->post());
        echo "</pre>";
        exit();
    }

    /**
     * Updates an existing Sold model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSoldProductsReport(){
        $searchModel = new SoldSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $all_items = $dataProvider->getModels();
        $count = $dataProvider->getCount();
        $total_count = $dataProvider->getTotalCount();
        $sort = $dataProvider->getSort();

        return $this->render('sold-report', [
            'searchModel' => $searchModel,
            'all_items' => $all_items,
            'count' => $count,
            'total_count' => $total_count,
            'sort' => $sort
        ]);
    }

    /**
     * Deletes an existing Sold model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax){

        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sold model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sold the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sold::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
