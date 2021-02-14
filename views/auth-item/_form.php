<?php

use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="multiple-input-list table table-condensed table-renderer">
        <thead>
            <tr>
                <th class="tabular-header list-cell__name" style="width: 50%; border: none;">Controller name</th>
                <th class="tabular-header list-cell__description" style="width: 50%; border: none;">Description</th>
            </tr>
        </thead>
        <tbody>
            <tr class="multiple-input-list__item">
                <td class="list-cell__name">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
                </td>
                <td class="list-cell__description">
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label(false)?>
                </td>
            </tr>
        </tbody>
    </table>

    <?= $form->field($model, 'tabular')->widget(MultipleInput::class, [
        'iconSource' => 'fa',
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
            'class' => 'add-close-button btn btn-sm btn-primary',
        ],
        'removeButtonOptions' => [
            'class' => 'add-close-button btn btn-sm btn-danger',
        ],
        'form' => $form,
        'columns' => [
            [
                'name' => 'name',
                'title' => 'Child name',
                'options' => [
                    'required' => true,
                ],
                'headerOptions' => [
                    'style' => 'width: 50%; border: none;',
                    'class' => 'tabular-header'
                ]
            ],
            [
                'name' => 'description',
                'title' => 'Description',
                'options' => [
                    'required' => true,
                ],
                'headerOptions' => [
                    'style' => 'width: 50%; border: none;',
                    'class' => 'tabular-header'
                ]
            ],
        ],
    ])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
