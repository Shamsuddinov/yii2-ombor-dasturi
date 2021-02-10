<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContragentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contragents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
            <?= Html::a(Yii::t('app', 'Add new counter agent'), ['create'], ['class' => 'btn btn-success p-1 show-modal',
                'style' => 'font-size:12px;',
                'title' => Yii::t('app', 'Add new counter agent')
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
                        'id',
                        'name',
                        [
                            'header' => 'Boshqarish',
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}',
                            'visible' => true,
                            'contentOptions' => ['style' => 'width: 110px; max-width:110px;'],
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

