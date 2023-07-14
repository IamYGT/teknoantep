<?php
@$menu = 'genel-ayarlar'; @$page = 'site-ayarlar';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");

$duzenid = intval($_GET["id"]);
$ayar = $db->table('dbo_siteayar')->select('*')->where('SiteID','=',1)->getRow();
if(!$ayar){
	yonver('panelim.html');
	exit();
}
/*************************************************************************************/
$log = new Upload($_FILES['site_logo']);
	if ( $log->uploaded ) {
	$log->file_new_name_body = sha1(md5(date("1YmdHis")));
	$log->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$log->mime_check = true;
	$log->no_script = true;
	/*$log->image_resize = true;
	$log->image_ratio_fill = true;
	$log->image_y = 70;
	$log->image_x = 280;*/
	$log->Process( '../uploads/genelresim/' );
}
/*************************************************************************************/
$foo = new Upload($_FILES['site_logo_footer']);
	if ( $foo->uploaded ) {
	$foo->file_new_name_body = sha1(md5(date("1YmdHis")));
	$foo->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$log->mime_check = true;
	$log->no_script = true;
	/*$log->image_resize = true;
	$log->image_ratio_fill = true;
	$log->image_y = 41;
	$log->image_x = 178;*/
	$foo->Process( '../uploads/genelresim/' );
}
/*************************************************************************************/
$fav = new Upload($_FILES['site_logo_favicon']);
	if ( $fav->uploaded ) {
	$fav->file_new_name_body = 'favicon';
	$fav->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/ico');
	$fav->mime_check = true;
	$fav->no_script = true;
	$fav->image_resize = true;
	$fav->image_ratio_fill = true;
	$fav->image_y = 16;
	$fav->image_x = 16;
	$fav->image_convert = 'png';
	$fav->Process( '../uploads/genelresim/' );
}
/*************************************************************************************/
$sav = new Upload($_FILES['site_watermark']);
	if ( $sav->uploaded ) {
	$sav->file_new_name_body = 'watermark';
	$sav->allowed = array('image/jpeg','image/jpg','image/gif','image/png','image/ico');
	$sav->mime_check = true;
	$sav->no_script = true;
	$sav->image_convert = 'png';
	$sav->Process( '../uploads/genelresim/' );
}
/*************************************************************************************/

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'site_baslik'		=> guvenlik($_POST['site_baslik']), 
		'site_http'			=> guvenlik($_POST['site_http']),  
		'site_www'			=> guvenlik($_POST['site_www']),
		'site_telefon'		=> guvenlik($_POST['site_telefon']),
		'site_gsm'			=> guvenlik($_POST['site_gsm']),
		'site_fax'			=> guvenlik($_POST['site_fax']),
		'site_adres'		=> guvenlik($_POST['site_adres']),
		'site_mail'			=> guvenlik($_POST['site_mail']),
		'site_footer'		=> guvenlik($_POST['site_footer']),
		'site_aciklama'		=> guvenlik($_POST['site_aciklama']),
		'site_meta'			=> guvenlik($_POST['site_meta']),
		'calisma_saat'		=> guvenlik($_POST['calisma_saat'])
		];
		

/*************************************************************************************/
if(!empty($log->file_dst_name) && !empty($_FILES['site_logo'])){
	$resup = [ 'site_logo' => $log->file_dst_name ];
	$log = $db->table('dbo_siteayar')->where('SiteID','=',$ayar->SiteID)->update($resup);
}
/*************************************************************************************/
if(!empty($foo->file_dst_name) && !empty($_FILES['site_logo_footer'])){
	$resup = [ 'site_logo_footer' => $foo->file_dst_name ];
	$foo = $db->table('dbo_siteayar')->where('SiteID','=',$ayar->SiteID)->update($resup);
}
/*************************************************************************************/
if(!empty($fav->file_dst_name) && !empty($_FILES['site_logo_favicon'])){
	$resup = [ 'site_logo_favicon' => $fav->file_dst_name ];
	$fav = $db->table('dbo_siteayar')->where('SiteID','=',$ayar->SiteID)->update($resup);
}
/*************************************************************************************/
if(!empty($sav->file_dst_name) && !empty($_FILES['site_watermark'])){
	$resup = [ 'site_watermark' => $sav->file_dst_name ];
	$sav = $db->table('dbo_siteayar')->where('SiteID','=',$ayar->SiteID)->update($resup);
}
/*************************************************************************************/

