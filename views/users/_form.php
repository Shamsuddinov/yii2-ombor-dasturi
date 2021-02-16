<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sur_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rules')->widget(Select2::classname(), [
        'data' => \app\models\AuthItem::getAllAuthRules(),
        'theme' => Select2::THEME_BOOTSTRAP,
        'size' => Select2::SMALL,
        'options' => ['placeholder' => 'Rules', 'id' => 'item_name', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true
        ]])->label('Rules :') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
