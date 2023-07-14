<?php
@$menu = 'genel-ayarlar'; @$page = 'mail-ayarlar';
require_once("header.php");
require_once("menu-left.php");

$duzenid = intval($_GET["id"]);
$mailayar = $db->table('dbo_mailayar')->select('*')->where('MayarID','=',1)->getRow();
if(!$mailayar){
	yonver('panelim.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'mail_host'		=> guvenlik($_POST['mail_host']), 
		'mail_kadi'		=> guvenlik($_POST['mail_kadi']),  
		'mail_sifre'	=> guvenlik($_POST['mail_sifre']),
		'mail_port'		=> guvenlik($_POST['mail_port']), 
		'mail_prosedur'	=> guvenlik($_POST['mail_prosedur']),  
		'mail_tipi'		=> guvenlik($_POST['mail_tipi'])
		];
		
$isle = $db->table('dbo_mailayar')->where('MayarID','=',1)->update($data);

	if($isle){
		$bilgi = alert('success','Mail Ayarları Düzenlendi','mail-ayarlar.html',3);
		}else{
		$bilgi = alert('danger','Mail Ayarları Düzenlenemedi!','mail-ayarlar.html',3);
	}

}
?>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Mail Sunucu Ayarları</small></h3>
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
        <form id="form_validation" method="POST" action="mail-ayarlar.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Sunucu Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Mail Sunucu Adı (Host)</label>
                            <input type="text" name="mail_host" class="form-control"value="<?=$mailayar->mail_host?>" placeholder="mail.siteadresi.com" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Kullanıcı Adı</label>
                            <input type="text" name="mail_kadi" class="form-control" value="<?=$mailayar->mail_kadi?>" placeholder="info@siteadresi.com" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Şifreniz</label>
                            <input type="password" name="mail_sifre" class="form-control" value="<?=$mailayar->mail_sifre?>" required>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">SSL / TLS Seçimi</label>
                            <select class="form-control" name="mail_prosedur" required>
                            <option value="">Durum Seçiniz</option>
                            <option value="standart"<?php if($mailayar->mail_prosedur == 'standart'){echo"selected";}?>>Standart Gönderim</option>
                            <option value="ssl"<?php if($mailayar->mail_prosedur == 'ssl'){echo"selected";}?>>SSL Gönderim</option>
                            <option value="tls"<?php if($mailayar->mail_prosedur == 'tls'){echo"selected";}?>>TLS Gönderim</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Gönderim Tipi</label>
                            <select class="form-control" name="mail_tipi" required>
                            <option value="">Durum Seçiniz</option>
                            <option value="Y"<?php if($mailayar->mail_tipi == 'Y'){echo"selected";}?>>Yeni Tip</option>
                            <option value="E"<?php if($mailayar->mail_tipi == 'E'){echo"selected";}?>>Eski Tip</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group col-md-3" style="padding-left:0px;">
                            <label class="form-label">Port Numarası</label>
                            <input type="text" name="mail_port" value="<?=$mailayar->mail_port?>" class="form-control" required>
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
                        <li style="padding-bottom:10px;">Mail sunucu ayarlarınızı girerken lütfen tüm alanların doğruluğundan emin olup test işlemi gerçekleştirmeden sitenizi aktif duruma getirmeyin, üyelik doğrulama sistemi mail üzerinden yapıldığı için sorun yaşamak istemiyorsanız lütfen, mail sisteminizin çalıştığınızdan emin olunuz.</li>
                        <li style="padding-bottom:10px;">Kullanacağınız mail adresi için lütfen spam koruma sistemini devreye sokunuz, bazı alanlarda kullanacağınız adres görüntülenecektir, spammer botlarına yakalanmamak için barındırma alanı CPANEL üzerinden "BoxTrapper" yada "SpamAssault" ayarlarınızı kontrol ederek devreye alınız.</li>
                        <li style="font-weight:bold;">Tüm ayarları yapmanıza rağmen mail gönderimi sağlayamıyorsanız <span style="color:#B80003;">Gönderim Tipi</span> seçeneğini Eski ya da Yeni seçerek tekrar deneyin, bazı hosting firmaları mail gönderimi esnasında kullanılan dosya tiplerini seçmektedir bu sebepten eski tip ya da yeni tip arasında seçim yapabilirsiniz.</li>
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