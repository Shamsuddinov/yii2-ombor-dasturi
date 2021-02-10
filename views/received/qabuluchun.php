<?php

use app\models\Contragent;
use app\models\Product;
use kartik\select2\Select2;
use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Receive multiple elements';
/**
 * @var $details
 * @var $form
 * @var $models
 */
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?php $form = ActiveForm::begin(['id' => $details->formName()]); ?>
                    <?= $form->field($details, 'contragent_id')->widget(Select2::classname(), [
                        'data' => Contragent::getContragentAll(),
                        'options' => ['placeholder' => 'Kontragentni tanlang', 'id' => 'contragent_id'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]]) ?>

                    <?= TabularInput::widget([
                        'models' => $models,
                        'iconSource' => 'fa',
                        'modelClass' => \app\models\Received::class,
                        'cloneButton' => false,
                        'sortable' => false,
                        'min' => 1,
                        'layoutConfig' => [
                            'offsetClass'   => 'col-sm-offset-4',
                            'labelClass'    => 'col-sm-4',
                            'wrapperClass'  => 'col-sm-10',
                            'errorClass'    => 'col-sm-4'
                        ],
                        'addButtonOptions' => [
                            'class' => 'add-close-button'
                        ],
                        'removeButtonOptions' => [
                            'class' => 'add-close-button'
                        ],
                        'form' => $form,
                        'columns' => [
                            [
                                'name' => 'product_id',
                                'title' => 'Mahsulotni tanlang',
                                'type' => Select2::class,
                                'options' =>[
                                    'data' => Product::getProductAll(),
                                    'options' => [
                                        'placeholder' => 'Mahsulot nomini kiriting',
                                        'id' => 'product_id',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ],
                                'headerOptions' => [
                                    'style' => 'width: 33%; border: none;',
                                    'class' => 'tabular-header'
                                ]
                            ],
                            [
                                'name' => 'quantity',
                                'title' => 'Soni',
                                'options' => [
                                    'required' => true,
                                    'type' => 'number'
                                ],
                                'headerOptions' => [
                                    'style' => 'width: 33%; border: none;',
                                    'class' => 'tabular-header'
                                ]
                            ],
                            [
                                'name' => 'r_price',
                                'title' => 'Narxi',
                                'options' => [
                                    'required' => true,
                                    'type' => 'number'
                                ],
                                'headerOptions' => [
                                    'style' => 'width: 33%; border: none;',
                                    'class' => 'tabular-header'
                                ]
                            ]
                        ],
                    ]) ?>
                    <?= $form->field($details, 'sum')->input('number', ['required' => true]) ?>

                        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

