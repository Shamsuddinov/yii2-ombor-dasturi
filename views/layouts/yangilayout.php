<?php
/* @var $this yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php $this->title ?></title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">-->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">-->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">-->
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?= Url::to(['received/']); ?>"><i class="menu-icon fa fa-laptop"></i>Products</a>
                </li>
                <li class="menu-title">Menu</li><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder-o"></i>Products</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-exchange"></i><a href="<?= Url::to(['details/'])?>">Received products</a></li>
                        <li><i class="fa fa-list"></i><a href="<?= Url::to(['sold/'])?>">Sell products</a></li>
                        <li><i class="fa fa-list"></i><a href="<?= Url::to(['invoice/'])?>">Invoice</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Control panel</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-linux"></i><a href="<?= Url::to(['brand/'])?>">Edit brands</a></li>
                        <li><i class="fa fa-pencil-square-o"></i><a href="<?= Url::to(['product/'])?>">Edit products</a></li>
                        <li><i class="fa fa-th-list"></i><a href="<?= Url::to(['product-type/'])?>">Edit categories</a></li>
                        <li><i class="fa fa-user"></i><a href="<?= Url::to(['contragent/'])?>">Edit counter agents</a></li>
                        <li><i class="fa fa-user"></i><a href="<?= Url::to(['measurement/'])?>">Edit measurement</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-info-circle"></i>Report</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-linux"></i><a href="<?= Url::to(['received/received-products-report'])?>">Received product's report</a></li>
                        <li><i class="fa fa-linux"></i><a href="<?= Url::to(['received/received-products-report-with-table'])?>">Received product's report with table</a></li>
                        <li><i class="fa fa-pencil-square-o"></i><a href="<?= Url::to(['sold/sold-products-report'])?>">Sold product's report</a></li>
                        <li><i class="fa fa-pencil-square-o"></i><a href="<?= Url::to(['product-balance/product-balance-report'])?>">Product balance report</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Organizations</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-linux"></i><a href="<?= Url::to(['auth-item/index'])?>">Permissions</a></li>
                        <li><i class="fa fa-address-book"></i><a href="<?= Url::to(['auth-item/index-rules'])?>">Rules</a></li>
                        <li><i class="fa fa-th-list"></i><a href="<?= Url::to(['users/'])?>">Users</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="./"><img src="../images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="../images/logo2.png" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="header-left">
                    <button class="search-trigger"><i class="fa fa-search"></i></button>
                    <div class="form-inline">
                        <form class="search-form">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                        </form>
                    </div>

                    <div class="dropdown for-notification">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?=strtoupper(Yii::$app->language) ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                            <?php foreach (Yii::$app->params['language'] as $item => $key): ?>
                                <a class="dropdown-item media" style="text-align: center;"
                                   href="<?=Url::to(['site/language', 'language' => $item])?>">
                                    <p><?=$key ?></p>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">3</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                            <p class="red">You have 3 Notification</p>
                            <a class="dropdown-item media" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <i class="fa fa-warning"></i>
                                <p>Server #3 overloaded.</p>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown for-message">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                            <span class="count bg-primary">4</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="message">
                            <p class="red">You have 4 Mails</p>
                            <a class="dropdown-item media" href="#">
                                <span class="photo media-left"><img alt="avatar" src="../images/avatar/1.jpg"></span>
                                <div class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                    <p>Hello, this is an example msg</p>
                                </div>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <span class="photo media-left"><img alt="avatar" src="../images/avatar/2.jpg"></span>
                                <div class="message media-body">
                                    <span class="name float-left">Jack Sanders</span>
                                    <span class="time float-right">5 minutes ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </div>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <span class="photo media-left"><img alt="avatar" src="../images/avatar/3.jpg"></span>
                                <div class="message media-body">
                                    <span class="name float-left">Cheryl Wheeler</span>
                                    <span class="time float-right">10 minutes ago</span>
                                    <p>Hello, this is an example msg</p>
                                </div>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <span class="photo media-left"><img alt="avatar" src="../images/avatar/4.jpg"></span>
                                <div class="message media-body">
                                    <span class="name float-left">Rachel Santos</span>
                                    <span class="time float-right">15 minutes ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="../images/admin.jpg" alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                        <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                        <a class="nav-link" href="<?= Url::to(['site/login']) ?>"><i class="fa fa -cog"></i>Login</a>

                        <a class="nav-link" data-method="POST" href="<?= Url::to(['site/logout']) ?>"><i class="fa fa-power -off"></i>Logout</a>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- /#header -->
    <!-- Content -->
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
                <?= $content ?>
        </div>
        <!-- .animated -->
    </div>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-6">
                    Copyright &copy; 2018 Ela Admin
                </div>
                <div class="col-sm-6 text-right">
                    Designed by <a href="https://colorlib.com">Colorlib</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- /.site-footer -->
</div>
<!-- /#right-panel -->

<!-- Scripts -->
<?php
$title = Yii::t('app', 'Are you sure?');
$text = Yii::t('app', 'You won`t be able to revert this!');
$delete = Yii::t('app', 'Delete');
$cancel = Yii::t('app', 'Cancel');
$goto = Url::to(['details/index']);
$js = <<<JS
   let items = $('.menu-item-has-children');
   let page_url = location.pathname + location.search;
   let i_found_it = false;
    items.map((id, item) => {
       let child_ul = $(item).find('ul > li');
       child_ul.map((id, li_item) => {
          if($(li_item).find('a').attr('href') === page_url){
              $(li_item).find('a').css('color', '#4b48b7').css('font-weight', 'bold');
              i_found_it = true;
          }
       });
       if(i_found_it){
           $(items[id]).addClass('show').find('ul.sub-menu').addClass('show');
           i_found_it = !i_found_it;
           return false;
       }
    });
   let selectBody = $('body');
   selectBody.delegate('.delete-items-with-ajax','click',function (event){
      event.preventDefault();
      let url = $(this).attr('href');
      swal({
          title: '$title',
          text: '$text',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: '$delete',
          cancelButtonText: '$cancel',
          padding: '2em'
        }).then(function(result) {
          if (result.value) {
              $.ajax({
                    url: url,
                    type: "POST",
                    success: function (res) {
                        if (res['status'] === 'true') {
                            swal(res['saved_one'], res['saved'], 'success')
                            location.reload();
                        } else {
                            swal( res['error_one'], res['error'], 'warning')
                        }
                    }
              });
          }
        })
    });
   selectBody.delegate('.delete-button-ajax','click',function (event){
      event.preventDefault();
      let tr = $(this).parents('tr');
      let url = $(this).attr('href');
      swal({
          title: '$title',
          text: '$text',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: '$delete',
          cancelButtonText: '$cancel',
          padding: '2em'
        }).then(function(result) {
          if (result.value) {
              $.ajax({
                    url: url,
                    type: "POST",
                    success: function (res) {
                        if (res['status'] === 'true') {
                            swal(
                              res['saved_one'],
                              res['saved'],
                              'success'
                            )
                           $(tr).remove();
                        } else {
                            swal(
                              res['error_one'],
                              res['error'],
                              'warning'
                            )
                        }
                    }
              });
          }
        })
    });
   selectBody.delegate('.delete-with-ajax','click',function (event){
      event.preventDefault();
      let url = $(this).attr('href');
      swal({
          title: '$title',
          text: '$text',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: '$delete',
          cancelButtonText: '$cancel',
          padding: '2em'
        }).then(function(result) {
          if (result.value) {    
              $.ajax({
                    url: url,
                    type: "POST",
                    success: function (res) {
                        if (res['status'] === 'true') {
                            location.reload('$goto');
                            swal({
                                title: res['saved_one'],
                                text: res['saved'],
                                type: 'success',
                                timer: 20000,
                                timerProgressBar: true
                            });
                        } else {
                            swal(
                              res['error_one'],
                              res['error'],
                              'warning'
                            )
                        }
                    }
              });
          }
        })
    });
   
JS;
$this->registerJs($js);
$flash = Yii::$app->session;
if($flash->hasFlash('success')){
    $content = $flash->getFlash('success');
    $alert = <<<JS
        swal('Success!', '$content', 'success');
    JS;
    $this->registerJs($alert);
} elseif($flash->hasFlash('danger')){
    $content = $flash->getFlash('danger');
    $alert = <<<JS
        swal('Danger!', '$content', 'warning');
    JS;
    $this->registerJs($alert);
}
if($flash->hasFlash('modal-on')){
    Modal::begin([
        'id' => 'myModal',
        'header' => '<h2 id="modal-header"></h2>',
        'size' => 'modal-lg'
    ]);

    echo '<div id="modalBody"></div>';

    Modal::end();
}
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>