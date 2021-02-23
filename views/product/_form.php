<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <?php $form = ActiveForm::begin([
        'method' => 'POST',
        'id' => $model->formName(),
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'name', 'required' => true]) ?>

    <?= $form->field($model, 'type_id')->widget(Select2::classname(), [
        'data' => $model::getModelAsArray(new \app\models\ProductType()),
        'options' => ['placeholder' => Yii::t('app', 'Select the product type'), 'id' => 'type_id', 'required' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'brand_id')->widget(Select2::classname(), [
        'data' => $model::getModelAsArray(new \app\models\Brand()),
        'options' => ['placeholder' => Yii::t('app', 'Select brand name'), 'id' => 'brand_id', 'required' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'measurement_id')->widget(Select2::classname(), [
        'data' => $model::getModelAsArray(new \app\models\Measurement()),
        'options' => ['placeholder' => Yii::t('app', 'Select brand name'), 'id' => 'measurement_id', 'required' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'properties')->textarea(['rows' => 3]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
    $js = <<<JS
    jQuery(document).ready(function($) {
        console.log($('#Product'))
    });
JS;
    $this->registerJs($js);
?>