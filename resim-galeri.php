<?php
require_once('header.php');
?>

<title>Resim Galeri | <?=ayar('site_baslik')?></title>
<meta name="keywords" content="<?=ayar('site_meta')?>" />
<meta name="description" content="<?=ayar('site_aciklama')?>"> 

<link rel="stylesheet" type="text/css" href="<?php cdn();?>css/sweetalert.css">

<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(images/resources/breadcrumb-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <div class="title">
                       <h1><i class="fa fa-picture-o" aria-hidden="true"></i> Resim Galeri</h1>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul class="clearfix">
                            <li><a href="<?=$site?>">Ana Sayfa</a></li>
                            <li class="active">Resim Galeri</li>
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
                <?php
				$resim = $db->table('dbo_resim_galeri as galeri')
							->orderBy('resgal_sira','asc')
							->getall();
				foreach($resim as $resimget){
				?>
				<div class="col-md-3" style="margin-bottom:15px; float:left;">
					<a href="uploads/resimgaleri/<?=$resimget->resgal_resim?>" class="swipebox">
						<img src="uploads/resimgaleri/<?=$resimget->resgal_resim?>" style="height:200px; width:100%;">
					</a>
				</div>
				<?php } ?>
            </div>
        </div>
    </div>
</section>
<!--End about content area-->
                                                                           
<?php require_once('footer.php');?>
<script type="text/javascript" src="js/jquery.swipebox.js"></script>
<script type="text/javascript">
;( function($){
	$('.swipebox').swipebox();
} )(jQuery);
</script>