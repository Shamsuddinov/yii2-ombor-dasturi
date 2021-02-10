<?php

use app\models\Contragent;
use app\models\Product;
use kartik\money\MaskMoney;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Received */
/* @var $form ActiveForm */
/* @var $data */
?>

<div class="row p-5" style="overflow-x: hidden;">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin([
            'method' => 'POST',
            'id' => $model->formName()
        ]); ?>
            <?= $form->field($model, 'product')->widget(Select2::className(), [
                'data' => Product::getProductAll(),
                'options' => ['placeholder' => 'Mahsulot nomini kiriting', 'id' => 'product_id'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]); ?>
            <?= $form->field($model, 'quantity')->input('number', ['class' => 'form-control miqdor', 'autocomplete' => 'off'])?>
            <?= $form->field($model, 'price')->widget(MaskMoney::classname(), [
                'pluginOptions' => [
                    'prefix' => 'UZS ',
                    'precision' => 0
                ]
            ]);?>
            <div class="form-group">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div><!-- received-qabulformasi -->
<?php
$js = <<<JS
        jQuery(document).ready(function($){
            $('.miqdor').change(function() {
                let val = +$(this).val();
                if (val === 0) {
                    $(this).val('');
                }
            });
        });
JS;
$this->registerJs($js);
?>