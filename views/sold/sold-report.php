<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $all_items - bir narsalar */
/* @var $sort - bir narsalar */
/* @var $total_count - jami elementlar */
/* @var $count - sahifadagi elementlar soni */
/* @var $searchModel app\models\ReceivedSearch */

$this->title = 'Sotuv hisoboti';
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
                <?= date("Y-m-d h:i:sa") ?>
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
                            <th><?= $sort->link('seller_name') ?></th>
                            <th><?= $sort->link('s_price') ?></th>
                            <th><?= $sort->link('quantity') ?></th>
                            <th><?= $sort->link('sum') ?></th>
                            <th><?= $sort->link('date') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sum = 0;
                            $quantity = 0;
                            foreach ($all_items as $items):
                        ?>
                            <tr>
                                <td><?=$items['product']['name']?></td>
                                <td><?=$items['department']['name']?></td>
                                <td><?=$items['seller']['first_name']." ". $items['seller']['sur_name']?></td>
                                <td><?=floor($items['s_price'])?></td>
                                <td><?=floor($items['quantity'])?></td>
                                <td><?=$items['quantity'] * $items['s_price']?></td>
                                <td><?=$items['date']?></td>
                            </tr>
                        <?php
                            $sum += $items['s_price'] * $items['quantity'];
                            $quantity += $items['quantity'];
                            endforeach;
                        ?>
                        <tr>
                            <td colspan="4"><b><?= Yii::t('app', 'Summary :')?></b></td>
                            <td colspan="1"><b><?=$quantity?></b></td>
                            <td colspan="2"><b><?=$sum?></b></td>
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