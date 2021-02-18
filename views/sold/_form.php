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
            [
                'name' => 'quantity',
                'options' => [
                    'required' => true,
                    'placeholder' => "Nechta olmoqchisiz",
                    'class' => 'd-none form-control input-items',
                    'type' => 'number',
                    'autocomplete' => false
                ],
            ],
        ],
    ])->label(false); ?>
    <div class='row'>
        <div class='offset-8 col-4 input-summary d-none'></div>
    </div>
    <!--    <? /*= $form->field($model, 'quantity')->textInput(['maxlength' => true]) */ ?>

    <? /*= $form->field($model, 's_price')->textInput(['maxlength' => true]) */ ?>

    <? /*= $form->field($model, 'seller_id')->textInput() */ ?>

    <? /*= $form->field($model, 'product_id')->textInput() */ ?>

    <? /*= $form->field($model, 'department_id')->textInput() */ ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$url = \yii\helpers\Url::to(['sold/price-and-quantity']);
$price_text = Yii::t('app', 'Price');
$quantity_text = Yii::t('app', 'Quantity');
$js = <<<JS
    $.fn.itemSelected = function(thisItem) {
        let str = thisItem.target.id;
        let a = str.indexOf('r-') + 2;
        let b = str.indexOf('-product');
        let id = str.slice(a, b);
        let productId = $("select#sold-tabular-"+ id +"-product_id").val();
        let price_and_quantity = $("div.field-sold-tabular-"+ id +"-custom");
        let quantity_field = $("#sold-tabular-"+ id +"-quantity");
        let url = "$url" + "&id=" + productId;
        $.ajax({
            url: url,
            type: "POST",
            success: function (product) {
                if(product !== 'false'){
                    if(product.quantity > 0 && product.price > 0){
                        price_and_quantity.find('.input-price').html("<div style='font-weight:bold;'>$price_text : " + Math.floor(product.price)  + "</div>");
                        price_and_quantity.find('.input-quantity').html("<div style='font-weight:bold;'>$quantity_text : " + Math.floor(product.quantity) + "</div>");   
                        quantity_field.attr('max', Math.floor(product.quantity));
                        if(quantity_field.hasClass('d-none')){
                            quantity_field.removeClass('d-none');
                        }
                    } else {
                        if(product.quantity === 0){
                            price_and_quantity.find('.input-quantity').html("<div style='font-weight:bold;'>Bu mahsulot omborda qolmagan.</div>");
                            price_and_quantity.find('.input-price').html("<div style='font-weight:bold;'></div>");
                        }
                        if(product.price <= 0){
                            price_and_quantity.find('.input-quantity').html("<div style='font-weight:bold;'></div>");      
                            price_and_quantity.find('.input-price').html("<div style='font-weight:bold;'>Iltimos administratorga xatolik haqida xabar bering.</div>");      
                        }
                        if(!quantity_field.hasClass('d-none')){
                            quantity_field.addClass('d-none');
                        }
                    }
                } else {
                    price_and_quantity.find('.input-quantity').html("<div style='font-weight:bold;'>Bu omborda bunday mahsulot yo'q.</div>");      
                    price_and_quantity.find('.input-price').html("<div style='font-weight:bold;'></div>");      
                    if(!quantity_field.hasClass('d-none')){
                        quantity_field.addClass('d-none');
                    }
                }
            }
        });
    }
JS;
$this->registerJs($js);
?>
