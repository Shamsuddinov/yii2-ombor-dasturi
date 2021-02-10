<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Received */

$this->title = 'Ma\'lumotni yangilash';
$this->params['breadcrumbs'][] = ['label' => 'Receiveds', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<?php if(!isset($hideIt)): ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="box-title"><?= Html::encode($this->title) ?></div>
        </div>
<?php endif;?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body pt-0">
                    <?php if($status === 1):?>
                    <?= $this->render('qabulformasi', [
                        'model' => $model,
                    ]) ?>
                    <?php else:?>
                    Kechirasiz, bu ma'lumotni o'zgartira olmaysiz.
                    <?php endif;?>
                </div>
            </div>
        </div>
<?php if (!isset($hideIt)):?>
    </div>
</div>
<?php endif; ?>