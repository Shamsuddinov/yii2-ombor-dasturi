<?php

use app\models\Received;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;

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
            <?= Html::a('Mahsulot qabul qilish', ['qabul'], ['class' => 'btn btn-success p-1 show-modal',
                'style' => 'font-size:12px;',
                'title' => Yii::t('app', 'Create')
            ]) ?>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th>Soni</th>
                                <th>Narxi</th>
                                <th>Yetkazib beruvchi</th>
                                <th>Sana</th>
                                <th>Boshqarish</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="3" style="vertical-align: inherit">1</td>
                                <td>Nestle 1.5 litr</td>
                                <td>12</td>
                                <td>4200</td>
                                <td rowspan="3" style="vertical-align: inherit">Nestle</td>
                                <td rowspan="3" style="vertical-align: inherit">04.02.2021</td>
                                <td  rowspan="3" style="vertical-align: inherit">boshqarish</td>
                            </tr>
                            <tr>
<!--                                <td>1</td>-->
                                <td>Nestle 1.5 litr</td>
                                <td>12</td>
                                <td>4200</td>
<!--                                <td>Nestle</td>-->
<!--                                <td>04.02.2021</td>-->
<!--                                <td>boshqarish</td>-->
                            </tr>
                            <tr>
<!--                                <td>1</td>-->
                                <td>Nestle 1.5 litr</td>
                                <td>12</td>
                                <td>4200</td>
<!--                                <td>Nestle</td>-->
<!--                                <td>04.02.2021</td>-->
<!--                                <td>boshqarish</td>-->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--        --><?php //Pjax::end(); ?>
    </div>
</div>
