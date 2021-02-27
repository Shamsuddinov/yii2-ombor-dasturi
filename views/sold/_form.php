<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sold */
/* @var $action app\models\Sold */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sold-form">

    <?php if ($action === 'create'): ?>
        <?php $form = ActiveForm::begin([
            'action' => 'save-and-finish'
        ]); ?>
    <?php else: ?>
        <?php $form = ActiveForm::begin(); ?>
    <?php endif; ?>

    <div class="tabular-items">
        <?= $form->field($model, 'tabular')->widget(MultipleInput::class, [
            'iconSource' => 'fa',
            'cloneButton' => false,
            'sortable' => false,
            'min' => 1,
            'addButtonPosition' => MultipleInput::POS_ROW,
            'rendererClass' => \unclead\multipleinput\renderers\TableRenderer::className(),
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
                    'title' => Yii::t('app', 'Product'),
                    'type' => \kartik\select2\Select2::className(),
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => 'Select product'
                        ],
                        'data' => \app\models\Product::getProductAll(),
                        'pluginEvents' => [
                            "change" => "function(thisItem) { jQuery(document).ready(function($) { $.fn.itemSelected(thisItem); }); }",
                        ],
                    ],
                    'headerOptions' => [
                        "style" => "border: none; width: 33%;"
                    ]
                ],
                [
                    'name' => 'quantity',
                    'title' => Yii::t('app', 'Quantity'),
                    'options' => [
                        'required' => true,
                        'placeholder' => "Nechta olmoqchisiz",
                        'class' => 'd-none form-control input-items',
                        'type' => 'number',
                        'autocomplete' => false,
                    ],
                    'headerOptions' => [
                        "style" => "border: none; width: 33%;"
                    ]
                ],
                [
                    'name' => 'custom',
                    'title' => Yii::t('app', 'Price and quantity'),
                    'options' => [
                        'required' => true,
                        'placeholder' => "Nechta olmoqchisiz"
                    ],
                    'inputTemplate' => "<div class='container'>
                                        <div class='row'>
                                           <div class='col-6 input-price'></div>
                                           <div class='col-6 input-quantity'></div>
                                        </div>
                                    </div>",
                    'headerOptions' => [
                        "style" => "border: none; width: 30%;"
                    ]
                ],
            ],
        ])->label(false); ?>
        <div class='row'>
            <div class='offset-8 col-4 input-summary d-none'></div>
        </div>
    </div>

    <div class="summary-list d-none" style="font-size: 13px;">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nomi</th>
                    <th>Soni</th>
                    <th>Narxi</th>
                    <th>Summasi</th>
                </tr>
            </thead>
            <tbody class="table-rows">

            </tbody>
            <tbody>
            <tr>
                <td colspan="1"><b>Jami: </b></td>
                <td id="total-count"></td>
                <td colspan="2" style="text-align: right" id="total-sum"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <button id="show-check" class="btn btn-success"><?= Yii::t('app', 'Save') ?></button>
        <button id="edit-some-items" class="btn btn-info d-none"><?= Yii::t('app', 'Edit') ?></button>
        <?= Html::submitButton(Yii::t('app', 'Save and finish'), ['class' => 'btn btn-success d-none', 'id' => 'save-and-finish']) ?>
        <?= Html::submitButton(Yii::t('app', 'Print check'), ['class' => 'btn btn-success d-none', 'id' => 'printIt']) ?>
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
        let url = "$url" + "?id=" + productId;
        $.ajax({
            url: url,
            type: "POST",
            success: function (response) {
                if(response.status){
                    let product = response.result;
                    if(product.quantity > 0 && product.price > 0){
                        price_and_quantity.find('.input-price').html("<div>$price_text : " + "<span class='input-price-value'>" + Math.floor(product.price * 1.1) + "</span>"  + "</div>");
                        price_and_quantity.find('.input-quantity').html("<div>$quantity_text : " + "<span class='input-quantity-value'>" + Math.floor(product.quantity) + "</span>" + "</div>");
                        quantity_field.attr('max', Math.floor(product.quantity));
                        if(quantity_field.hasClass('d-none')){
                            quantity_field.removeClass('d-none');
                        } else {
                            $.fn.changeSummary();
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
                            quantity_field.val(0);
                            quantity_field.addClass('d-none');
                        }
                    }
                } else {
                    price_and_quantity.find('.input-quantity').html("<div style='font-weight:bold;'>Bu omborda bunday mahsulot yo'q.</div>");      
                    price_and_quantity.find('.input-price').html("<div style='font-weight:bold;'></div>");      
                    if(!quantity_field.hasClass('d-none')){
                        quantity_field.val(0);
                        quantity_field.addClass('d-none').trigger('change');
                    }
                }
            }
        });
    }
    $.fn.changeSummary = function() {
        let sum = 0;
        let totalCount = 0;
        let table_rows = $('.table-rows');
        if(table_rows.children().length !== 0){
            table_rows.empty();
        }
        $('.multiple-input-list__item').map((id, item) => {
            let this_item = $(item);
            let product_name = this_item.find('.select2-selection__rendered').text();
            let quantity = this_item.find(".input-quantity-value").text() * 1;
            let price = this_item.find('.input-price-value').text() * 1;
            let input_field = this_item.find('.input-items');
            let input_value = input_field.val() * 1;
            if(quantity >= input_value){
                input_field.removeAttr('css').css('color', '#495057');
                sum += input_value * price;
                totalCount += input_value;
                table_rows.append(
                    "<tr> <td>"+ product_name +"</td> <td>" + input_value + "</td> <td>" + price + "</td> <td>" + input_value * price + "</td> </tr>"
                );
            } else {
                input_field.val(quantity).removeAttr('css').css('color', 'red');
                sum += quantity * price;
                totalCount += quantity;
                table_rows.append(
                    "<tr> <td>"+ product_name +"</td> <td>" + quantity + "</td> <td>" + price + "</td> <td>" + quantity * price + "</td> </tr>"
                );
            }
        });
        $('#total-count').text(totalCount);
        $('#total-sum').text(sum);
        $('.input-summary').html("Jami summa: " + sum).removeClass('d-none');      
    }
    
    $('#w1').on('afterDeleteRow', function(event) {
        $.fn.changeSummary();
    })
    $('.form-group').delegate('#show-check, #edit-some-items', 'click', function(event) {
        event.preventDefault();
        let input_items = $('.multiple-input-list__item');
        if(input_items.find('.input-items').hasClass('d-none') || (input_items.find('.input-items').val() === "" || input_items.find('.input-items').val() <= 0)){
            input_items.find('.selection').focus();
        } else {
            $('#edit-some-items, .summary-list, .tabular-items, #save-and-finish, #show-check, #printIt').toggleClass('d-none');         
        }
    });
    $('.sold-form').delegate('.input-items', 'blur', function() { 
        $.fn.changeSummary();
    });
    $('#printIt').click(function() {
       $.fn.printInvoice();
    });
    $.fn.printInvoice = function (){
         $('#save-and-finish, #edit-some-items, form#Received, button#printIt, footer.site-footer, aside.left-panel, div.clearfix, header#header').remove();                     
         $('div.right-panel').removeAttr('id').removeClass('right-panel');                     
         $('div.animated, div.card').removeAttr('id').removeAttr('class');                     
         window.print();
         location.reload();
    }
JS;
$this->registerJs($js);
?>
