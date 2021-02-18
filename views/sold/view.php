<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sold */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12">
<?php if(!Yii::$app->request->isAjax): ?>
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
<?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'date',
                            'quantity',
                            's_price',
                            'seller_id',
                            'product_id',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
<?php if(!Yii::$app->request->isAjax): ?>
    </div>
<?php endif; ?>
</div>
