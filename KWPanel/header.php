<?php
ob_start();
define('INC', true);
require_once("../include/functions.php");
require_once("../system/class-admin.php");
sec_session_start();

if(admin_login_check($db) != true) {
	yonver('../system/logout.html');
	exit();
}

$admin_id = $_SESSION['admin_id'];

if(empty(admin_bilgi('adsoyadi',$admin_id)) || empty(admin_bilgi('kullaniciadi',$admin_id))){
	yonver('../system/logout.html');
	exit();
}
?>
<!DOCTYPE html>
<html>

<head lang="tr">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>:: Yönetici Paneli ::</title>

	<link href="img/favicon.144x144.html" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.html" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.html" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.html" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.html" rel="icon" type="image/png">
	<link href="img/favicon-2.html" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<link rel="stylesheet" href="css/lib/lobipanel/lobipanel.min.css">
<link rel="stylesheet" href="css/separate/vendor/lobipanel.min.css">
<link rel="stylesheet" href="css/lib/jqueryui/jquery-ui.min.css">
<link rel="stylesheet" href="css/separate/pages/widgets.min.css">
<link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
<link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/custom.css">
</head>
<body class="with-side-menu theme-picton-blue-white-ebony <?php if(@$page == 'panelim'){ ?>control-panel control-panel-compact<?php } ?>">

	<header class="site-header">
	    <div class="container-fluid">
	
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="../thumb.php?src=./uploads/genelresim/<?=ayar('site_logo')?>&size=200&crop=0" alt="">
	            <img class="hidden-lg-up" src="../thumb.php?src=./uploads/genelresim/<?=ayar('site_logo')?>&size=50X50&crop=0" alt="">
	        </a>

	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="img/avatar-2-64.png" alt=""><?=admin_bilgi('adsoyadi',$admin_id)?>
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="yonetici-liste.html"><span class="font-icon glyphicon glyphicon-user"></span>Profilim</a>
	                            <a class="dropdown-item" href="site-ayarlar.html"><span class="font-icon glyphicon glyphicon-cog"></span>Site Ayarları</a>
	                            <div class="dropdown-divider"></div>
	                            <a class="dropdown-item" href="../system/logout.html"><span class="font-icon glyphicon glyphicon-log-out"></span>Çıkış Yap</a>
	                        </div>
	                    </div>
	
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->