<?php

use app\models\Product;
use kartik\daterange\DateRangePicker;
use kartik\money\MaskMoney;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReceivedSearch */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin([
    'action' => ['received-products-report-with-table'],
    'method' => 'get',
]); ?>
<div class="row">
    <div class="col-6"><?= $form->field($model, 'contragent_id')->widget(Select2::className(), [
            'data' => \app\models\Contragent::getContragentAll(),
            'theme' => Select2::THEME_BOOTSTRAP,
            'size' => Select2::SIZE_SMALL,
            'options' => ['placeholder' => 'Yetkazib beruvchi nomini kiriting', 'id' => 'contragent_id', 'class' => 'input-items'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);  ?></div>
    <div class="col-6"><?= $form->field($model, 'product_id')->widget(Select2::className(), [
            'data' => Product::getProductAll(),
            'theme' => Select2::THEME_BOOTSTRAP,
            'size' => Select2::SIZE_SMALL,
            'options' => ['placeholder' => 'Mahsulot nomini kiriting', 'id' => 'product_id', 'class' => 'input-items'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);  ?></div>
</div>
<div class="row">
    <div class="col-6"><?= $form->field($model, 'quantity')->textInput([
            'type' => 'number',
            'style' => 'height: 30px; font-size:12px;']) ?></div>
    <div class="col-6"><?= $form->field($model, 'r_price')->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'prefix' => 'UZS ',
                'precision' => 0
            ],
            'options' => [
                'style' => 'height: 30px; font-size:12px;'
            ]
        ]) ?></div>
</div>
<div class="row">
    <div class="col-6">
        <?= $form->field($model, 'date_for_search')->widget(DateRangePicker::class, [
            'model' => $model,
            'attribute' => 'date_for_search',
            'convertFormat' => true,
            'startAttribute' => 'from_date',
            'endAttribute' => 'to_date',
            'options' => [
                'autocomplete' => 'off',
                'class' => 'form-control',
                'placeholder' => 'Oraliqni tanlang...',
                'style' => 'height: 30px; font-size:12px;'
            ],
            'pluginOptions' => [
                'showDropdowns' => true,
                'allowClear' => true,
                'language' => 'uz-latin',
                'locale' => [
                    'format' => 'Y-m-d',
                    "applyLabel" => "Tanlash",
                    "cancelLabel" => "Bekor",
                    "fromLabel" => "Dan",
                    "toLabel" => "Gacha",
                    "customRangeLabel" => "Tanlangan",
                    "daysOfWeek" => [
                        "Ya",
                        "Du",
                        "Se",
                        "Ch",
                        "Pa",
                        "Ju",
                        "Sh"
                    ],
                    "monthNames" => [
                        "Yanvar",
                        "Fevral",
                        "Mart",
                        "Aprel",
                        "May",
                        "Iyun",
                        "Iyul",
                        "Avgust",
                        "Sentabr",
                        "Oktabr",
                        "Noyabr",
                        "Dekabr"
                    ],
                    "firstDay" => 1
                ],
                'ranges' => [
                    Yii::t('app', "Bugun") => ["moment().startOf('day')", "moment()"],
                    Yii::t('app', "Kecha") => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
                    Yii::t('app', "Ohirgi {n} kun", ['n' => 7]) => ["moment().startOf('day').subtract(6, 'days')", "moment()"],
                    Yii::t('app', "Ohirgi {n} kun", ['n' => 30]) => ["moment().startOf('day').subtract(29, 'days')", "moment()"],
                    Yii::t('app', "Shu oy") => ["moment().startOf('month')", "moment().endOf('month')"],
                    Yii::t('app', "O'tgan oy") => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
                ],
            ],
        ]) ?>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
</div>

<?php ActiveForm::end(); ?>

