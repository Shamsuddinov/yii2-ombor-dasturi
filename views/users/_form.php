<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
 $action_id = Yii::$app->controller->action->id;
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sur_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?php
        if($action_id === 'create') {
            echo $form->field($model, 'password')->textInput([
                'maxlength' => true,
                'value' => '',
                'id' => 'user-password',
                'autocomplete' => false
            ])->label(Yii::t('app', 'Password'));
        }
    ?>

    <?= $form->field($model, 'rules')->widget(Select2::classname(), [
        'data' => \app\models\AuthItem::getAllAuthRules(),
        'theme' => Select2::THEME_BOOTSTRAP,
        'size' => Select2::SMALL,
        'options' => ['placeholder' => 'Rules', 'id' => 'item_name', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true
        ]])->label('Rules :') ?>
    <?php if($action_id === 'update'){ ?>
    <div class="reset-password" style="font-weight: bold; text-decoration: underline;" ><?= Yii::t('app', 'Reset password.') ?></div>
    <div class="reset-password d-none" style="font-weight: bold; text-decoration: underline;" ><?= Yii::t('app', 'Cancel changing password.') ?></div>
    <?= $form->field($model, 'password')->textInput([
        'class' => 'd-none form-control',
        'maxlength' => true,
        'value' => '',
        'id' => 'user-password',
        'autocomplete' => false
    ])->label(Yii::t('app', 'Password'), [
        'class' => 'd-none control-label',
        'id' => 'password-label',
    ]) ?>
    <?php }?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
    $js = <<<JS
    $('.reset-password').click(function() {
        $('.reset-password, #user-password, #password-label').toggleClass('d-none');
        $('#user-password').attr('autocomplete', false);
    });
JS;
    $this->registerJs($js);
?>