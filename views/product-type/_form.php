<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-type-form">

    <?php $form = ActiveForm::begin([
        'method' => 'POST',
        'id' => $model->formName()
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_id')->widget(Select2::classname(), [
        'data' => $model::getModelAsArray(new \app\models\ProductType(), 'id', 'name', [
                'cat_id' => 0
        ]),
        'options' => [
                'placeholder' => Yii::t('app', 'Select main category name if this category is sub category'),
            'id' => 'cat_id',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
