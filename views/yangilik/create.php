<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Yangilik */

$this->title = 'Create Yangilik';
$this->params['breadcrumbs'][] = ['label' => 'Yangiliks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yangilik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
