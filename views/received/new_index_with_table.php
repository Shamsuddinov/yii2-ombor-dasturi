<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $all_items - bir narsalar */
/* @var $sort - bir narsalar */
/* @var $total_count - jami elementlar */
/* @var $count - sahifadagi elementlar soni */
/* @var $searchModel app\models\ReceivedSearch */

$this->title = 'Mahsulotlarni qabul qilish';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>

            <!--        --><?php //Pjax::begin(['id' => 'pjaxa']); ?>
            <?php  echo $this->render('_second_search', ['model' => $searchModel]); ?>
        </div>
        <p class="text-dark pl-4">
            Sahifadagi elementlar soni <?=$count?>, jami elementlar <?=$total_count?>
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <table style="font-size: 12px; vertical-align: center;" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th><?= $sort->link('contragent_id') ?></th>
                                <th><?= $sort->link('product_id') ?></th>
                                <th><?= $sort->link('quantity') ?></th>
                                <th><?= $sort->link('r_price') ?></th>
                                <th><?= $sort->link('date_for_search') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_items as $items):?>
                            <tr>
                                <td><?=$items['details']['contragent']['name']?></td>
                                <td><?=$items['product']['name']?></td>
                                <td><?=$items['quantity']?></td>
                                <td><?=$items['r_price']?></td>
                                <td><?=$items['details']['date']?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--        --><?php //Pjax::end(); ?>
    </div>
</div>
