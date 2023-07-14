<?php
@$page = 'panelim';
require_once("header.php"); 
require_once("menu-left.php");
?>
	<div class="page-content">
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-xl-12">
	                <div class="row">
	                    <div class="col-sm-3">
	                        <article class="statistic-box red">
	                            <div>
	                                <div class="number"><i class="fa fa-wrench" aria-hidden="true"></i> <?=TalepSay(0)?></div>
	                                <div class="caption"><div>Açık Servis Talepleri</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-3">
	                        <article class="statistic-box yellow">
	                            <div>
	                                <div class="number"><i class="fa fa-wrench" aria-hidden="true"></i> <?=TalepSay(1)?></div>
	                                <div class="caption"><div>Kapalı Servis Talepleri</div></div>
	                            </div>
	                        </article>
	                    </div>
                        <div class="col-sm-3">
	                        <article class="statistic-box red">
	                            <div>
	                                <div class="number"><i class="fa fa-envelope"></i> <?=MesajSay(0);?></div>
	                                <div class="caption"><div>Kontrol Bekleyen Mesaj</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
                        <div class="col-sm-3">
	                        <article class="statistic-box yellow">
	                            <div>
	                                <div class="number"><i class="fa fa-envelope-o"></i> <?=MesajSay(1);?></div>
	                                <div class="caption"><div>Kontrol Edilmiş Mesaj</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-3">
	                        <article class="statistic-box purple">
	                            <div>
	                                <div class="number"><i class="fa fa-file-text-o"></i> <?=SayfaSay()?></div>
	                                <div class="caption"><div>Toplam Sayfa</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
                        <div class="col-sm-3">
	                        <article class="statistic-box purple">
	                            <div>
	                                <div class="number"><i class="fa fa-newspaper-o"></i> <?=HaberSay()?></div>
	                                <div class="caption"><div>Toplam Haber</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
                        <div class="col-sm-3">
	                        <article class="statistic-box purple">
	                            <div>
	                                <div class="number"><i class="fa fa-picture-o"></i> <?=ResimSay()?></div>
	                                <div class="caption"><div>Toplam Resim</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
                        <div class="col-sm-3">
	                        <article class="statistic-box purple">
	                            <div>
	                                <div class="number"><i class="fa fa-file-video-o" aria-hidden="true"></i> <?=VideoSay()?></div>
	                                <div class="caption"><div>Toplam Video</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                </div><!--.row-->
	            </div><!--.col-->
	        </div><!--.row-->
	
	        <div class="row">
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">Kontrol Bekleyen Talepler</h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th><div>Durum</div></th>
	                                <th><div>Müşteri</div></th>
	                                <th align="center"><div>Gsm / Mail</div></th>
	                                <th align="center"><div>Tarih</div></th>
                                    <th align="center"><div>İşlem</div></th>
	                            </tr>
                                <?php
								$servis = $db->table('dbo_servis_talep')
											 ->orderBy('SrvTlpID','desc')
											 ->limit(20)
											 ->getAll();
								foreach($servis as $liste){
								?>
                                <tr>
	                                <td>
                                    <a href="servis-kontrol.html?id=<?=$liste->SrvTlpID?>">
                                    <?php if($liste->srv_goruldu == 1){ ?>
                                    <span class="label label-success"><i class="fa fa-search-plus"></i> Görüldü</span>
                                    <?php } ?>
                                    <?php if($liste->srv_goruldu == 0){ ?>
                                    <span class="label label-danger"><i class="fa fa-search-plus"></i> Kontrol Bekleniyor</span>
                                    <?php } ?>
                                    </a>
                                    </td>
	                                <td><?=$liste->srv_adsoyad?></td>
	                                <td align="center"><?=$liste->srv_gsmno?> / <?=$liste->srv_eposta?></td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold"></span><?=cevirtarih($liste->sv_ek_tarih)?></td>
                                    <td class="color-blue-grey" nowrap align="center">
                                    <a href="servis-kontrol.html?id=<?=$liste->SrvTlpID?>" class="btn btn-primary"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                    </td>
	                            </tr>
                                <?php } ?>
	                        </table>
	                    </div><!--.box-typical-body-->
	                </section><!--.box-typical-dashboard-->
	            </div><!--.1 Sol -->
                <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">Yeni Mesajlar</h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th><div>Durum</div></th>
	                                <th><div>Gönderen</div></th>
	                                <th align="center"><div>Gsm / Mail</div></th>
	                                <th align="center"><div>Tarih</div></th>
                                    <th align="center"><div>İşlem</div></th>
	                            </tr>
                                <?php
								$mesaj = $db->table('dbo_iletisim')
											 ->orderBy('iletisim_okundumu','asc')
											 ->limit(20)
											 ->getAll();
								foreach($mesaj as $liste){
								?>
                                <tr>
	                                <td>
                                    <a href="mesaj-oku.html?id=<?=$liste->IletID?>">
                                    <?php if($liste->iletisim_okundumu == 1){ ?>
                                    <span class="label label-success"><i class="fa fa-search-plus"></i> Görüldü</span>
                                    <?php } ?>
                                    <?php if($liste->iletisim_okundumu == 0){ ?>
                                    <span class="label label-danger"><i class="fa fa-search-plus"></i> Kontrol Bekleniyor</span>
                                    <?php } ?>
                                    </a>
                                    </td>
	                                <td><?=$liste->iletisim_adiniz?></td>
	                                <td align="center"><?=$liste->iletisim_gsmno?> / <?=$liste->iletisim_email?></td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold"></span><?=cevirtarih($liste->iletisim_tarih)?></td>
                                    <td class="color-blue-grey" nowrap align="center">
                                    <a href="mesaj-oku.html?id=<?=$liste->IletID?>" class="btn btn-primary"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                    </td>
	                            </tr>
                                <?php } ?>
	                        </table>
	                    </div><!--.box-typical-body-->
	                </section><!--.box-typical-dashboard-->
	            </div><!--.2 Sağ -->
	        </div>
	    </div><!--.container-fluid-->
	</div><!--.page-content-->

	<div class="control-panel-container">
	    <ul>
	        <li class="sticky-note">
	            <div class="control-item-header">
	                <a href="<?=$site?>" class="icon-toggle" target="_blank" title="Siteyi Görüntüle">
	                    <span class="icon fa fa-globe"></span>
	                </a>
	            </div>
	        </li>
	        <li class="emails">
	            <div class="control-item-header">
	                <a href="mesaj-liste.html" class="icon-toggle" title="Gelen Mesajlar">
	                    <span class="icon fa fa-envelope"></span>
	                </a>
	            </div>
	        </li>
            <li class="emails">
	            <div class="control-item-header">
	                <a href="yonetici-liste.html" class="icon-toggle" title="Yöneti Bilgileri">
	                    <span class="icon fa fa-user"></span>
	                </a>
	            </div>
	        </li>
            <li class="emails">
	            <div class="control-item-header">
	                <a href="site-ayarlar.html" class="icon-toggle" title="Site Genel Ayarlar">
	                    <span class="icon fa fa-cog"></span>
	                </a>
	            </div>
	        </li>
            <li class="emails">
	            <div class="control-item-header">
	                <a href="<?=$site?>/system/logout.html" class="icon-toggle" title="Oturumu Kapat">
	                    <span class="icon fa fa-power-off"></span>
	                </a>
	            </div>
	        </li>
	    </ul>
	</div>
<?php require_once("footer.php"); ?>
<script>
$(document).ready(function(){
$('.tooltipped').tooltip();
});
</script>