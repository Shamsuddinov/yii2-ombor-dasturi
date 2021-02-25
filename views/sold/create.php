<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sold */

$this->title = 'Create Sold';
$this->params['breadcrumbs'][] = ['label' => 'Solds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
        </div>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?= $this->render('_form', [
                        'model' => $model,
                        'action' => Yii::$app->controller->action->id
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
