<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = $model['id'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12">
    <?php if(!Yii::$app->request->isAjax):?>
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Yii::t('app', 'Product invoice :'). Html::encode($this->title) ?></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <p>
                        <a href="<?= \yii\helpers\Url::to(['invoice/index']) ?>" class="btn btn-primary" id="back-to-invoice"><?= Yii::t('app', 'Back') ?></a>
                        <button class="btn btn-success" id="printIt"><?= Yii::t('app', 'Print') ?></button>
                    </p>
                    <?php endif;?>
                    <table class="table table-hover table-bordered" style="font-size: 12px;">
                        <tbody>
                            <tr>
                                <td colspan="2"><?= Yii::t('app', 'Invoice number :'). " <span class='font-weight-bold'>#" .$model['id']."</span>" ?></td>
                                <td colspan="2"><?= Yii::t('app', 'Department name : '). " <span class='font-weight-bold'>" . $model['department']['name']. ", ". $model['department']['address'] ."</span>" ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><?= Yii::t('app', 'Seller name :'). " <span class='font-weight-bold'>" .$model['user']['first_name']." ".$model['user']['sur_name']." (".$model['user']['first_name'].")"."</span>" ?></td>
                                <td colspan="2"><?= Yii::t('app', 'Date : '). " <span class='font-weight-bold'>" . date("Y-m-d H:i:s", $model['created_at']) ."</span>" ?></td>
                            </tr>
                        </tbody>
                        <tbody class="table-rows">
                            <tr>
                                <td class="font-weight-bold"><?= Yii::t('app', 'Product name') ?></td>
                                <td class="font-weight-bold"><?= Yii::t('app', 'Quantity') ?></td>
                                <td class="font-weight-bold"><?= Yii::t('app', 'Price') ?></td>
                                <td class="font-weight-bold"><?= Yii::t('app', 'Sum') ?></td>
                            </tr>
                            <?php
                                $sum = 0; $quantity = 0;
                                foreach ($model['solds'] as $sold):
                            ?>
                                <tr>
                                    <td><?= $sold['product']['name'] ?></td>
                                    <td><?= floor($sold['quantity'])." ". $sold['product']['measurement']['name'] ?></td>
                                    <td><?= floor($sold['s_price']) ?> so'm</td>
                                    <td><?= $sold['s_price'] * $sold['quantity'] ?> so'm</td>
                                </tr>
                            <?php
                                $sum += $sold['s_price'] * $sold['quantity'];
                                $quantity += $sold['quantity'];
                                endforeach;
                            ?>
                        </tbody>
                        <tbody>
                        <tr>
                            <td colspan="1"><b><?= Yii::t('app', 'Summary :') ?></b></td>
                            <td id="total-count"><?= $quantity ?></td>
                            <td colspan="2" style="text-align: right" id="total-sum"> <?= $sum ?> so'm</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php if(!Yii::$app->request->isAjax):?>
    </div>
<?php endif;?>
</div>

<?php
    $js = <<<JS
        $('#printIt').click(function() {
           $.fn.printInvoice();
        });
        $.fn.printInvoice = function (){
             $('#back-to-invoice, #save-and-finish, #edit-some-items, form#Received, button#printIt, footer.site-footer, aside.left-panel, div.clearfix, header#header').remove();
             $('div.right-panel').removeAttr('id').removeClass('right-panel');
             $('div.animated, div.card').removeAttr('id').removeAttr('class');
             window.print();
             location.reload();
        }
JS;
    $this->registerJs($js);
?>