<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Measurement */

$this->title = Yii::t('app', 'Create Measurement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Measurements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <?php if(!Yii::$app->request->isAjax):?>
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
        </div>
        <?php endif;?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
                </div>
            </div>
        </div>
        <?php if(!Yii::$app->request->isAjax):?>
    </div>
<?php endif;?>
</div>