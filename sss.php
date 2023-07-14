<?php
@$page = 'sayfa';
require_once('header.php');
?>

<title>Sıkça Sorulan Sorular | <?=ayar('site_baslik')?></title>
<meta name="keywords" content="<?=ayar('site_meta')?>" />
<meta name="description" content="<?=ayar('site_aciklama')?>">

<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(images/resources/breadcrumb-bg-v2.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <div class="title">
                       <h1><i class="fa fa-question-circle" aria-hidden="true"></i> Sıkça Sorulan Sorular</h1>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul class="clearfix">
                            <li><a href="<?=$site?>">Ana Sayfa</a></li>
                            <li class="active">S.S.S</li>
                        </ul>    
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>
<!--End breadcrumb area-->
 
<!--Start faq area-->
<section class="faq-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="faq-content-box">
                   
                    <div class="inner-content">
                        <?php
						$sss = $db->table('dbo_sss')
									->orderBy('sira','asc')
									->getAll();
						foreach($sss as $liste){
						?>
                        <!--Start single box-->
                        <div class="single-box">
                            <div class="left-content">
                                <h2>S</h2>
                                <h3><?=$liste->soru?></h3>
                            </div> 
                            <div class="right-content" style="max-width:800px;">
                                <h2>C</h2> 
                                <p><?=$liste->cevap?></p>   
                            </div>   
                        </div>
                        <!--End single box-->
                        <?php } ?>      
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
</section>   
<!--End faq area-->   
<?php require_once('footer.php');?>