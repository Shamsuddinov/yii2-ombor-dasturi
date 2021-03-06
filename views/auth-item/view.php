<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->name], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'type',
                        'description:ntext',
                    ],
                ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>