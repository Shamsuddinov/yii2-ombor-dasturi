<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sold */

$this->title = 'Create Sold';
$this->params['breadcrumbs'][] = ['label' => 'Solds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sold-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
