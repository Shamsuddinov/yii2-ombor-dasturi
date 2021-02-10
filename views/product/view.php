<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12">
<?php if(!Yii::$app->request->isAjax):?>
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
<?php endif;?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label' => Yii::t('app', 'Product ID :'),
                            'value' => $model->id
                        ],
                        [
                            'label' => Yii::t('app', 'Product name :'),
                            'value' => $model->name
                        ],
                        [
                            'label' => Yii::t('app', 'Category :'),
                            'value' => $model->type->name
                        ],
                        [
                            'label' => Yii::t('app', 'Brand name :'),
                            'value' => $model->brand->name
                        ],
                        [
                            'label' => Yii::t('app', 'Quantity :'),
                            'value' => $model->quantity
                        ],
                        [
                            'label' => Yii::t('app', 'Properties :'),
                            'value' => function ($data){
                                return $data->properties == null ? Yii::t('app', 'Empty') : $data->properties;
                            }
                        ],
                        [
                            'label' => Yii::t('app', 'Price :'),
                            'value' => $model->r_price
                        ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
    <?php if(!Yii::$app->request->isAjax):?>
</div>
<?php endif;?>
</div>
