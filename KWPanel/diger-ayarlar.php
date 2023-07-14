<?php
@$menu = 'genel-ayarlar'; @$page = 'diger-ayarlar';
require_once("header.php");
require_once("menu-left.php");

$duzenid = intval($_GET["id"]);
$ayar = $db->table('dbo_siteayar')->select('SiteID,destek_kod,google_analyics,site_durum,google_adsense,googlemap_coords,goog_sitekey,google_secret,one_signal,cdn_sistemi,google_site_verification,yandex_site_verification,googlemap_key')->where('SiteID','=',1)->getRow();
if(!$ayar){
	yonver('panelim.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'destek_kod'				=> $_POST['destek_kod'],
		'google_analyics'			=> $_POST['google_analyics'],
		'googlemap_key'				=> guvenlik($_POST['googlemap_key']),
		'site_durum'				=> guvenlik($_POST['site_durum']),
		'google_adsense'			=> $_POST['google_adsense'],
		'goog_sitekey'				=> guvenlik($_POST['goog_sitekey']),
		'google_secret'				=> guvenlik($_POST['google_secret']),
		'cdn_sistemi'				=> guvenlik($_POST['cdn_sistemi']),
		'googlemap_coords'			=> guvenlik($_POST['googlemap_coords']),
		'one_signal'				=> $_POST['one_signal'],
		'google_site_verification'	=> $_POST['google_sdogrula'],
		'yandex_site_verification'	=> $_POST['yandex_sdogrula']
		];
		
$isle = $db->table('dbo_siteayar')->where('SiteID','=',1)->update($data);

	if($isle){
		$bilgi = alert('success','Ayarlar Düzenlendi','diger-ayarlar.html',3);
		}else{
		$bilgi = alert('danger','Ayarlar Düzenlenemedi!','diger-ayarlar.html',3);
	}

}
?>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Yapısal Ayarlar</small></h3>
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
        <form id="form_validation" method="POST" action="diger-ayarlar.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Bilgiler
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                        	<label class="form-label">Google Harita Koordinatları</label>
                            <input type="text" name="googlemap_coords" class="form-control" value="<?=$ayar->googlemap_coords?>">
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Site Bakım Modu</label>
                            <select class="form-control" name="site_durum" required>
                            <option value="">Durum Seçiniz</option>
                            <option value="Acik"<?php if($ayar->site_durum == 'Acik'){echo"selected";}?>>Site Açık</option>
                			<option value="Kapali"<?php if($ayar->site_durum == 'Kapali'){echo"selected";}?>>Site Kapalı</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Destek Kod (Zopim,Tawkto)</label>
                            <textarea class="form-control" name="destek_kod" rows="5" placeholder="Kod'unuzu bu alana yapıştırın."><?=$ayar->destek_kod?></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Google Analytics</label>
                            <textarea class="form-control" name="google_analyics" rows="5" placeholder="Analytics kod'unuzu bu alana yapıştırın."><?=$ayar->google_analyics?></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Google Adsense</label>
                            <textarea class="form-control" name="google_adsense" rows="5" placeholder="Adsense kod'unuzu bu alana yapıştırın."><?=$ayar->google_adsense?></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">One Signal (Web Push Bildirim Kod)</label>
                            <textarea class="form-control" name="one_signal" rows="5" placeholder="One Signal kod'unuzu bu alana yapıştırın."><?=$ayar->one_signal?></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Google Harita Anahtarı</label>
                            <input class="form-control" name="googlemap_key" value="<?=$ayar->googlemap_key?>" rows="5" placeholder="Google harita kod'unuzu bu alana yapıştırın.">
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Google Recaptcha (Site Key)</label>
                            <input type="text" name="goog_sitekey" class="form-control" value="<?=$ayar->goog_sitekey?>">
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Google Recaptcha (Secret Key)</label>
                            <input type="text" name="google_secret" class="form-control" value="<?=$ayar->google_secret?>">
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">CDN Hizmeti</label>
                            <input type="text" name="cdn_sistemi" class="form-control" value="<?=$ayar->cdn_sistemi?>">
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Google Site Doğrulama</label>
                            <input type="text" name="google_sdogrula" class="form-control" value="<?=$ayar->google_site_verification?>">
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                        	<label class="form-label">Yandex Site Doğrulama</label>
                            <input type="text" name="yandex_sdogrula" class="form-control" value="<?=$ayar->yandex_site_verification?>">
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
                        <li style="padding-bottom:10px;"><b>Google Harita Koordinatları</b>: google harita koordinatları, firmanızın konumunu ilgili alana kayıt ediniz. <a href="https://www.gps-coordinates.net/" target="_blank" style="color:#DD0003; font-weight:bold;">BURADAN</a> Lat,Long kısmındaki koordinatlarınızı alabilirsiniz.</li>
                        <li style="padding-bottom:10px;"><b>Site Bakım Modu</b>: sitenizi tamamen açık tutabilir ya da kapatabilirsiniz.</li>
                        <li style="padding-bottom:10px;"><b>Destek Kod</b>: sitenize canlı destek eklemek istiyorsanız zopim ya da tawkto sitelerine üye olarak alacağınız kodu ilgili alana yapıştırabilirsiniz, canlı destek hizmetiniz kaydın tamamlanması ardından aktif hale gelecektir.</li>
                        <li style="padding-bottom:10px;"><b>Google Analytics</b>: google analytics hizmetini aktif hale getirmek için, analytics'ten aldığınız kodu ilgili alana yapıştırınız, verileriniz 24 saat içerisinde yansımaya başlayacaktır.</li>
                        <li style="padding-bottom:10px;"><b>Google Adsense</b>: google adsense hizmetini aktif hale getirmek için, adsense'den aldığınız kodu ilgili alana yapıştırınız, verileriniz reklam onayınız alındıysa ilgili eklediğiniz reklam alanlarında reklamlar görüntülenecektir, reklamlarınız görünmüyorsa adsense kontrolünüz henüz tamamlanmamış ya da reklam engelleyici kullanımınızdan ötürüdür.</li>
                        <li style="padding-bottom:10px;"><b>One Signal (Web Push)</b>: tarayıcı üzerinden web push mesajları göndermenizi sağlar <a href="https://onesignal.com/" rel="nofollow" style="font-weight:bold; color:#DD0003;">BURAYA</a> tıklayarak üye olun, Add New App diyerek yeni bir element ekleyerek isim verin, açılan pencereden <b>Web Push</b> seçin, sağ üst alandan <b>Custom Code</b> seçerek gerekli alanları doldurduktan sonra aldığınız kodu ilgili alana yapıştırarak kayıt yapın.</li>
                        <li style="padding-bottom:10px;"><b>Google Harita Anahtarı</b>: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank" rel="nofollow" style="color:#DD0003; font-weight:bold;">BURADAN</a> GET KEY tuşuna basarak yönergelere göre web site adresiniz ile harita api anahtarı alarak ilgili alana giriniz.</li>
                        <li style="padding-bottom:10px;"><b>Google Recaptcha (Site Key)</b>: bazı formlarda doğrulama gerekmektedir, kullanabilmek için <a href="https://www.google.com/recaptcha" style="font-weight:bold; color:#DD0003;" target="_blank">BURAYA</a> tıklayarak sitenizi recaptcha'ya kaydederek Site Key bölümünü bu alana yapıştırın.</li>
                        <li style="padding-bottom:10px;"><b>Google Recaptcha (Secret Key)</b>: bazı formlarda doğrulama gerekmektedir, kullanabilmek için <a href="https://www.google.com/recaptcha" style="font-weight:bold; color:#DD0003;" target="_blank">BURAYA</a> tıklayarak sitenizi recaptcha'ya kaydederek Secret Key bölümünü bu alana yapıştırın.</li>
                        <li style="padding-bottom:10px;"><b>CDN Hizmeti</b>: cdn hizmeti sabit dosyalarınızın uluslar arası sunucular üzerinden geçerek daha hızlı yüklenmesini sağlar, bu hizmet için https://www.cdnhizmeti.com kullanabilirsiniz, aldığınız cdn url bağlantısını ilgili alana yapıştırınız.</li>
                        <li style="padding-bottom:10px;"><b>Google Site Doğrulama</b>: web sitenizi web master tools'a eklemek için gerekli doğrulama kodunu bu alana girmeniz gerekmektedir.</li>
                        <li style="padding-bottom:10px;"><b>Yandex Site Doğrulama</b>: web sitenizi yandex tools'a eklemek için gerekli doğrulama kodunu bu alana girmeniz gerekmektedir.</li>
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