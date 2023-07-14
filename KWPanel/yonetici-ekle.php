<?php
@$page = 'yonetici-ayarlar';
require_once("header.php");
require_once("menu-left.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'kullaniciadi'	=> guvenlik($_POST['kullaniciadi']), 
		'sifresi'		=> sha1(sha1(sha1($_POST['sifresi']))),  
		'adsoyadi'		=> guvenlik($_POST['adsoyadi'])
		];
		
$isle = $db->table('dbo_yonetici')->insert($data);

	if($isle){
		$bilgi = alert('success','Yönetici Eklendi','yonetici-ekle.html',3);
		}else{
		$bilgi = alert('danger','Yönetici Eklenemedi!','yonetici-ekle.html',3);
	}

}
?>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Yönetici Ekle</small></h3>
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
        <form id="form_validation" method="POST" action="yonetici-ekle.html">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Yönetici Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Yönetici E-Mail</label>
                            <input type="email" class="form-control" name="kullaniciadi" >
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Yönetici Şifresi</label>
                            <input type="password" class="form-control" name="sifresi" >
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Yönetici Adı & Soyadı</label>
                            <input type="text" class="form-control" name="adsoyadi" >
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
                        <li>Şifre bölümüne giriş yaparken lütfen Türkçe karakter ve boşluk kullanmayın!</li>
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