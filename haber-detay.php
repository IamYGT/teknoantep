<?php
require_once("header.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_blog')->where('BlogID','=',$duzenid)->getRow();
if(!$oku){
	yonver($site);
	exit();
}
?>

<title><?=$oku->blog_baslik?></title>
<meta name="keywords" content="<?=$oku->blog_meta?>" />
<meta name="description" content="<?=$oku->blog_desc?>">  

<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(images/resources/breadcrumb-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <div class="title">
                       <h1><i class="fa fa-file-text-o" aria-hidden="true"></i> <?=$oku->blog_baslik?></h1>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul class="clearfix">
                            <li><a href="<?=$site?>">Ana Sayfa</a></li>
                            <li class="active">Haber Detayı</li>
                        </ul>    
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>
<!--End breadcrumb area-->                                

<!--Start about content area-->
<section class="about-content-area">
    <div class="container inner-content">
        <div class="row">
            <!--Start single blog post-->
            <div class="col-md-12">
                <div class="about-content-box">
                    <h1><?=$oku->blog_baslik?></h1>
                    <p><?=$oku->blog_icerik?></p>   
                </div>
            </div>
        </div>
    </div>
</section>
<!--End about content area-->
                                                                           
<?php require_once('footer.php');?>