<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>

            <?= Html::a('Mahsulotlarni qabul qilish', ['received/multiple-receive'], ['class' => 'btn btn-success p-1',
                'style' => 'font-size:12px;',
            ]) ?>
            <?= Html::a('Mahsulotlarni kirim qilish', ['received/kirim'], ['class' => 'btn btn-success p-1',
                'style' => 'font-size:12px;',
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
                    'rowOptions' => function($model){
                        return ['data-id' => $model->id];
                    },
                    'columns' => [
                        [
                            'attribute' => 'id',
                            'label' => '#',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a($model->id,Url::to(['received/info', 'id' => $model->id]));
                            },
                            'contentOptions' => [
                                'style' => 'vertical-align:inherit; width:5%; text-align:center;',
                            ],
                            'headerOptions' => [
                                'style' => 'text-align:center;'
                            ]
                        ],
                        [
                            'attribute' => 'contragent_name',
                            'value' => 'contragent.name'
                        ],
                        'date',
                        'sum',
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

<?php
$url = Url::to(['received/info']);
$ja= 1;
$js = <<<JS
    jQuery('body').delegate('td.w0', 'click', function (){
        let id = $(this).parents('tr.w0').attr('data-id');
        let url = '$url'+"&id="+id;
        location.href = url;
    })
JS;
$this->registerJs($js);
?>
