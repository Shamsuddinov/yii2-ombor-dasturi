<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Invoices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
            <?= Html::a(Yii::t('app', 'Sell product'), ['sold/create'], ['class' => 'btn btn-success p-1',
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
                        'rowOptions' => function($model){
                            return ['data-id' => $model->id];
                        },
                        'tableOptions' => [
                            'class' => 'table table-hover',
                            'style' => 'cursor: pointer;'
                        ],
                        'columns' => [
//                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'id',
                                'label' => '#',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a($model->id, Url::to(['invoice/view', 'id' => $model->id]));
                                },
                                'contentOptions' => [
                                    'style' => 'vertical-align:inherit; width:5%; text-align:center;',
                                ],
                                'headerOptions' => [
                                    'style' => 'text-align:center;'
                                ]
                            ],
                            [
                                'attribute' => 'department_name',
                                'value' => 'department.name',
                            ],
//                            'sum',
//                            'status',
                            [
                                'attribute' => 'user_name',
                                'value' => 'user.username'
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
//                                    'view' => function ($url) {
//                                        return Html::a('<span class="fa fa-eye"></span>', $url, [
//                                            'class' => 'view-modal btn btn-sm btn-success',
//                                            'title' => Yii::t('app', 'Product information')
//                                        ]);
//                                    },
//                                    'update' => function ($url) {
//                                        return Html::a('<span class="fa fa-pencil"></span>', $url, [
//                                            'class' => 'update-modal btn btn-sm btn-primary',
//                                            'title' => Yii::t('app', 'Update product')
//                                        ]) ;
//                                    },
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
<?php
$url = Url::to(['invoice/view']);
$ja= 1;
$js = <<<JS
    jQuery('body').delegate('td.w0', 'click', function (){
        let id = $(this).parents('tr.w0').attr('data-id');
        let url = '$url'+"?id="+id;
        location.href = url;
    })
JS;
$this->registerJs($js);
?>