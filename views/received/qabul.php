<?php

use yii\helpers\Html;

/**
 * @var $data - Kelayotgan ma'lumotlar
 * @var $item - Kelayotgan ma'lumotlar
 * @var $details - Kelayotgan ma'lumotlar
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
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?php if(count($data) > 0):?>
                        <form method="post" name="ConfirmForm">
                            <?php foreach ($details as $detail):  ?>
                                <table style="font-size: 12px; vertical-align: center;" class="table table-hover table-bordered">
                                <tr>
                                    <td style="width: 50%; vertical-align: inherit;" colspan="2"><label style="vertical-align: inherit!important; margin-top: 8px!important; display: block; height: 100%;" for="check-it-<?=$detail->id?>">Hujjat raqami : <b>#<?=$detail->id?></b></label></td>
                                    <td style="width: 25%;  vertical-align: inherit;" colspan="1"><label style="vertical-align: inherit!important; margin-top: 8px!important;display: block; height: 100%;" for="check-it-<?=$detail->id?>">Sana: <b><?=$detail->date?></b></label></td>
                                    <td style="width: 25%;  vertical-align: inherit;" colspan="1"><label style="vertical-align: inherit!important; margin-top: 8px!important; display: inline-table!important;" for="check-it-<?=$detail->id?>">Tasdiqlash</label> <input id="check-it-<?=$detail->id?>" name="check-it-<?=$detail->id?>" type="checkbox" checked="true" value="<?=$detail->id?>" style="vertical-align: inherit!important; margin-top: 3px!important;"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Yetkazib beruvchi : <b><?=$detail->contragent->name?></b></td>
                                    <td colspan="2">To'langan summa : <b><?=$detail->sum?></b></td>
                                </tr>
                                <tr>
                                    <td><b>Nomi :</b></td>
                                    <td><b>Soni :</b></td>
                                    <td><b>Narxi :</b></td>
                                    <td><b>Umumiy summa :</b></td>
                                </tr>
                                    <?php foreach ($data as $item):?>
                                    <?php if($item->details_id === $detail->id):?>
                                        <tr class="product-items-in-table" itemid="<?=$item->id?>">
                                            <td><label for="element-<?=$item->id?>"><?=$item->product->name?></label></td>
                                            <td><label for="element-<?=$item->id?>"><?=$item->quantity?></label></td>
                                            <td><label for="element-<?=$item->id?>"><?=$item->r_price?></label></td>
                                            <td><label for="element-<?=$item->id?>" class="all-prices"><?=$item->r_price * $item->quantity?></label></td>
                                        </tr>
                                    <?php
                                        $summa +=  $item->r_price * $item->quantity;
                                        endif;
                                        endforeach;
                                    ?>
                                <tr>
                                    <td colspan="3"><b>Jami:</b></td>
                                    <td colspan="2" id="countPayments"><?=$summa?></td>
                                </tr>
                            </table>
                        <?php $summa = 0; endforeach; ?>
                    <p>
                        <?=Html::submitButton(Yii::t('app', 'Confirmation'), [
                            'class' => 'btn btn-success p-1',
                            'style' => 'font-size: 12px; margin-left: 90%;',
                            'id' => 'confirm-button'
                        ])?>
                    </p>
                        </form>
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
        });
JS;
    $this->registerJs($js);
?>