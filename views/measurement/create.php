<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Measurement */

$this->title = Yii::t('app', 'Create Measurement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Measurements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="measurement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
