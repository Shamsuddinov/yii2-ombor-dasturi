<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Auth Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
            <?= Html::a(Yii::t('app', 'Create Auth Assignment'),  ['create'], ['class' => 'btn btn-success p-1',
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

                        'item_name',
                        [
                            'attribute' => 'user_id',
                            'value' => 'user.first_name',
                            'label' => Yii::t('app', 'Foydalanuvchi')
                        ],
                        'created_at',
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
//                                'view' => function ($url, $model) {
//                                    return Html::a('<span class="fa fa-eye"></span>', \yii\helpers\Url::to(['auth-item/view', 'id' => $model['name']]), [
//                                        'class' => 'view-modal btn btn-sm btn-success',
//                                        'title' => Yii::t('app', 'Product information')
//                                    ]);
//                                },
                                'update' => function ($url, $model) {
                                    return Html::a('<span class="fa fa-pencil"></span>', $url, [
                                        'class' => 'update-modal btn btn-sm btn-primary',
                                        'title' => Yii::t('app', 'Update product')
                                    ]) ;
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<span class="fa fa-trash"></span>', \yii\helpers\Url::to(['auth-item/delete', 'id' => $model['item_name']]), [
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
