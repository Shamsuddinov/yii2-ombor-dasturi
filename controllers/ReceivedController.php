<?php

namespace app\controllers;
use app\models\Details;
use app\models\ProductBalance;
use app\models\ReceiveForm;
use http\Url;
use Yii;
use app\models\Received;
use app\models\ReceivedSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ReceivedController implements the CRUD actions for Received model.
 */
class ReceivedController extends BaseController
{
    /**
     * {@inheritdoc}
     */

//    public function beforeAction($action)
//    {

//    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Received models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReceivedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionReceivedProductsReport()
    {
        $searchModel = new ReceivedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('new_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionReceivedProductsReportWithTable()
    {
        $searchModel = new ReceivedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);
        $all_items = $dataProvider->getModels();
        $sort = $dataProvider->getSort();
        $count = $dataProvider->getCount();
        $total_count = $dataProvider->getTotalCount();
        return $this->render('new_index_with_table', [
            'searchModel' => $searchModel,
            'all_items' => $all_items,
            'sort' => $sort,
            'count' => $count,
            'total_count' => $total_count
        ]);
    }
    public function actionInfo($id){
        if(Yii::$app->request->isPost){
            $transaction = Yii::$app->db->beginTransaction();
            $flash = Yii::$app->session;
            $post = Yii::$app->request->post();
            $isSaved = false;
            try {
                $details = Details::findOne($id);
                $details->setAttribute('sum', $post['Details']['sum']);
                if($details->save()){
                    foreach ($post['Received'] as $item){
                        $model = new Received();
                        $model->setAttributes([
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'r_price' => $item['r_price'],
                            'status' => $model::STATUS_ACTIVE,
                            'details_id' => $id,
                            'receiver_id' => 1
                        ]);
                        if($model->save()){
                            $isSaved = true;
                        }else{
                            $isSaved = false;
                        }
                    }
                } else{
                    $flash->setFlash('danger', Yii::t('app', 'There are some mistakes during saving process!'));
                }
                if($isSaved){
                    $flash->setFlash('success', Yii::t('app', 'Successfully updated!'));
                    $transaction->commit();
                    return $this->render('received/index');
                } else{
                    $flash->setFlash('success', Yii::t('app', 'Please check all items. There are some mistakes!'));
                    $transaction->rollBack();
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } catch (\Exception $e){
                $flash->setFlash('danger', Yii::t('app', 'There are some mistakes. Please check all items!'));
                $transaction->rollBack();
            } catch (\Throwable $e){
                $flash->setFlash('danger', Yii::t('app', 'There are some mistakes. Please check all items!'));
                $transaction->rollBack();
            }
        }
        $data = Received::find()->where(['details_id' => $id])->all();
        if(empty($data)){
            return $this->redirect(\yii\helpers\Url::to(['details/index']));
        }
        $details = Details::findOne(['id' => $id]);
        $models = [new Received()];
        $hideIt = ($details->status === $details::STATUS_ACTIVE) ? false : true;
        return $this->render('info', ['data' => $data, 'models' => $models, 'details' => $details, 'hideIt' => $hideIt]);
    }
    public function actionInformation($id){
        if(Yii::$app->request->isPost){
            $transaction = Yii::$app->db->beginTransaction();
            $flash = Yii::$app->session;
            $post = Yii::$app->request->post();
            $isSaved = false;
            try {
                $details = Details::findOne($id);
                $details->setAttribute('sum', $post['Details']['sum']);
                if($details->save()){
                    foreach ($post['Received'] as $item){
                        $model = new Received();
                        $model->setAttributes([
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'r_price' => $item['r_price'],
                            'status' => $model::STATUS_ACTIVE,
                            'details_id' => $id,
                            'receiver_id' => 1
                        ]);
                        if($model->save()){
                            $isSaved = true;
                        }else{
                            $isSaved = false;
                        }
                    }
                } else{
                    $flash->setFlash('danger', Yii::t('app', 'There are some mistakes during saving process!'));
                }
                if($isSaved){
                    $flash->setFlash('success', Yii::t('app', 'Successfully updated!'));
                    $transaction->commit();
                    return $this->render('received/index');
                } else{
                    $flash->setFlash('success', Yii::t('app', 'Please check all items. There are some mistakes!'));
                    $transaction->rollBack();
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } catch (\Exception $e){
                $flash->setFlash('danger', Yii::t('app', 'There are some mistakes. Please check all items!'));
                $transaction->rollBack();
            } catch (\Throwable $e){
                $flash->setFlash('danger', Yii::t('app', 'There are some mistakes. Please check all items!'));
                $transaction->rollBack();
            }
        }
        $data = Received::find()->where(['details_id' => $id])->all();
        $details = Details::findOne(['id' => $id]);
        $models = [new Received()];
        $hideIt = $details->status === $details::STATUS_ACTIVE ? false : true;
        return $this->render('information', ['data' => $data, 'models' => $models, 'details' => $details, 'hideIt' => $hideIt]);
    }
    public function actionMahsulotlar(){
        return $this->render('details');
    }
    public function actionMultipleReceive(){
        $details = new Details();
        $models = [new Received()];
        $request = Yii::$app->request;
        if($request->isPost && $details->load($request->post())){
            $details->setAttributes([
                'status' => $details::STATUS_ACTIVE,
                'date' => date('Y-m-d h:i:s'),
            ]);
            $details->setAttribute('department_id', 1);
            $transaction = Yii::$app->db->beginTransaction();
            $isSaved = false;
            try {
                if($details->save()){
                    foreach ($request->post()['Received'] as $product){
                        $model = new Received();
                        $model->setAttributes([
                            'receiver_id' => 1,
                            'product_id' => $product['product_id'],
                            'quantity' => $product['quantity'],
                            'r_price' => $product['r_price'],
                            'details_id' => $details->id,
                            'status' => $model::STATUS_ACTIVE
                        ]);
                        if($model->save()){
                            $isSaved = true;
                        } else{
                            $isSaved = false;
                        }
                    }
                    $flash = Yii::$app->session;
                    if($isSaved){
                        $transaction->commit();
                        $flash->setFlash('success', 'Items successfully created!');
                        return $this->redirect(['details/index']);
                    } else{
                        $transaction->rollBack();
                        $flash->setFlash('danger', 'Please check all items before insert. Because there are some mistakes.');
                        return $this->redirect(Yii::$app->request->referrer);
                    }
                }
            } catch (\Exception $e){
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e){
                $transaction->rollBack();
                throw $e;
            }
        }
        return $this->render('qabuluchun', ['models' => $models, 'details' => $details]);
    }
    public function actionMultipleUpdate($id){
        $details = Details::findOne($id);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;
        if(Yii::$app->request->isPost){
            $transaction = Yii::$app->db->beginTransaction();
            $details_array = $post['Details'];
            $models_array = $post['Received'];
            $isSaved = true;
            $message = '';
            $errorMessage = 'There are some mistakes!';
            try {
                $details->setAttributes([
                    'contragent_id' => $details_array['contragent_id'],
                    'sum' => $details_array['sum'],
                    'status' => $details::STATUS_ACTIVE,
                    'date' => $details->date,
                ]);
                $details->setAttribute('department_id', 1);
                if($details->save()){
                    Received::deleteAll(['details_id' => $details->id]);
                    foreach ($models_array as $model_items){
                        $model = new Received();
                        $model->setAttributes([
                            'product_id' => $model_items['product_id'],
                            'quantity' => $model_items['quantity'],
                            'r_price' => $model_items['r_price'],
                            'receiver_id' => 1,
                            'details_id' => $details->id,
                            'status' => $model::STATUS_ACTIVE
                        ]);
                        if(!$model->save()){
                            $session->setFlash('danger', $errorMessage);
                            $transaction->rollBack();
                            return $this->render('qabuluchun');
                        }
                        $message = "Successfully updated!";
                    }
                    if ($isSaved){
                        $transaction->commit();
                        $session->setFlash('success', $message);
                        return $this->redirect(['received/info', 'id' => $id]);
                    }
                }
            } catch (\Exception $e){
                $session->setFlash('danger', 'Please check all items!');
                $transaction->rollBack();
            } catch (\Throwable $e){
                $session->setFlash('danger', 'Please check all items!');
                $transaction->rollBack();
            }
        }
        $models = Received::findAll(['details_id' => $details->id]);
        return $this->render('qabuluchun', ['models' => $models, 'details' => $details]);
    }
    /**
     * @return string|Response
     */
    public function actionQabul(){
        $model = new ReceiveForm();
        if($model->load(Yii::$app->request->post())){
            if(Received::saveData($model)){
                Yii::$app->session->setFlash('success', "Successfully added!");
            } else{
                Yii::$app->session->setFlash('danger', "There are some mistakes! During the saving process.");
            }
        }
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('qabulformasi', ['model' => $model]);
        }
        return $this->redirect(['index']);
    }
    public function actionKirim(){
        if(Yii::$app->request->isPost){https://cdn.mos.cms.futurecdn.net/dXbexHnmybaqTTsYzo8caD-970-80.jpg.webp
            $array = [];
            if(count(Yii::$app->request->post()) > 0){
                foreach (Yii::$app->request->post() as $arrayItem){
                    array_push($array, $arrayItem);
                }
                $saved = false;
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $query = Received::findAll(['details_id' => $array]);
                    foreach ($query as $queryItem){
                        $queryItem->setAttribute('status', Received::STATUS_INACTIVE);
                        if($queryItem->save()){
                            $productBalance = null;
                            if($productBalance = ProductBalance::findOne(['product_id' => $queryItem->product_id])){
                                $productBalance->setAttributes([
                                    'quantity' => $productBalance->quantity + $queryItem->quantity,
                                    'price' => $queryItem->r_price,
                                    'status' => $queryItem::STATUS_ACTIVE
                                ]);
                            } else{
                                $productBalance = new ProductBalance();
                                $productBalance->setAttributes([
                                    'product_id' => $queryItem->product_id,
                                    'price' => $queryItem->r_price,
                                    'quantity' => $queryItem->quantity,
                                    'status' => $productBalance::STATUS_ACTIVE,
                                    'department_id' => 1
                                ]);
                            }
                            if($productBalance->save()){
                                $saved = true;
                            } else{
                                $saved = false;
                                break;
                            }
                        } else{
                            $saved = false;
                            break;
                        }
                    }
                    if($saved){
                        $saved = false;
                        foreach ($query as $queryItem){
                            if($queryItem->details->status === Details::STATUS_ACTIVE){
                                $details = Details::findOne($queryItem->details_id);
                                $details->setAttribute('status', Details::STATUS_INACTIVE);
                                if($details->save()){
                                    $saved = true;
                                } else{
                                    $saved = false;
                                    break;
                                }
                            }
                        }
                        if($saved){
                            $transaction->commit();
                            Yii::$app->session->setFlash('success', 'Successfully added!');
                            return $this->redirect(['index']);
                        } else{
                            Yii::$app->session->setFlash('danger', 'There are some mistakes! Please check all items and try again.');
                            $transaction->rollBack();
                            return $this->redirect(['index']);
                        }
                    } else {
                        Yii::$app->session->setFlash('danger', 'There are some mistakes! Please check all items and try again.');
                        $transaction->rollBack();
                        return $this->redirect(['index']);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    Yii::$app->session->setFlash('danger', 'There are some mistakes! Please check all items and try again.');
                    $transaction->rollBack();
                    throw $e;
                }
            } else{
                Yii::$app->session->setFlash('danger', Yii::t('app', 'Please, select at least one item!'));
                return $this->redirect(['index']);
            }
        }
        $data = Received::find()->where(['status' => Received::STATUS_ACTIVE])->all();
        $details = Details::find()->where(['status' => Details::STATUS_ACTIVE])->all();
        return $this->render('qabul', ['data' => $data, 'details' => $details]);
    }
    public function actionSaveAndFinish($id){
        $details = Details::find()->where(['id' => $id])->asArray()->one();
        $models = Received::find()->where(['details_id' => $id])->asArray()->all();
        $transaction = Yii::$app->db->beginTransaction();
        $session = Yii::$app->session;
        $errorMessage = 'Xa,xa-xi';
        $message = 'Successfully added!';
        $saved = false;
        try {
            foreach ($models as $key => $model){
//                if($product = ProductBalance::findOne([
//                    'product_id' => $model['product_id'],
//                    'department_id' => $details['department_id']
//                ])){
//                    $product->setAttributes([
//                        'quantity' => $product->quantity + $model['quantity'],
//                        'price' => $model['r_price'],
//                        'status' => $product::STATUS_ACTIVE
//                    ]);
//                    if($product->save()){
                        $item = Received::findOne($model['id']);
                        $item->setAttribute('status', Received::STATUS_PRICE_NOT_SPECIFIED);
                        if($item->save()){
                            if(count($models) - 1 === $key){
                                $detail  = Details::findOne($id);
                                $detail->setAttribute('status', Details::STATUS_INACTIVE);
                                $detail->save();
                                if($detail->save()){
                                    $saved = true;
                                }
                            }
                        }
//                    }
//                } else{
//                    $product = new ProductBalance();
//                    $product->setAttributes([
//                        'quantity' => $model['quantity'],
//                        'price' => $model['r_price'],
//                        'status' => $product::STATUS_ACTIVE,
//                        'product_id' => $model['product_id'],
//                        'department_id' => $details['department_id']
//                    ]);
//                    if($product->save()){
//                        $item = Received::findOne($model['id']);
//                        $item->setAttribute('status', Received::STATUS_INACTIVE);
//                        if($item->save()){
//                            if(count($models) - 1 === $key){
//                                $detail  = Details::findOne($id);
//                                $detail->setAttribute('status', Details::STATUS_INACTIVE);
//                                $detail->save();
//                                if($detail->save()){
//                                    $saved = true;
//                                }
//                            }
//                        }
//                    }
//                }
            }
            if($saved === true){
                $session->setFlash('success' , $message);
                $transaction->commit();
                return $this->redirect(['received/info', 'id' => $id]);
            } else{
                $session->setFlash('danger', $errorMessage);
                $transaction->rollBack();
            }
        } catch (\Exception $e){
            $session->setFlash('danger', $errorMessage);
            $transaction->rollBack();
        } catch (\Throwable $e){
            $session->setFlash('danger', $errorMessage);
            $transaction->rollBack();
        }
        return $this->redirect(['received/info', 'id' => $id]);
    }

    public function actionView($id)
    {
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
                'hideIt' => true
            ]);
        }
        return $this->render('view', [
        'model' => $this->findModel($id),
    ]);
    }

    /**
     * Creates a new Received model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Received();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax){
            $result['status'] = false;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $result['status'] = true;
                return false;
            }
            $result['content'] = $this->renderAjax('_form', ['model' => $model]);
            return $result;
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Received model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new ReceiveForm();
        $data = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(Received::updateData($model, $data)){
                Yii::$app->session->setFlash('success', "Successfully updated!");
            } else{
                Yii::$app->session->setFlash('danger', "There are some mistakes! During the saving process.");
            }
            return $this->redirect(['index']);
        }

        $model->setAttributes([
            'contragent' => $data->details->contragent_id,
            'product' => $data->product_id,
            'receiver' => $data->receiver_id,
            'quantity' => $data->quantity,
            'price' => $data->r_price,
            'sum' => $data->details->sum,

        ]);
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update', [
                'model' => $model,
                'hideIt' => true,
                'status' => $data->status
            ]);
        }
        return $this->render('update', ['model' => $model]);
    }

    /**
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $isAjax = Yii::$app->request->isAjax;
        Yii::$app->response->format = Response::FORMAT_JSON;
        if($isAjax){
            $isActive = Details::findOne(['status' => Details::STATUS_ACTIVE, 'id' => $id]);
            if($isActive !== null){
                if(Received::deleteAll(['details_id' => $id])){
                    if($isActive->delete()){
                        return Received::getResult(true);
                    }
                }
            }
        }
        return Received::getResult(false);
    }

    /**
     * Finds the Received model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Received the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Received::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
