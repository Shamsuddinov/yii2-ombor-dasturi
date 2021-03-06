<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $all_items - bir narsalar */
/* @var $sort - bir narsalar */
/* @var $total_count - jami elementlar */
/* @var $count - sahifadagi elementlar soni */
/* @var $searchModel app\models\ReceivedSearch */

$this->title = 'Qoldiq hisoboti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="card">
        <div class="items-does-not-print">
            <div class="card-body">
                <div class="box-title"><?= Html::encode($this->title) ?></div>
                <!--            --><?php //Pjax::begin(['id' => 'pjaxa']); ?>
                <?php  echo $this->render('_second_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <div class="row" style="font-size: 12px;">
            <div class="col-8 text-dark pl-lg-5" style="vertical-align: center;">
                Sahifadagi elementlar soni <?=$count?>, jami elementlar <?=$total_count?>
            </div>
            <div class="col-4">
                <?= date("d-m-Y h:i:s") ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <table style="font-size: 12px; vertical-align: center;" class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th><?= $sort->link('product_name') ?></th>
                            <th><?= $sort->link('department_name') ?></th>
                            <th><?= $sort->link('quantity') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $count_dead_products = 0;
                            $count_less_then_10 = 0;
                            $quantity = 0;
                            foreach ($all_items as $items):
                        ?>
                                <tr>
                                    <td><?=$items['product']['name']?></td>
                                    <td><?=$items['department']['name']?></td>
                                    <td><?=$items['quantity']?></td>
                                </tr>
                        <?php
                            if($items['quantity'] === 0){
                                $count_dead_products++;
                            }
                            if($items['quantity'] < 10){
                                $count_less_then_10++;
                            }
                            $quantity += $items['quantity'];
                            endforeach;
                        ?>
                        <tr>
                            <td colspan="2"><b><?= Yii::t('app', 'Summary :') ?></b></td>
                            <td colspan="1"><b><?= $quantity ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Tugagan mahsulotlar soni : <?=$count_dead_products?></b></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>10 tadan oz qolgan mahsulotlar soni : <?=$count_less_then_10?></b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--        --><?php //Pjax::end(); ?>
    </div>
</div>

<?php
$js = <<<JS
        $('#printIt').click(function() {
           $.fn.printInvoice();
        });
        $.fn.printInvoice = function (){
             $('.items-does-not-print, #back-to-invoice, #save-and-finish, #edit-some-items, form#Received, button#printIt, footer.site-footer, aside.left-panel, div.clearfix, header#header').remove();
             $('div.right-panel').removeAttr('id').removeClass('right-panel');
             $('div.animated, div.card').removeAttr('id').removeAttr('class');
             window.print();
             location.reload();
        }
JS;
$this->registerJs($js);
?>
