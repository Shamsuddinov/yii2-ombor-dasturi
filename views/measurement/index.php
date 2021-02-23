<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MeasurementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Measurements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
            <?= Html::a(Yii::t('app', 'Add new brand'), ['create'], ['class' => 'btn btn-success p-1 show-modal',
                'style' => 'font-size:12px;',
                'title' => Yii::t('app', 'Create a new brand')
            ]) ?>
        </div>

        <!--        --><?php //Pjax::begin(['id' => 'pjaxa']); ?>
        <!--        --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'name',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                </div>
            </div>
        </div>
        <!--        --><?php //Pjax::end(); ?>
    </div>
</div>