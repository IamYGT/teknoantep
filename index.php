<?php
$page = 'index';
require_once('header.php');
?>           
    
<!--Main Slider-->
<section class="main-slider">
    <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_two_wrapper" data-source="gallery">
        <div class="rev_slider fullwidthabanner" id="rev_slider_two" data-version="5.4.1">
            <ul>
            	<?php
				$slide = $db->table('dbo_slide')
							->orderBy('slide_sira','asc')
							->getall();
				foreach($slide as $liste){
				?>
                <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-<?=$liste->SlideID?>" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="uploads/slider/<?=$liste->slide_resim?>" data-title="Slide Title" data-transition="parallaxvertical">

                    <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="uploads/slider/<?=$liste->slide_resim?>"> 

                    <div class="tp-caption" 
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingtop="[0,0,0,0]"
                    data-responsive_offset="on"
                    data-type="text"
                    data-height="none"
                    data-width="['700','700','500','290']"
                    data-whitespace="normal"
                    data-hoffset="['15','15','15','15']"
                    data-voffset="['-80','-90','-100','-110']"
                    data-x="['left','left','left','left']"
                    data-y="['middle','middle','middle','middle']"
                    data-textalign="['top','top','top','top']"
                    data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                    style="z-index: 7; white-space: nowrap;text-transform:left;">
                        <div class="slide-content left-slide">
                            <div class="big-title" style="color:<?=$liste->slide_renk_a?>;">
								<?=$liste->slide_yazi_a?>
                            </div> 
                        </div>
                    </div>
                
                    <div class="tp-caption" 
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingtop="[0,0,0,0]"
                    data-responsive_offset="on"
                    data-type="text"
                    data-height="none"
                    data-whitespace="normal"
                    data-width="['700','700','500','290']"
                    data-hoffset="['15','15','15','15']"
                    data-voffset="['40','30','-10','-30']"
                    data-x="['left','left','left','left']"
                    data-y="['middle','middle','middle','middle']"
                    data-textalign="['top','top','top','top']"
                    data-frames='[{"from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                    style="z-index: 7; white-space: nowrap;text-transform:left;">
                        <div class="slide-content left-slide">
                            <div class="text" style="color:<?=$liste->slide_renk_b?>;"><?=$liste->slide_yazi_b?></div>     
                        </div>
                    </div>

                    <div class="tp-caption tp-resizeme" 
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingtop="[0,0,0,0]"
                    data-responsive_offset="on"
                    data-type="text"
                    data-height="none"
                    data-width="['700','700','500','290']"
                    data-whitespace="normal"
                    data-hoffset="['15','15','15','15']"
                    data-voffset="['125','110','70','80']"
                    data-x="['left','left','left','left']"
                    data-y="['middle','middle','middle','middle']"
                    data-textalign="['top','top','top','top']"
                    data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                    style="z-index: 7; white-space: nowrap;text-transform:left;">
                        <div class="slide-content left-slide">
                            <div class="btn-box">
                                <?php if(!empty($liste->slide_buton_url)){ ?>
                                    <a class="btn-one sb1" href="<?=$liste->slide_buton_url?>"><?=$liste->slide_buton?> <span class="flaticon-next"></span></a>
                                <?php } ?>
                            </div>    
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<!--End Main Slider-->

<!--Start Service Style2 Area-->
<section class="services-style2-area" style="background-image: url(images/parallax-background/service-bg.jpg);">
    <div class="container">
        <div class="sec-title text-center">
            <div class="title"><?=dil('LNG1');?></div>
            <p><?=dil('LNG2');?></p>
        </div>
        <div class="row">
            <?php
			$hizmet = $db->table('dbo_hizmet')
						 ->orderByRand()
						 ->limit(3)
						 ->getAll();
			foreach($hizmet as $liste){
			?>
            <!--Start single service style1-->
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="single-service-style2 text-center">
                    <div class="icon-holder">
                        <span class="flaticon-pc"></span>  
                        <div class="overlay-content">
                            <div class="box">
                                <div class="content">
                                    <div class="inner-content">
                                        <div class="img-holder">
                                            <img src="uploads/hizmetler/<?=$liste->hizmet_resim?>" alt="<?=$liste->hizmet_adi?>">
                                        </div>
                                        <div class="text-holder">
                                            <p><?=kisalt($liste->hizmet_aciklama,100)?></p>
                                            <a class="btn-two info" href="hizmet/<?=$liste->HizmetID?>/<?=seo($liste->hizmet_adi)?>/">İncele<span class="flaticon-next"></span></a>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="title-holder">
                        <h3><a href="hizmet/<?=$liste->HizmetID?>/<?=seo($liste->hizmet_adi)?>/"><?=$liste->hizmet_adi?></a></h3>    
                    </div>    
                </div>     
            </div>
            <!--End single service style1-->
            <?php } ?>
        </div> 
    </div>    
</section>
<!--End Service style2 area-->


<!--Start Specialities area-->
<section class="specialities-area" style="background-image: url(images/parallax-background/specialities-bg.jpg);">
    <div class="container">
        <div class="row">
                        
            <div class="col-md-12">
                <div class="specialities-content">
                    <div class="sec-title">
                        <div class="title clrwhite"><?=dil('LNG3');?></div>
                    </div>
                    <p><?=dil('LNG4');?></p>
                </div>    
            </div>
            
        </div>
    </div>
</section>
<!--End Specialities area-->

<!--Start fact counter area-->
<section class="fact-counter-area" style="background-image: url(images/parallax-background/fact-counter-bg.jpg);">
    <div class="container">
       
        <div class="sec-title text-center">
            <div class="title clr2"><?=dil('LNG5');?></div>
        </div>
        
        <div class="row">
            <!--Start single fact counter-->
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="single-fact-counter text-center">
                    <div class="count-box">
                        <div class="icon">
                            <span class="flaticon-wrench-1"></span>    
                        </div>
                        <h1>
                            <span class="timer" data-from="1" data-to="<?=dil('LNG6');?>" data-speed="5000" data-refresh-interval="50"><?=dil('LNG6');?></span>
                            <img class="plus" src="images/icon/plus-icon.png" alt="Plus Icon">
                        </h1>
                        <div class="title">
                            <h3><?=dil('LNG7');?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!--End single fact counter-->
            <!--Start single fact counter-->
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="single-fact-counter text-center">
                    <div class="count-box">
                        <div class="icon">
                            <span class="flaticon-warehouse"></span>    
                        </div>
                        <h1>
                            <span class="timer" data-from="1" data-to="<?=dil('LNG8');?>" data-speed="5000" data-refresh-interval="50"><?=dil('LNG8');?></span>
                            <img class="plus" src="images/icon/plus-icon.png" alt="Plus Icon">
                        </h1>
                        <div class="title">
                            <h3><?=dil('LNG9');?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!--End single fact counter-->
            <!--Start single fact counter-->
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="single-fact-counter text-center">
                    <div class="count-box">
                        <div class="icon">
                            <span class="flaticon-review"></span>    
                        </div>
                        <h1>
                            <span class="timer" data-from="1" data-to="<?=dil('LNG10');?>" data-speed="5000" data-refresh-interval="50"><?=dil('LNG10');?></span>
                            <img class="plus" src="images/icon/plus-icon.png" alt="Plus Icon">
                        </h1>
                        <div class="title">
                            <h3><?=dil('LNG11');?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!--End single fact counter-->
        </div>
        
    </div>
</section>
<!--End fact counter area-->

<!--Start Gallery area-->
<section class="gallery-area">
    <div class="container">
        <div class="row gallery">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 pd0">
                <div class="sec-title">
                    <div class="inner clr2"><span class="clr2"><?=dil('LNG12');?></span></div>
                    <div class="title clr2"><?=dil('LNG13');?></div>
                </div>
            </div>
            <?php
			$resim = $db->table('dbo_resim_galeri as galeri')
						->orderBy('resgal_sira','asc')
						->limit(7)
						->getall();
			foreach($resim as $resimget){
			?>
            <!--Start single gallery item-->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 single-gallery-item">
                <div class="img-holder">
                    <img src="uploads/resimgaleri/<?=$resimget->resgal_resim?>" alt="Awesome Image" style="height:313px;">
                    <div class="overlay-style-one">
                        <div class="box">
                            <div class="content">
                                <h3><a href="resim-galeri/">İncele</a></h3>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <!--End single gallery item-->
            <?php } ?>
            <!--Start single gallery item-->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 single-gallery-item more-works">
                <div class="button-holder">
                    <div class="overlay-style-one">
                        <div class="box">
                            <div class="content">
                                <a class="btn-two more-works" href="resim-galeri/">Tümünü İncele<span class="flaticon-next"></span></a>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <!--End single gallery item-->
        </div>
    </div>    
</section>    
<!--End Gallery area--> 

<!--Feedback Section-->
<section class="feedback-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-content clearfix">
                   
                    <div class="carousel-outer">
                        <div class="single-item-carousel owl-carousel owl-theme">
                            <?php
							$yorum = $db->table('dbo_yorum')
										->orderBy('YorumID','desc')
										->getall();
							foreach($yorum as $liste){
							?>
                            <!--Testimonial Block Three-->
                            <div class="testimonial-block-three">
                                <div class="inner-box">
                                    <div class="upper-box">
                                        <div class="content">
                                            <div class="text">“<?=$liste->yorum_icerik?>”</div>
                                        </div>
                                    </div>
                                    <div class="lower-box">
                                        <div class="client-info">
                                            <h3><?=$liste->yorum_adsoyad?></h3>
                                        </div>
                                        <div class="image-box">
                                            <img src="images/icon/choose-3.png" alt=""/>
                                        </div>
                                    </div>
                                    <div class="quote-icon">
                                        <span class="flaticon-quote"></span>    
                                    </div>
                                </div>
                            </div>
                            <!--Testimonial Block Three-->
                            <?php } ?>
                        </div>
                    </div>
                    <div class="video-holder">
                        <img src="images/resources/video-gallery-bg.jpg" alt="Awesome Video Gallery">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Feedback Section-->

<!--Start latest blog area-->
<section class="latest-blog-area style2">
    <div class="container inner-content">
       
        <div class="sec-title text-center">
            <div class="inner clr2"><span class="clr2"><?=dil('LNG14');?></span></div>
            <div class="title clr2"><?=dil('LNG15');?></div>
        </div>
        
        <div class="row">
            <?php
			$blog = $db->table('dbo_blog as blog')
					   ->leftJoin('dbo_blog_kat as kategori','kategori.BlogKatID=blog.blog_kat_id')
					   ->orderBy('blog.BlogID','desc')
					   ->limit(3)
			           ->getAll();
			foreach($blog as $blogget){
			?>
            <!--Start single blog post-->
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="single-blog-post style2 text-center">
                    <div class="img-holder">
                        <img src="uploads/blog/<?=$blogget->blog_resim?>" alt="<?=$blogget->blog_baslik?>">
                        <div class="date-box">
                            <span><?=cevirtarih($blogget->blog_tarih)?></span>
                        </div>
                    </div>
                    <div class="text-holder">
                        <h3 class="blog-title"><a href="haber-detay/<?=$blogget->BlogID?>/<?=seo($blogget->blog_baslik)?>/"><?=$blogget->blog_baslik?></a></h3>   
                    </div>
                    <div class="overlay-style-one">
                        <div class="box">
                            <div class="content">
                                <p><?=kisalt($blogget->blog_desc,200)?></p>
                                <a class="btn-two readmore" href="haber-detay/<?=$blogget->BlogID?>/<?=seo($blogget->blog_baslik)?>/">İncele<span class="flaticon-next"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End single blog post-->
            <?php } ?>
        </div>
        
    </div>
</section>
<!--End latest blog area-->                      
<?php require_once('footer.php'); ?>