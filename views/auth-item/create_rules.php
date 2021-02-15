<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItem */
/* @var $models app\models\AuthItem */

$this->title = Yii::t('app', 'Create rules');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?= $this->render('_form', [
                        'model' => $model,
                        'rules' => true
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