$isle = $db->table('dbo_siteayar')->where('SiteID','=',1)->update($data);

	if($isle || $log || $foo || $fav){
		$bilgi = alert('success','Site Ayarları Düzenlendi','site-ayarlar.html',3);
		}else{
		$bilgi = alert('danger','Site Ayarları Düzenlenemedi!','site-ayarlar.html',3);
	}

}
?>
<link href="css/separate/vendor/tags_editor.min.css" rel='stylesheet' type='text/css'>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Site Genel Ayarları</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action" style="display:none;">
							<a href="#" class="btn btn-rounded">Add member</a>
						</div>
					</div>
				</div>
			</div>
		</header><!--.page-content-header-->

		<div class="container-fluid">
        <?=@$bilgi?>
        <form id="form_validation" method="POST" action="site-ayarlar.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Site Genel Bilgileri
                    </header>
                    <div class="card-block">
                    	<div class="row">
                        	<div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Başlık (Title)</label>
                                    <input type="text" name="site_baslik" class="form-control" value="<?=$ayar->site_baslik?>" required>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label class="form-label">SSL Durumu</label>
                                    <select class="form-control" name="site_http" required>
                                    	<option value="http://"<?php if($ayar->site_http == 'http://'){echo"selected";}?>>Yok</option>
                                        <option value="https://"<?php if($ayar->site_http == 'https://'){echo"selected";}?>>Var</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label class="form-label">Bağantı Tipi (www Eki.)</label>
                                    <select class="form-control" name="site_www">
                                    	<option value="www."<?php if($ayar->site_www == 'www.'){echo"selected";}?>>Var</option>
                                        <option value=""<?php if($ayar->site_www == ''){echo"selected";}?>>Yok</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Sabit Telefon (Site)</label>
                                    <input type="text" name="site_telefon" class="form-control" value="<?=$ayar->site_telefon?>" required>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Gsm Numarası (Site)</label>
                                    <input type="text" name="site_gsm" class="form-control" value="<?=$ayar->site_gsm?>" required>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Fax Numarası (Site)</label>
                                    <input type="text" name="site_fax" class="form-control" value="<?=$ayar->site_fax?>" required>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Firma Adresi (Description)</label>
                                    <textarea name="site_adres" class="form-control"><?=$ayar->site_adres?></textarea>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Mail Adresi (Site)</label>
                                    <input type="email" name="site_mail" class="form-control" value="<?=$ayar->site_mail?>" required>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Footer Alan Yazısı</label>
                                    <input type="text" name="site_footer" class="form-control" value="<?=$ayar->site_footer?>" required>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Çalışma Saatleri</label>
                                    <input type="text" name="calisma_saat" class="form-control" value="<?=$ayar->calisma_saat?>" required>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-6">
                <section class="card">
                	<header class="card-header">
                        Bilgilendirme
                    </header>
                    <div class="card-block">
                        <div class="row">
                        	<div class="col-md-6">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Logo (163x41)</label>
                                    <input type="file" name="site_logo" size="50" class="form-control btn btn-primary"/>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Footer Logo (163x41)</label>
                                    <input type="file" name="site_logo_footer" size="50" class="form-control btn btn-primary"/>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Favicon</label>
                                    <input type="file" name="site_logo_favicon" size="50" class="form-control btn btn-primary"/>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Watermark</label>
                                    <input type="file" name="site_watermark" size="50" class="form-control btn btn-primary"/>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Kısa Açıklama (Description)</label>
                                    <textarea name="site_aciklama" class="form-control"><?=$ayar->site_aciklama?></textarea>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Anahtar Kelime (Keywords)</label>
                                    <textarea id="tags-editor-textarea" type="text" name="site_meta" class="form-control" required><?=$ayar->site_meta?></textarea>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Yüklü Logolar
                    </header>
                    <div class="card-block">
                        <div class="row">
                        	<div class="col-md-3">
                                <fieldset class="form-group">
                                    <label class="form-label">Site Logo</label>
                                    <img src='../thumb.php?src=./uploads/genelresim/<?=$ayar->site_logo?>&size=100X100&crop=0' class="img-thumbnail" />
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                            	<fieldset class="form-group">
                                    <label class="form-label">Site Footer Logo</label>
                                    <img src='../thumb.php?src=./uploads/genelresim/<?=$ayar->site_logo_footer?>&size=100X100&crop=0' class="img-thumbnail" />
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                            	<fieldset class="form-group">
                                    <label class="form-label">Site Favicon</label>
                                    <img src='../thumb.php?src=./uploads/genelresim/<?=$ayar->site_logo_favicon?>&size=100X100&crop=0' class="img-thumbnail" />
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                            	<fieldset class="form-group">
                                    <label class="form-label">Site Watermark</label>
                                    <img src='../thumb.php?src=./uploads/genelresim/<?=$ayar->site_watermark?>&size=100X100&crop=0' class="img-thumbnail" />
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                    <div class="card-block">
                        <fieldset class="form-group" style="margin-bottom:0px;">
                            <button type="submit" name="kaydet" class="btn">Bilgileri Kaydet</button>
                        </fieldset>
                    </div>
                </section>
            </div>
            </form>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
<?php require_once("footer.php"); ?>
<script type='text/javascript' src="js/jquery.validate.js"></script>
<script type='text/javascript' src="js/form-validation.js"></script>
<script type='text/javascript' src="js/jquery.price_format.2.0.js"></script>
<script type='text/javascript' src="js/lib/jquery-tag-editor/jquery.tag-editor.min.js"></script>
<script type="text/javascript">
	$(function() {
		$('#tags-editor-textarea').tagEditor();
	});
</script>
<script>
$('#islemtutar1').priceFormat({
	prefix: '',
	suffix: 'TL'
});
$('#islemtutar2').priceFormat({
	prefix: '',
	suffix: 'TL'
});
</script>