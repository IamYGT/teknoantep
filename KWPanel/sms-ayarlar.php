<?php
@$menu = 'genel-ayarlar'; @$page = 'sms-ayarlar';
require_once("header.php");
require_once("menu-left.php");

$duzenid = intval($_GET["id"]);
$smsayar = $db->table('dbo_siteayar')->select('sms_kadi,sms_sifre,sms_baslik,sms_durumu,sms_bildirim_tel')->where('SiteID','=',1)->getRow();
if(!$smsayar){
	yonver('panelim.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'sms_kadi'			=> guvenlik($_POST['sms_kadi']), 
		'sms_sifre'			=> $_POST['sms_sifre'],  
		'sms_baslik'		=> guvenlik($_POST['sms_baslik']),
		'sms_durumu'		=> guvenlik($_POST['sms_durumu']),
		'sms_bildirim_tel'	=> guvenlik($_POST['sms_bildirim_tel'])
		];
		
$isle = $db->table('dbo_siteayar')->where('SiteID','=',1)->update($data);

	if($isle){
		$bilgi = alert('success','Sms Ayarları Düzenlendi','sms-ayarlar.html',3);
		}else{
		$bilgi = alert('danger','Sms Ayarları Düzenlenemedi!','sms-ayarlar.html',3);
	}

}
?>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Sms Ayarları</small></h3>
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
        <form id="form_validation" method="POST" action="sms-ayarlar.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Sms Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Sms Kullanıcı Adınız</label>
                            <input type="text" name="sms_kadi" class="form-control"value="<?=$smsayar->sms_kadi?>" placeholder="İleti Merkezi K.Adınız">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Sms Şifreniz</label>
                            <input type="password" name="sms_sifre" class="form-control" value="<?=$smsayar->sms_sifre?>" placeholder="İleti Merkezi Şifreniz">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Sms Başlığınız</label>
                            <input type="text" name="sms_baslik" class="form-control" value="<?=$smsayar->sms_baslik?>" placeholder="İleti Merkezi sms Başlığınız">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Sms Bildirim Numarası</label>
                            <input type="text" name="sms_bildirim_tel" class="form-control" value="<?=$smsayar->sms_bildirim_tel?>" placeholder="Sms Bildirim Numarası">
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Hizmet Durumu</label>
                            <select class="form-control" name="sms_durumu" required>
                            <option value="">Durum Seçiniz</option>
                            <option value="Aktif"<?php if($smsayar->sms_durumu == 'Aktif'){echo"selected";}?>>Aktif (Kullanılabilir)</option>
                            <option value="Pasif"<?php if($smsayar->sms_durumu == 'Pasif'){echo"selected";}?>>Pasif (Kullanılamaz)</option>
                            </select>
                        </fieldset>
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
                        <li style="padding-bottom:10px;">Sms alanlarının tümümü doldurduğunuz anda SMS sisteminiz otomatik olarak devreye girecektir.</li>
                        <li style="padding-bottom:10px;">Sms sistemi kullanmak istemiyorsanız lütfen sms hizmet durumunu pasif hale getiriniz.</li>
                        <li style="padding-bottom:10px;">Sms bakiyeniz yoksa ya da üyeliğiniz yoksa sitenin hiç bir alanında sms bildirimlerini aktif hale getirmeyin!</li>
                        <li style="padding-bottom:10px;">Henüz iletimerkezi üyeliğiniz yoksa <a href="https://www.iletimerkezi.com/davet/?ref=ILTMRKZI86259" style="font-weight:bold; color:#DD0003;" target="_blank">BURAYA</a> tıklayarak üye olabilirsiniz. İlk yapacağınız sms paketi alımınıza iletimerkezi tarafından +1000 sms hediye edilecektir.</li>
                        <li style="padding-bottom:10px;">Sms sistemi yalnızca <b>iletimerkezi</b> ile çalışmaktadır <b>farklı hiç bir sms sağlayıcı hizmeti entegre etmemekteyiz.</b></li>
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
<script src="js/jquery.validate.js"></script>
<script src="js/form-validation.js"></script>