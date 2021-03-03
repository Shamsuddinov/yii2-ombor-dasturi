<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transactions');
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
                            'department_id',
                            'invoice_id',
                            'details_id',
                            'sum',
                            //'inventory',
                            //'type_id',
                            //'transaction_date',
                            //'status',
                            //'created_by',
                            //'created_at',
                            //'updated_by',
                            //'updated_at',

                            ['class' => 'yii\grid\ActionColumn'],
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
                                    'view' => function ($url, $model) {
                                        return Html::a('<span class="fa fa-eye"></span>', \yii\helpers\Url::to(['sold/view', 'id' => $model['id']]), [
                                            'class' => 'view-modal btn btn-sm btn-success show-modal',
                                            'title' => Yii::t('app', 'Product information')
                                        ]);
                                    },
                //                                'update' => function ($url, $model) {
                //                                    return Html::a('<span class="fa fa-pencil"></span>', \yii\helpers\Url::to(['sold/update', 'id' => $model['id']]), [
                //                                        'class' => 'btn btn-sm btn-primary',
                //                                        'title' => Yii::t('app', 'Update product')
                //                                    ]) ;
                //                                },
                //                                'delete' => function ($url, $model) {
                //                                    return Html::a('<span class="fa fa-trash"></span>', \yii\helpers\Url::to(['sold/update', 'id' => $model['id']]), [
                //                                        'class' => 'delete-button-ajax btn btn-sm btn-danger',
                //                                    ]);
                //                                },
                                ]
                            ],
                        ],
                        'pager' => [
                            'options' => [
                                'class' => 'pagination',
                            ],
                            'linkOptions' => [
                                'class' => 'page-link'
                            ],
                            'disabledListItemSubTagOptions' => [
                                'class' => 'page-link',
                                'tag' => 'a',
                                'href' => '#'
                            ],
                            'hideOnSinglePage' => true,
                            'pageCssClass' => 'paginate_button page-item',
                            'activePageCssClass' => 'paginate_button page-item active',
                            'disabledPageCssClass' => 'paginate_button page-item disabled',
                            'nextPageCssClass' => 'paginate_button page-item next',
                            'prevPageCssClass' => 'paginate_button page-item previous',
                            'prevPageLabel' => 'Avvalgi',
                            'nextPageLabel' => 'Keyingi',
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>