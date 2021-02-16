<?php

namespace app\controllers;

use app\models\AuthItemChild;
use app\models\BaseModel;
use Exception;
use Faker\Provider\Base;
use Yii;
use app\models\AuthItem;
use app\models\AuthItemSearch;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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

    public function actionUpdateRules($id){
        $model = $this->findModel($id);
        $model_and_items = AuthItem::find()->where(['and', ['type' => AuthItem::TYPE_RULE], ['name' => $id]])->joinWith('authItemChildren')->asArray()->all();
        $all_permissions = $this->findAllPermissions();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();
            $saved = false;
            try {
                if($model->load($post) && $model->save()){
                    if(AuthItemChild::deleteAll(['parent' => $model->name])){
                        foreach ($post['AuthItemChild'] as $child_elements){
                            foreach ($child_elements as $child_element){
                                $new_rules = new AuthItemChild();
                                $new_rules->setAttributes([
                                    'parent' => $model->name,
                                    'child' => $child_element
                                ]);
                                if($new_rules->save()){
                                    $saved = true;
                                } else{
                                    $saved = false;
                                    $transaction->rollBack();
                                    BaseModel::getMessages(false);
                                    break;
                                }
                            }
                        }
                    }
                }
                if($saved){
                    BaseModel::getMessages(true, 'updated');
                    $transaction->commit();
                    return $this->redirect(['auth-item/index-rules']);
                } else{
                    BaseModel::getMessages(false);
                    $transaction->rollBack();
                }
            } catch (Exception | \Throwable $exception){
                $transaction->rollBack();
            }
        }
        return $this->render('update_rules', [
            'model' => $model,
            'all_permissions' => $all_permissions,
            'model_and_items' => $model_and_items[0]['authItemChildren']
        ]);
    }

    public function actionCreateRules(){
        $model = new AuthItem();
        $post = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        $saved = false;
        if(Yii::$app->request->isPost && $model->load($post)){
            $model->setAttribute('type', $model::TYPE_RULE);
            if($model->save()){
                foreach ($post['AuthItemChild'] as $child_elements){
                    foreach ($child_elements as $child_element){
                        $add_items = new AuthItemChild();
                        $add_items->setAttributes([
                            'parent' => $model['name'],
                            'child' => $child_element
                        ]);
                        if($add_items->save()){
                            $saved = true;
                            BaseModel::getMessages(true, 'added');
                        } else {
                            $saved = false;
                            BaseModel::getMessages(false);
                            $transaction->rollBack();
                        }
                    }
                }

                if($saved){
                    $transaction->commit();
                    BaseModel::getMessages(true, 'added');
                    return $this->redirect(['auth-item/index-rules']);
                } else{
                    $transaction->rollBack();
                    BaseModel::getMessages(false);
                }
            } else{
                BaseModel::getMessages(false);
                $transaction->rollBack();
            }
            return $this->redirect(['auth-item/index-rules']);
        }
        $all_permissions = $this->findAllPermissions();

        return $this->render('create_rules', [
            'model' => $model,
            'all_permissions' => $all_permissions
        ]);
    }

    public function actionIndexRules(){
        $authItem = AuthItem::find()->where(['type' => AuthItem::TYPE_RULE])->joinWith('authItemChildren');
        $dataprovider = new ArrayDataProvider([
            'allModels' => $authItem->asArray()->all()
        ]);
        return $this->render('index_rules', [
            'rules' => $dataprovider
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
                            'type' => $new_model::TYPE_PERMISSION,
                            'data' => $model->name
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
                    BaseModel::getMessages(true, 'created');
                } else {
                    $transaction->rollBack();
                    BaseModel::getMessages(false);
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
        $models = AuthItem::find()->where(['and', ['data' => $id], ['type' => AuthItem::TYPE_PERMISSION]])->all();
        foreach ($models as $model_item){
            $data_len = strlen($model_item->data);
            $model_item->name = substr($model_item->name, $data_len + 1);
        }
        $model->tabular = $models;
        if (Yii::$app->request->isPost) {
            $transaction = Yii::$app->db->beginTransaction();
            $post = Yii::$app->request->post();
            $saved = false;
            try {
                if($model->load($post) && $model->save()){
                    foreach ($models as $old_model_items){
                        $old_model_items->delete();
                    }
                    foreach ($post['AuthItem']['tabular'] as $item){
                        $new_item = new AuthItem();
                        $new_item->setAttributes([
                            'name' => $model->name."/".$item['name'],
                            'description' => $item['description'],
                            'type' => $new_item::TYPE_PERMISSION,
                            'data' => $model->name
                        ]);
                        if($new_item->save()){
                            $saved = true;
                            BaseModel::getMessages(true, 'updated');
                        } else{
                            $saved = false;
                            BaseModel::getMessages(false);
                            break;
                        }
                    }
                }
                if($saved){
                    $transaction->commit();
                } else{
                    $transaction->rollBack();
                }
            }catch (Exception | \Throwable $exception){
                $transaction->rollBack();
            }
            return $this->redirect(['index']);
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
        $model = $this->findModel($id);
        $transaction = Yii::$app->db->beginTransaction();
        $saved = false;
        try {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->type === AuthItem::TYPE_CONTROLLER_NAME){
                $models = AuthItem::find()->where(['and', ['data' => $id], ['type' => AuthItem::TYPE_PERMISSION]])->all();
                foreach ($models as $model_item){
                    if($model_item->delete()){
                        $saved = true;
                    } else {
                        $saved = false;
                        break;
                    }
                }
            }
            if ($model->type === AuthItem::TYPE_RULE){
                if(AuthItemChild::deleteAll(['parent' => $model->name])){
                    $saved = true;
                } else {
                    $saved = false;
                }
            }

            if($saved){
                if($model->delete()){
                    $transaction->commit();
                    return BaseModel::getResult(true);
                } else {
                    $transaction->rollBack();
                    return BaseModel::getResult(false);
                }
            } else {
                $transaction->rollBack();
                return BaseModel::getResult(false);
            }
        } catch (Exception | \Throwable $exception){
            $transaction->rollBack();
            return BaseModel::getResult(false);
        }
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
    protected function findAllPermissions(){
        $all_permissions = AuthItem::find()->where(['type' => AuthItem::TYPE_CONTROLLER_NAME])->asArray()->all();
        foreach ($all_permissions as $key => $permission){
            $items = AuthItem::find()->where(['and', ['type' => AuthItem::TYPE_PERMISSION], ['data' => $permission['name']]])->asArray()->all();
            ArrayHelper::setValue($permission, 'sub_items', $items);
            $all_permissions[$key] = $permission;
        }
        return $all_permissions;
    }
}
