<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Received */

$this->title = 'Create Received';
$this->params['breadcrumbs'][] = ['label' => 'Receiveds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="received-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
