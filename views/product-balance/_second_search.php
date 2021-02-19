<?php

use app\models\Product;
use kartik\daterange\DateRangePicker;
use kartik\field\FieldRange;
use kartik\money\MaskMoney;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use \kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReceivedSearch */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin([
    'action' => ['product-balance-report'],
    'method' => 'get',
]); ?>
<div class="row">
    <div class="col-6">
        <?= $form->field($model, 'department_id')->widget(Select2::className(), [
            'data' => ArrayHelper::map(\app\models\Department::find()->asArray()->all(), 'id', 'name'),
            'theme' => Select2::THEME_BOOTSTRAP,
            'size' => Select2::SIZE_SMALL,
            'options' => ['placeholder' => 'Filialni tanlang', 'class' => 'input-items'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);  ?>
    </div>
    <div class="col-6">
        <?= $form->field($model, 'product_id')->widget(Select2::className(), [
            'data' => Product::getProductAll(),
            'theme' => Select2::THEME_BOOTSTRAP,
            'size' => Select2::SIZE_SMALL,
            'options' => ['placeholder' => 'Mahsulot nomini kiriting', 'id' => 'product_id', 'class' => 'input-items'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);  ?>
    </div>
    <div class="col-6">
        <?= $form->field($model, 'quantity')->textInput([
            'type' => 'number',
            'style' => 'height: 30px; font-size:12px;',
            'min' => 0
        ]) ?>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'from_amount')->textInput([
                    'type' => 'number',
                    'style' => 'height: 30px; font-size:12px;',
                    'min' => 0
                ]) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'to_amount')->textInput([
                    'type' => 'number',
                    'style' => 'height: 30px; font-size:12px;',
                    'min' => 0
                ]) ?>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
</div>

<?php ActiveForm::end(); ?>

