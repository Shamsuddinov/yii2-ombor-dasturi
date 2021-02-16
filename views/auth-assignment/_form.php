<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->widget(Select2::classname(), [
        'data' => \app\models\AuthItem::getAllAuthRules() ,
        'options' => ['placeholder' => 'Rules', 'id' => 'item_name'],
        'pluginOptions' => [
            'allowClear' => true
        ]])->label('Rules :') ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => \app\models\Users::getAllUsers() ,
        'options' => ['placeholder' => 'Foydalanuvchilar', 'id' => 'user_id'],
        'pluginOptions' => [
            'allowClear' => true
        ]])->label('Foydalanuvchilar :') ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
