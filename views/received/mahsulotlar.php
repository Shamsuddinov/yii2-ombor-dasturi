<?php
/**
 * @array $data
 */
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = "Kelgan mahsulotlar ro'yhati";
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Modal::begin([
    'id' => 'qabul',
    'options' => ['class' => 'in'],
    'header' => '<h2>Mahsulot qo\'shish.</h2>',
    'footer' => '<button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
                                     <button type="button" class="btn btn-primary">Saqlash</button>',
    'headerOptions' => [
        'class' => 'box-title text-center'
    ],
    'bodyOptions' => [
        'style' => 'overflow-y:auto; overflow-x:hidden;'
    ],
    'size' => 'modal-lg modal-dialog-centered modal-dialog-scrollable',
]);

echo '<div id="qoshishOynasi"></div>';

Modal::end(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="box-title">Kelgan mahsulotlar ro'yhati</h4>
            </div>
            <div class="row">
                <div class="col-6">
                    <form action="#" method="post" class="form-horizontal">
                        <div class="input-group pl-4 pt-1">
                            <input type="email" id="input2-group2" name="input2-group2" placeholder="Mahsulot nomini kiriting" class="form-control">
                            <div class="input-group-btn"><button class="btn btn-primary">Qidirish</button></div>
                        </div>
                    </form>
                </div>
                <div class="offset-1 col-4">
                    <a id="buttoninmodal" class="btn btn-success" href="<?= Url::to(['received/qabul'])?>" data-toggle="modal">Mahsulot qo'shish</a>
                </div>
            </div>
            <div class="row">
                <?php if(count($data) == 0):?>
                <div class="col-lg-12">
                    <div class="card-body text-center">
                        Hech qanday mahsulot topilmadi!
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-12">
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Nomi</th>
                                <th>Soni</th>
                                <th>Narxi</th>
                                <th>Yetkazib beruvchi</th>
                                <th>Sana</th>
                            </tr>
                            </thead>
                            <?php Pjax::begin(['id' => 'receiveditems']); ?>
                            <?php foreach ($data as $item):?>
                                <tbody>
                                    <td><?=$item['name']?></td>
                                    <td><?=($item['quantity'])?></td>
                                    <td><?=$item['r_price']?></td>
                                    <td><?=$item['c_name']?></td>
                                    <td><?=$item['date']?></td>
                                </tbody>
                            <?php endforeach;?>
                            <?php Pjax::end();?>
                        </table>
                    </div>
                </div>
                <?php endif;?>
            </div> <!-- /.row -->
            <div class="card-body"></div>
        </div>
    </div><!-- /# column -->
</div>
<?php
    $js = <<<JS
    jQuery(document).ready(function($) {
        function send(_url, formdata = null){
         $.ajax({
            url: _url,
            type: 'POST',
            dataType: 'JSON',
            data: formData,
            success: function(data) {
              console.log(data);
            }
         });   
        }
      $('#buttoninmodal').click(function (e){
          e.preventDefault();
          let url = $(this).attr('href');
          $('#qabul').modal('show');
          send(url);
      });
    });
    
    JS;
    $this->registerJs($js);
?>