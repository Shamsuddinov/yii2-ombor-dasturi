<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12">
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
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'first_name',
                            'sur_name',
                            'username',
                            [
                                'attribute' => 'rules',
                                'value' => function($model){
                                    $rules = '';
                                   foreach ($model->rules as $rule){
                                       $rules .= "<div style='margin: 0 2px; font-size: 12px; padding: 0 10px 0 10px;' class='btn btn-success'>".$rule['item_name']."</div>";
                                   }
                                   return $rules;
                                },
                                'format' => 'raw'
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
