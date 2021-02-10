<?php

use app\models\Received;
use kartik\date\DatePicker;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReceivedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahsulotlarni qabul qilish';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="box-title"><?= Html::encode($this->title) ?></div>

                <?= Html::a('Mahsulotlarni qabul qilish', ['multiple-receive'], ['class' => 'btn btn-success p-1',
                    'style' => 'font-size:12px;',
                    'title' => Yii::t('app', 'Create')
                ]) ?>
                <?= Html::a('Mahsulotlarni kirim qilish', ['kirim'], ['class' => 'btn btn-success p-1',
                    'style' => 'font-size:12px;',
                    'title' => Yii::t('app', 'Receive')
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
                        'tableOptions' => [
                            'id' => 'bootstrap-data-table',
                            'class' => 'table table-striped table-bordered table-hover',
                        ],
                        'rowOptions' => [
                                'class' => 'received-table-row'
                        ],
                        'headerRowOptions' => [
                                'class' => 'table-header',
                        ],
                        'summary' => "<b>{totalCount} ta</b> ma'lumotdan. <b>{begin} - {end} gacha</b> qismi chiqarildi.",
                        'columns' => [
                            [
                                'attribute' => 'details_id',
                                'label' => '#',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a($model->details_id,Url::to(['received/info', 'id' => $model->details_id]));
                                },
                                'group' => true,
                                'contentOptions' => [
                                    'style' => 'vertical-align:inherit; width:3%; text-align:center;',
                                ],
                                'headerOptions' => [
                                    'style' => 'text-align:center;'
                                ]
                            ],
                            [
                                'attribute' => 'contragent_id',
                                'label' => 'Yetkazib beruvchi',
                                'filter' => Received::getModelAsArray(new \app\models\Contragent()),
                                'value' => 'details.contragent.name',
                                'filterOptions' => [
                                    'name' => 'ReceivedSearch[contragent]'
                                ],
                            ],
                            [
                                'attribute' => 'product_id',
                                'label' => 'Mahsulot nomi',
                                'filter' => Received::getModelAsArray(new \app\models\Product()),
                                'value' => 'product.name'
                            ],
                            [
                                'attribute' => 'quantity',
                                'label' => 'Soni',
                                'headerOptions' => [
                                    'style' => 'width: 90px; max-width:110px; text-align:center;'
                                ],
                                'contentOptions' => [
                                    'style' => 'text-align:center;'
                                ]
                            ],
                            [
                                'attribute' => 'r_price',
                                'label' => 'Narxi'
                            ],
                            [
                                'attribute' => 'date',
                                'format' => 'date',
                                'label' => Yii::t('app', 'Date'),
                                'filter' => DatePicker::widget([
                                    'name' => 'ReceivedSearch[date]',
                                    'removeIcon' => '<i class="fa fa-close text-danger"></i>',
                                    'pickerIcon' => '<i class="fa fa-calendar text-primary"></i>',
                                    'layout' => "{picker}{input}{remove}",
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                        'autoClose' => true
                                    ],
                                ])
                                ,
                                'value' => 'details.date'
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
                                        'view' => function ($url) {
                                            return Html::a('<span class="fa fa-eye"></span>', $url, [
                                                    'class' => 'view-modal btn btn-sm btn-success show-modal',
                                                'title' => Yii::t('app', 'Product information')
                                            ]);
                                        },
                                        'update' => function ($url) {
                                            return Html::a('<span class="fa fa-pencil"></span>', $url, [
                                                    'class' => 'update-modal btn btn-sm btn-primary show-modal',
                                                'title' => Yii::t('app', 'Update product')
                                            ]) ;
                                        },
                                        'delete' => function ($url) {
                                            return Html::a('<span class="fa fa-trash"></span>', $url, [
                                                'class' => 'delete-button-ajax btn btn-sm btn-danger',
                                            ]);
                                        },
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
<!--        --><?php //Pjax::end(); ?>
        </div>
    </div>
