<?php
require_once('header.php');
?>

<title>Haberler | <?=ayar('site_baslik')?></title>
<meta name="keywords" content="<?=ayar('site_meta')?>" />
<meta name="description" content="<?=ayar('site_aciklama')?>"> 

<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(images/resources/breadcrumb-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <div class="title">
                       <h1><i class="fa fa-newspaper-o" aria-hidden="true"></i> Haberler</h1>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul class="clearfix">
                            <li><a href="<?=$site?>">Ana Sayfa</a></li>
                            <li class="active">Haberler</li>
                        </ul>    
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>
<!--End breadcrumb area-->

<!--Start blog area-->
<section id="blog-area" class="blog-large-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7 col-md-12 col-sm-12">
                <div class="blog-post">
                    <?php
					$limit = 5;
					$sql_text = "SELECT * FROM dbo_blog WHERE BlogID ORDER BY BlogID DESC";
					$sayfa_get = guvenlik($_GET['sayfa']);
					if(!empty($sayfa_get) and is_numeric($sayfa_get)){
					$sayfa=($sayfa_get-1)*$limit;
					}else{
					$sayfa=0;
					}
					$sql = $db->customQuery($sql_text." LIMIT $sayfa, ".$limit)->getAll();
					
					$sayfa = $db->customQuery($sql_text)->getAll();
					$topla = $db->numRows();
					$toplam_kayit=$topla;
					if ($db->numRows() == 0){
						echo bilgi('danger','<i class="fa fa-exclamation-triangle"></i> Üzgünüz! kayıtlı yazı bulunamadı!');
					}else{
						foreach($sql as $blogget){
					?>
                    <!--Start single blog item-->
                    <div class="single-blog-post style2">
                        <div class="img-holder">
                            <img src="uploads/blog/<?=$blogget->blog_resim?>" alt="<?=$blogget->blog_baslik?>">
                            <div class="date-box">
                                <span><?=cevirtarih($blogget->blog_tarih)?></span>
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3 class="blog-title"><a href="haber-detay/<?=$blogget->BlogID?>/<?=seo($blogget->blog_baslik)?>/"><?=$blogget->blog_baslik?></a></h3>   
                            <div class="text">
                                <p><?=kisalt($blogget->blog_desc,250)?></p>
                                <a class="btn-two readmore" href="haber-detay/<?=$blogget->BlogID?>/<?=seo($blogget->blog_baslik)?>/">İncele<span class="flaticon-next"></span></a>
                            </div>
                        </div>
                    </div>
                    <!--End single blog item-->
                    <?php }} ?>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="post-pagination text-center">
                                <?php
								require_once('system/class.paginate.php');
								$sayfalama= new paginate();
								$sayfalama->sayfa=intval($_GET['sayfa']);
								$sayfalama->toplam=$toplam_kayit;
								$sayfalama->sayfa_basina=$limit;
								$sayfalama->type=0;
								$sayfalama->degisken='sayfa';
								$sayfalama->hazirla();
								echo $sayfalama->sayfala();
								unset($sayfalama); 
								?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Start sidebar Wrapper-->
            <div class="col-xl-4 col-lg-5 col-md-9 col-sm-12">
                <div class="sidebar-wrapper">
                    <!--Start single sidebar-->
                    <div class="single-sidebar martop-minus">
                        <div class="title-box">
                            <h3>Kategoriler</h3>
                        </div>
                        <ul class="categories clearfix">
                            <?php
							$blogkat = $db->table('dbo_blog_kat')
										  ->orderBy('blog_kat_adi','asc')
										  ->getAll();
							foreach($blogkat as $blogkatget){
							?>
                            <li><a href="haber-kategori/<?=$blogkatget->BlogKatID?>/<?=seo($blogkatget->blog_kat_adi)?>/"><?=$blogkatget->blog_kat_adi?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!--End single sidebar-->
                </div>    
            </div>
            <!--End Sidebar Wrapper-->
              
        </div>
    </div>
</section> 
<!--End blog area--> 

<?php require_once('footer.php'); ?>