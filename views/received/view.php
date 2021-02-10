<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Received */

$this->title = "Ma'lumotlarni ko'rish";
$this->params['breadcrumbs'][] = ['label' => 'Receiveds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php if(!isset($hideIt)): ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
<?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr style="font-size: 10px;"><th{captionOptions} style="width:30%;">{label}</th><td{contentOptions}>{value}</td></tr>',
                        'attributes' => [
                            [
                                    'label'  => 'Ma\'lumot ID raqami:',
                                    'value' => $model->id
                            ],
                            [
                                'label'  => 'Qabul qiluvchi:',
                                'value' => $model->id
                            ],
                            [
                                'label'  => 'Kontragent nomi:',
                                'value' => $model->details->contragent->name
                            ],
                            [
                                'label'  => 'Qabul qilingan sana:',
                                'value' => $model->details->date
                            ],
                            [
                                'label'  => 'Mahsulot nomi:',
                                'value' => $model->product->name
                            ],
                            [
                                'label'  => 'Qabul qilingan mahsulot son:',
                                'value' => $model->quantity
                            ],
                            [
                                'label'  => 'Qabul qilingan mahsulot narxi:',
                                'value' => $model->r_price
                            ]
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
<?php if(!isset($hideIt)):?>
    </div>
</div>
<?php endif;?>
