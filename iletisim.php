<?php
require_once('header.php');
?>

<title>Bize Ulaşın</title>
<meta name="description" content="<?=ayar('site_aciklama')?>"/>
<meta name="keywords" content="<?=ayar('site_meta')?>"/> 

<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(images/resources/breadcrumb-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <div class="title">
                       <h1><i class="fa fa-envelope" aria-hidden="true"></i> Bize Ulaşın</h1>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul class="clearfix">
                            <li><a href="<?=$site?>">Ana Sayfa</a></li>
                            <li class="active">Bize Ulaşın</li>
                        </ul>    
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>
<!--End breadcrumb area-->

<!--Start contact form area-->
<section class="contact-info-area">
    <div class="container">
        <div class="row">
           
            <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
                <div class="contact-box-content">
                    <div class="img-holder">
                        <img src="images/resources/contact.jpg" alt="Awesome Image">
                    </div> 
                    <div class="text-holder">
                        <div class="row">
                           
                            <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
                                <div class="opening-hours text-center">
                                    <div class="title-box center text-center">
                                        <h3>Çalışma Saatleri</h3>
                                    </div>
                                    <div class="inner-content">
                                        <h1><?=ayar('calisma_saat')?></h1>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                                <div class="quick-contact-box">
                                    <div class="title-box">
                                        <h3>İletişim Bilgileri</h3>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="icon-holder">
                                                <span class="flaticon-phone"></span>    
                                            </div>
                                            <div class="title-holder">
                                                <p><?=ayar('site_telefon')?></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon-holder">
                                                <span class="flaticon-mail"></span>    
                                            </div>
                                            <div class="title-holder">
                                                <p><?=ayar('site_mail')?></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon-holder">
                                                <span class="flaticon-global"></span>    
                                            </div>
                                            <div class="title-holder">
                                                <p><?=ayar('site_adres')?></p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="map-find">
                                        <a class="btn-two" href="mailto:<?=ayar('site_mail')?>">E-Posta Gönder<span class="flaticon-next"></span></a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>   
                    </div>     
                </div>    
            </div>
            
            <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
                <div class="contact-form">
                    <div class="sec-title">
                        <div class="inner clr2"><span class="clr2">Size Nasıl Yardımcı Olabiliriz?</span></div>
                        <div class="title clr2">Bize Mesaj Gönderin.</div>
                    </div>
                    <div id="sonuc"></div>
                    <form id="contact-form" action="" method="" class="default-form" onsubmit="return false">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-box">   
                                    <input type="text" name="form_name" value="" placeholder="Adınız & Soyadınız*" required="">
                                </div>
                                <div class="input-box"> 
                                    <input type="email" name="form_email" value="" placeholder="E-Posta Adresiniz" required="">
                                </div>
                                <div class="input-box"> 
                                    <input type="email" name="form_email" value="" placeholder="GSM Numaranız" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-box"> 
                                    <input type="email" name="form_email" value="" placeholder="Konu Başlığ" required="">
                                </div>
                                <div class="input-box">    
                                    <textarea name="form_message" placeholder="Mesajınız.." required></textarea>
                                </div> 
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <button id="iltbtn" class="btn-two thm-bg-clr" type="submit" data-loading-text="Lütfen Bekleyin...">Mesajı Gönder<span class="flaticon-next"></span></button>
                            </div>
                        </div>
                        <input type="hidden" name="ipcode" value="<?=getRealIpAddr()?>" />
          				<input type="hidden" name="<?=$token_id?>" value="<?=$token_value?>" />
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End contact form area-->

<!--Start location map area-->
<section class="location-map-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-12 col-sm-12">   
                <div class="location-box">
                    <div class="title">
                        <h3>Harita Konumumuz</h3>
                    </div>
                    <div id="scrollbar1">
                        <div class="scrollbar">
                            <div class="track">
                                <div class="thumb">
                                    <div class="end"></div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-box viewport">
                            <div class="overview">
                               Harita konumunu seçerek bulunduğumuz konumu inceleyebilirsiniz, daha detaylı inceleme yapmak için haritanın sağında bulunan harita tam ekran moduna geçebilir, konumu bulunduğunuz noktadan itibaren navigasyon için kullanabilirsiniz.
                            </div>
                        </div>
                    </div>  
                </div> 
            </div>
            
            <?php 
			$bilgi = ayar('googlemap_coords'); 
			$LatLong = explode(",",$bilgi);  
			?>
            
            <div class="col-xl-8 col-lg-7 col-md-12 col-sm-12">
                <div class="google-map-box">
                    <div 
                        class="google-map" 
                        id="contact-google-map" 
                        data-map-lat="<?=$LatLong[0]?>" 
                        data-map-lng="<?=$LatLong[1]?>" 
                        data-icon-path="images/resources/map-marker-3.png" 
                        data-map-title="Bulunduğumuz Konum" 
                        data-map-zoom="12" 
                        data-markers='{
                            "marker-1": [<?=$LatLong[0]?>, <?=$LatLong[1]?>, "<h4>Bulunduğumuz Konum</h4>"]

                        }'>
                    </div>
                    
                    
                </div>    
            </div>
            
        </div>
    </div>
</section>
<!--End location map area-->

<script src="https://maps.googleapis.com/maps/api/js?key=<?=ayar('googlemap_key');?>"></script>
<?php require_once('footer.php'); ?>