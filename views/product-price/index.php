<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductPriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Product Prices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
            <?= Html::a(Yii::t('app', 'Sell product'),  ['create'], ['class' => 'btn btn-success p-1',
                'style' => 'font-size:12px;',
                'title' => Yii::t('app', 'Create')
            ]) ?>
        </div>

        <!--        --><?php //Pjax::begin(['id' => 'pjaxa']); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'product_id',
                            'department_id',
                            'type',
                            'price',
                            //'from_date',
                            //'to_date',
                            //'status',
                            //'created_by',
                            //'created_at',
                            //'updated_by',
                            //'updated_at',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>