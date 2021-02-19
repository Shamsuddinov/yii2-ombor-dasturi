<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

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

                    <?php Pjax::begin(['id' => 'pjaxa']); ?>
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
                                <th style="text-align: center;">#</th>
                                <th><?= $sort->link('contragent_id') ?></th>
                                <th><?= $sort->link('product_id') ?></th>
                                <th><?= $sort->link('quantity') ?></th>
                                <th><?= $sort->link('r_price') ?></th>
                                <th><?= $sort->link('summa') ?></th>
                                <th><?= $sort->link('date_for_search') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sum = 0;
                            $quantity = 0;
                            foreach ($all_items as $key => $items):
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $key + 1 ?></td>
                                <td><?= $items['details']['contragent']['name'] ?></td>
                                <td><?= $items['product']['name'] ?></td>
                                <td><?= floor($items['quantity']) ?></td>
                                <td><?= floor($items['r_price']) ?></td>
                                <td><?= $items['r_price'] * $items['quantity'] ?></td>
                                <td><?= $items['details']['date'] ?></td>
                            </tr>
                        <?php
                            $quantity += floor($items['quantity']);
                            $sum += floor($items['r_price']);
                            endforeach;
                        ?>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1">Jami soni : <?= $quantity ?></td>
                            <td colspan="1"></td>
                            <td colspan="1">Jami summa : <?= $sum ?></td>
                            <td colspan="1"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                <?php Pjax::end(); ?>
    </div>
</div>
