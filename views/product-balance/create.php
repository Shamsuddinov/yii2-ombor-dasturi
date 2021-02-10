<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductBalance */

$this->title = Yii::t('app', 'Create Product Balance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
