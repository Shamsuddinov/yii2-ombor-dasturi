<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Received */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="received-form">

    <?php $form = ActiveForm::begin(['id' => 'superform']); ?>

    <?= $form->field($model, 'product_id')->widget(Select2::classname(), [
        'data' => \app\models\Product::getProductAll(),
        'options' => ['placeholder' => 'Mahsulotni tanlang', 'id' => 'product_id'],
        'pluginOptions' => [
            'allowClear' => true
        ]])->label('Mahsulotni tanlang :') ?>

    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r_price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'details_id')->widget(Select2::classname(), [
        'data' => \app\models\Product::getProductAll(),
        'options' => ['placeholder' => 'Mahsulotni tanlang', 'id' => 'product_id'],
        'pluginOptions' => [
            'allowClear' => true
        ]])->label('Mahsulotni tanlang :') ?>
<!--    --><?//= $form->field($model, 'details_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'id' => 'saveButton']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
