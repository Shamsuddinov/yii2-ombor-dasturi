<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'All rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
            <?= Html::a(Yii::t('app', 'Create rules'),  ['create-rules'], ['class' => 'btn btn-success p-1',
                'style' => 'font-size:12px;',
                'title' => Yii::t('app', 'Create')
            ]) ?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?= GridView::widget([
                        'dataProvider' => $rules,
                        'columns' => [
                            'name',
                            'description:ntext',
                            [
                                'label' => Yii::t('app', 'Children'),
                                'value' => function($model) {
                                    $all_items = '';
                                    if(count($model['authItemChildren']) > 0){
                                        foreach ($model['authItemChildren'] as $item){
                                            $all_items .= "<div style='margin: 0 2px; font-size: 12px; padding: 0 10px 0 10px;' class='btn btn-success'>".$item['child']."</div>";
                                        }
                                    }
                                    return $all_items;
                                },
                                'format' => 'raw'
                            ],
                            [
                                'header' => 'Boshqarish',
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update} {delete}',
                                'visible' => true,
                                'contentOptions' => [
                                    'style' => 'width: 90px; max-width:110px; text-align:center;'
                                ],
                                'buttonOptions' => [
                                    'style' => 'width:20px; color: red;'
                                ],
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return Html::a('<span class="fa fa-pencil"></span>', \yii\helpers\Url::to(['auth-item/update-rules', 'id' => $model['name']]), [
                                            'class' => 'update-modal btn btn-sm btn-primary',
                                            'title' => Yii::t('app', 'Update product')
                                        ]) ;
                                    },
                                    'delete' => function ($url, $model) {
                                        return Html::a('<span class="fa fa-trash"></span>', \yii\helpers\Url::to(['auth-item/delete-rules', 'id' => $model['name']]), [
                                            'class' => 'delete-items-with-ajax btn btn-sm btn-danger',
                                        ]);
                                    },
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
