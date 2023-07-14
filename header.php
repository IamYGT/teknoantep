<?php
define('INC', true);
require_once("include/functions.php");
sec_session_start();
require_once("system/csrf.class.php");

$csrf = new csrf();
 
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
?>
<!DOCTYPE html>
<html lang="tr">
<base href="<?=$site?>/" />
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-------------------------------------------------------------------------------------->
<?php if($page == 'index'){ ?>
<title><?=ayar('site_baslik')?></title>
<meta name="keywords" content="<?=ayar('site_meta')?>">
<meta name="description" content="<?=ayar('site_aciklama')?>">
<meta http-equiv="reply-to" content="<?=ayar('site_mail')?>"/>
<?php } ?>
<meta name="revisit-after" content="7 days">
<meta name="robots" content="index, follow" />
<meta http-equiv="content-language" content="TR" />
<link rel="canonical" href="<?=ayar('site_http').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
<link rel="shortcut icon" href="uploads/genelresim/<?=ayar('site_logo_favicon')?>" type="image/x-icon">
<!-------------------------------------------------------------------------------------->
<link rel="stylesheet" href="<?php cdn();?>css/style.css">
<link rel="stylesheet" href="<?php cdn();?>css/responsive.css">
<link rel="stylesheet" href="<?php cdn();?>css/color-switcher-design.css">
<link rel="stylesheet" href="<?php cdn();?>css/color-themes/default-theme.css" id="theme-color-file">
<link rel="stylesheet" href="<?php cdn();?>css/swipebox.css">
<script src='https://www.google.com/recaptcha/api.js' defer></script>
<!-------------------------------------------------------------------------------------->
<?php 
/**********************************************************************/
if(ayar('site_durum') == 'Kapali' && $page != 'bakim'){ yonver('bakim/'); }
if(!empty(ayar('google_site_verification'))){ echo ayar('google_site_verification'); }
if(!empty(ayar('yandex_site_verification'))){ echo ayar('yandex_site_verification'); }
if(!empty(ayar('one_signal'))){ echo ayar('one_signal'); }
if(!empty(ayar('google_adsense'))){ echo ayar('google_adsense'); }
if(!empty(ayar('google_analyics'))){ echo ayar('google_analyics'); }
if(!empty(ayar('destek_kod'))){ echo ayar('destek_kod'); }
/**********************************************************************/
?>
<!-- Fixing Internet Explorer-->
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="js/html5shiv.js"></script>
<![endif]-->

<body>
<div class="boxed_wrapper">

<!-- Start Top Bar style1 -->  
<section class="top-bar-style2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="top-bar clearfix">
                    <ul class="topmenu float-left">
                        <li><a href="iletisim/">Bize Her Konuda Ulaşabilirsiniz.</a></li>
                    </ul>
                </div>    
            </div>
        </div>
    </div>
</section>
<!-- End Top Bar style1 -->  
 
<!--Start header style2 area-->
<header class="header-style2-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="inner-content clearfix">
                    <div class="header-style2-logo float-left">
                        <a href="<?=$site?>">
                            <img src="uploads/genelresim/<?=ayar('site_logo')?>" alt="<?=ayar('site_baslik')?>">
                        </a>
                    </div>   
                    <div class="headers2-header-right float-right">
                        <ul>
                            <li>
                                <div class="single-item">
                                    <p><span class="flaticon-clock"></span>Çalışma Saatleri</p>
                                    <span><?=ayar('calisma_saat')?></span>
                                </div>
                            </li>
                            <li>
                                <div class="single-item">
                                    <p><span class="flaticon-global"></span>E-Posta</p>
                                    <span><?=ayar('site_mail')?></span>
                                </div>
                            </li>
                            <li>
                                <div class="single-item">
                                    <h3>Müşteri Hizmetleri:<span><?=ayar('site_telefon')?></span></h3>
                                </div>
                            </li>
                        </ul>    
                    </div>
                </div>
            </div>
        </div>
    </div>        
</header>  
<!--End header style2 area-->
  
<!--Start mainmenu area style2-->
<section class="mainmenu-area style2 stricky">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <nav class="main-menu clearfix">
                        <div class="navbar-header clearfix">   	
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <?php
								$sql_kategori = $db->table('dbo_menu')->orderBy('sira','asc')->getAll();
								$kategori_list=array();
								$i=0;
								foreach($sql_kategori as $row_kategori){
									$kategori_list[$i]['menu_id']=$row_kategori->MenuID;
									$kategori_list[$i]['menu_baslik']=$row_kategori->menu;
									$kategori_list[$i]['menu_altid']=$row_kategori->ustid;
									$kategori_list[$i]['menu_tipi']=$row_kategori->menutipi;
									$kategori_list[$i]['menu_link']=$row_kategori->link;
									$kategori_list[$i]['menu_sayfa']=$row_kategori->sayfaid;
									$i++;
								}
									echo  SinirsizKategoriListele($kategori_list);
								?>
                            </ul>
                        </div>
                    </nav>
                    <div class="button">
                        <a href="servis/"><span class="flaticon-calendar-1"></span>Servis Çağır</a>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</section>                 
<!--End mainmenu area style2-->  