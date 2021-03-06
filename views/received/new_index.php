<?php


use yii\helpers\Html;
use kartik\grid\GridView;

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

        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
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
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'contragent_id',
                                'label' => 'Yetkazib beruvchi',
                                'value' => 'details.contragent.name',
                                'pageSummary' => 'Jami :',
                                'pageSummaryOptions' => [
                                    'style' => 'font-size: 12px;'
                                ]
                            ],
                            [
                                'attribute' => 'product_id',
                                'label' => 'Mahsulot nomi',
                                'value' => 'product.name'
                            ],
                            [
                                'attribute' => 'quantity',
                                'label' => 'Soni',
                                'value' => function ($model) {
                                    return floor($model['quantity']);
                                },
                                'headerOptions' => [
                                    'style' => 'width: 90px; max-width:110px; text-align:center;'
                                ],
                                'contentOptions' => [
                                    'style' => 'text-align:center;'
                                ],
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM,
                                'pageSummaryOptions' => [
                                    'style' => 'font-size: 12px; text-align:center;'
                                ]
                            ],
                            [
                                'attribute' => 'r_price',
                                'label' => 'Narxi',
                                'value' => function ($model) {
                                    return floor($model['r_price']);
                                },
                                'contentOptions' => [
                                    'style' => 'text-align:center;'
                                ],
                            ],
                            [
                                'attribute' => 'summa',
                                'label' => 'Summ',
                                'value' => function ($model){
                                    return $model['r_price'] * $model['quantity'];
                                },
                                'contentOptions' => [
                                    'style' => 'text-align:center;'
                                ],
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM,
                                'pageSummaryOptions' => [
                                    'style' => 'font-size: 12px; text-align:center;'
                                ]
                            ],
                            [
                                'attribute' => 'date_for_search',
                                'format' => 'date',
                                'label' => Yii::t('app', 'Date'),
                                'value' => 'details.date',
                                'contentOptions' => [
                                    'style' => 'text-align:center;'
                                ],
                            ]
                        ],
                        'showPageSummary' => true,
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
