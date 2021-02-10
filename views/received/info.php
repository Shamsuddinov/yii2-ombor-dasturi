<?php

use app\components\TabularInput\CustomTabularInput;
use app\models\Contragent;
use app\models\Product;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $data - Kelayotgan ma'lumotlar
 * @var $item - Kelayotgan ma'lumotlar
 * @var $details - Kelayotgan ma'lumotlar
 * @var $model - Kelayotgan ma'lumotlar
 * @var $models - Kelayotgan ma'lumotlar
 */
$this->title = "Ma'lumotlarni ko'rish";
$this->params['breadcrumbs'][] = ['label' => 'Receiveds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$summa = 0;
?>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="box-title"><?= Html::encode($this->title) ?></div>
                <?php if($hideIt): ?>
                <?= Html::button('Sahifani chop etish', [
                    'class' => 'btn btn-success p-1',
                    'style' => 'font-size:12px;',
                    'id' => 'printIt'
                ]) ?>
                <?php else:?>
                    <?= Html::a('O\'chirish', ['received/delete', 'id' => $data[0]->details->id], [
                        'class' => 'btn btn-success p-1 delete-button-ajax',
                        'style' => 'font-size:12px;',
                        'data-method' => 'POST'
                    ]) ?>
                    <?= Html::a('Taxrirlash', ['received/multiple-update', 'id' => $data[0]->details->id], ['class' => 'btn btn-success p-1',
                        'style' => 'font-size:12px;',
                    ]) ?>
                    <?= Html::a('Saqlash va tugatish', ['received/save-and-finish', 'id' => $data[0]->details->id], ['class' => 'btn btn-success p-1',
                        'style' => 'font-size:12px;']) ?>
                <?php endif; ?>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body pt-0" id="printPage">
                        <?php if(count($data) > 0):?>
                            <table style="font-size: 12px; vertical-align: center;" class="table table-hover table-bordered">
                                <tr>
                                    <td style="width: 70%;" colspan="3">Hujjat raqami : <b>#<?=$data[0]->details->id?></b></td>
                                    <td style="width: 30%;" colspan="2">Sana: <b><?=$data[0]->details->date?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="3">Yetkazib beruvchi : <b><?=$data[0]->details->contragent->name?></b></td>
                                    <td colspan="2">To'langan summa : <b><?=$data[0]->details->sum?></b></td>
                                </tr>
                                <tr>
                                    <td><b>Nomi :</b></td>
                                    <td><b>Soni :</b></td>
                                    <td><b>Narxi :</b></td>
                                    <td><b>Umumiy summa :</b></td>
<!--                                        <td><b>Tasdiqlash</b></td>-->
                                </tr>
                                <?php foreach ($data as $item):?>
                                    <tr class="product-items-in-table" itemid="<?=$item->id?>">
                                        <td><label for="element-<?=$item->id?>"><?=$item->product->name?></label></td>
                                        <td><label for="element-<?=$item->id?>"><?=number_format($item->quantity,0)?></label></td>
                                        <td><label for="element-<?=$item->id?>"><?=$item->r_price?></label></td>
                                        <td><label for="element-<?=$item->id?>" class="all-prices"><?=$item->r_price * $item->quantity?></label></td>
                                    </tr>
                                <?php
                                    $summa +=  $item->r_price * $item->quantity;
                                    $hideIt = $item->status === \app\models\Received::STATUS_INACTIVE ? true : false;
                                endforeach;
                                ?>
                                <tr>
                                    <td colspan="3"><b>Jami:</b></td>
                                    <td colspan="2" id="countPayments"><?=$summa?></td>
                                </tr>
                            </table>
                        <?php else:?>
                            <table>
                                <tr>
                                    <td>Hech narsa yo'q.</td>
                                </tr>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$js = <<<JS
        jQuery(document).ready(function($) {
            $('input.receive-checkbox').click(function (){
                let item = $(this);
                $('#countPayments')[0].innerText = $.fn.countPayments();
            });
            $.fn.countPayments = function() {
                let tr = $('tr.product-items-in-table');
                let summa = 0;
                tr.map((index, item) => {
                    if(item.children[4].firstChild.checked === true){
                         summa += 1*item.children[3].innerText   
                    }
                })
                return summa;
            }
            $('#printIt').click(function() {
                $.fn.printInvoice();
            });
            $.fn.printInvoice = function (){
                 printDiv = "#printPage"; // id of the div you want to print
                 $('header#header').remove();                     
                 $('div.clearfix').remove();                     
                 $('aside.left-panel').remove();                     
                 $('footer.site-footer').remove();                     
                 $('button#printIt').remove();                     
                 $('button#printIt').remove();                     
                 $('form#Received').remove();                     
                 $('div.right-panel').removeAttr('id').removeClass('right-panel');                     
                 $('div.animated').removeAttr('id').removeAttr('class');                     
                 $('div.card').removeAttr('id').removeAttr('class');                     
                 window.print();
                 location.reload();
            }
        });
JS;
$this->registerJs($js);
?>