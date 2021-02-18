<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sold */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sold-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tabular')->widget(MultipleInput::class, [
        'iconSource' => 'fa',
        'cloneButton' => false,
        'sortable' => false,
        'min' => 1,
        'addButtonPosition' => MultipleInput::POS_ROW,
        'rendererClass' => \unclead\multipleinput\renderers\ListRenderer::className(),
        'layoutConfig' => [
            'offsetClass' => 'col-sm-offset-4',
            'labelClass' => 'col-sm-4',
            'wrapperClass' => 'col-sm-12',
            'errorClass' => 'col-sm-4'
        ],
        'addButtonOptions' => [
            'class' => 'add-close-button btn btn-sm btn-primary',
        ],
        'removeButtonOptions' => [
            'class' => 'add-close-button btn btn-sm btn-danger',
        ],
        'form' => $form,
        'columns' => [
            [
                'name' => 'product_id',
                'title' => 'Product',
                'type' => \kartik\select2\Select2::className(),
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Select product'
                    ],
                    'data' => \app\models\Product::getProductAll(),
                    'pluginEvents' => [
                        "change" => "function(thisItem) { jQuery(document).ready(function($) { $.fn.itemSelected(thisItem); }); }",
                    ]
                ],
            ],
            [
                'name' => 'custom',
//                'title' => 'Quantity',
                'options' => [
                    'required' => true,
                    'placeholder' => "Nechta olmoqchisiz"
                ],
                'inputTemplate' => "<div class='container'>
                                        <div class='row'>
                                           <div class='col-6 input-price'></div>
                                           <div class='col-6 input-quantity'></div>
                                        </div>
                                    </div>"
            ],

        ],
    ])->label(false); ?>

    <!--    <? /*= $form->field($model, 'quantity')->textInput(['maxlength' => true]) */ ?>

    <? /*= $form->field($model, 's_price')->textInput(['maxlength' => true]) */ ?>

    <? /*= $form->field($model, 'seller_id')->textInput() */ ?>

    <? /*= $form->field($model, 'product_id')->textInput() */ ?>

    --><? /*= $form->field($model, 'department_id')->textInput() */ ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$url = \yii\helpers\Url::to(['sold/price-and-quantity']);
$js = <<<JS
    $.fn.itemSelected = function(thisItem) {
        let str = thisItem.target.id;
        let a = str.indexOf('r-') + 2;
        let b = str.indexOf('-product');
        let id = str.slice(a, b);
        let selected_item = "select#sold-tabular-"+ id +"-product_id";
        let productId = $(selected_item).val();
        let url = "$url" + "&id=" + productId;
        $.ajax({
            url: url,
            type: "POST",
            success: function (res) {
                console.log(res);
            }
        });
    }
JS;
$this->registerJs($js);
?>
