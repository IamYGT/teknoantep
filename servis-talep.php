<?php
require_once('header.php');
?>

<title>Servis Talep Formu</title>
<meta name="description" content="<?=ayar('site_aciklama')?>"/>
<meta name="keywords" content="<?=ayar('site_meta')?>"/>

<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(images/resources/breadcrumb-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <div class="title">
                       <h1><i class="fa fa-wrench" aria-hidden="true"></i> Servis Talep</h1>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul class="clearfix">
                            <li><a href="<?=$site?>">Ana Sayfa</a></li>
                            <li class="active">Servis Talep</li>
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
                <div class="title">
                    <h2><i class="fa fa-wrench"></i> Servis Talep Formu</h2>
                    <?=bilgi('warning','<i class="fa fa-info-circle" aria-hidden="true"></i> Lütfen servis talebini girerken yaşadığınız sorun ile ilgili kısa bir bilgi veriniz.'); ?>
                </div>
                <div id="sonuc"></div>
                <form id="iltfrmx" action="" method="" onsubmit="return false">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="text" name="adiniz" class="form-control" placeholder="Adınız & Soyadınız*" required="" style="height:45px; border-radius:0px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <input type="text" name="gsmno" class="form-control" placeholder="GSM Numaranız*" style="height:45px; border-radius:0px;">
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" name="email" class="form-control" placeholder="E-Posta Adresiniz" style="height:45px; border-radius:0px;">
                        </div>
                        <div class="col-md-4 form-group">
                            <input id="giristarih" class="form-control" type="date" name="tarihi" placeholder="Servis Ne Zaman Gelsin?" style="height:45px; border-radius:0px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <textarea name="adres" placeholder="Adresiniz.." rows="5" class="form-control" style="border-radius:0px;" required></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea name="mesaj" placeholder="Mesajınız.." rows="5" class="form-control" style="border-radius:0px;" required></textarea>
                        </div>
                    </div>
                    <div class="row" style="">
                        <div class="col-md-6 form-group">
                            <div class="g-recaptcha" data-sitekey="<?=$gsitekey?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input id="iltbtnx" type="submit" class="btn btn-primary" value="TALEBİ GÖNDER"/ style="padding:15px; width:100%;">
                        </div>
                    </div>
                    <input type="hidden" name="ipcode" value="<?=getRealIpAddr()?>" />
                    <input type="hidden" name="<?=$token_id?>" value="<?=$token_value?>" />
                </form>
                </div>   
        </div>
    </div>
</section>
<!--End about content area-->
                                                                           
<?php require_once('footer.php');?>