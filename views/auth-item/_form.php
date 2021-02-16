<?php

use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItem */
/* @var $rules views\auth-item\create_rules */
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
    <?php if($rules === false): ?>
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
    <?php else: ?>
        <div class="row">
            <?php foreach($all_permissions as $key => $permission) : ?>
                <div class="col-4 checkbox-column">
                    <ul class="list-group list-group-flush checkbox-column-list">
                        <li class="custom-control custom-checkbox no-select checkbox-column-list-header" ><?= $permission['name'] ?></li>
                        <?php foreach ($permission['sub_items'] as $sub_key => $sub_item): ?>
                        <li class="custom-control custom-checkbox checkbox-column-list-items">
                            <input type="checkbox" <?php
                                if(isset($model_and_items)){
                                    foreach ($model_and_items as $model_and_item){
                                        if(array_search($sub_item['name'], $model_and_item) === 'child'){
                                            echo 'checked';
                                        }
                                    }
                                }
                            ?> name="AuthItemChild[<?= $permission['name'] ?>][<?= $sub_key ?>]" value="<?= $sub_item['name'] ?>"  class="custom-control-input" id="<?= $sub_item['name'] ?>">
                            <label class="custom-control-label no-select" for="<?= $sub_item['name'] ?>"><?= $sub_item['name'] ?></label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif; ?>
    <div class="form-group p-2">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<<JS
  $('.checkbox-column-list').delegate('.checkbox-column-list-header', 'click', function () {
        let children = $(this).parent('ul').find('.checkbox-column-list-items');
        children.map(function (item, index){
            let value = $(index).find('input').attr('checked');
            if (value === 'checked') {
                $(index).find('input').removeAttr('checked'); 
            } else {
                $(index).find('input').attr('checked', true);
            }
        });
    })
JS;
$this->registerJs($js);
