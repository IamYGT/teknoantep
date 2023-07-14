<?php
@$menu = 'genel-ayarlar'; @$page = 'banka-ayarlari';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$image = new Upload($_FILES['banklogo']);
	if ( $image->uploaded ) {
	$image->file_new_name_body = sha1(md5(date("1YmdHis")));
	$image->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$image->mime_check = true;
	$image->no_script = true;
	$image->image_convert = 'png';
	$image->Process( '../uploads/banka/' );
}

$data = [ 
		'banka_adi'			=> guvenlik($_POST['banka_adi']), 
		'banka_sb_no'		=> guvenlik($_POST['banka_sube']),  
		'banka_h_no'		=> guvenlik($_POST['banka_hesap']), 
		'banka_iban'		=> guvenlik($_POST['banka_iban']),  
		'banka_logo'		=> $image->file_dst_name,
		'banka_hesapsahibi'	=> guvenlik($_POST['banka_hesapadi'])
		];
		
$isle = $db->table('dbo_banka')->insert($data);

	if($isle){
		$bilgi = alert('success','Banka Eklendi','banka-ekle.html',3);
		}else{
		$bilgi = alert('danger','Banka Eklenemedi!','banka-ekle.html',3);
	}

}
?>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Banka Ekle</small></h3>
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
        <form id="form_validation" method="POST" action="banka-ekle.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Banka Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Banka Adı</label>
                            <input type="text" class="form-control" name="banka_adi" >
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Şube Kodu</label>
                            <input type="text" class="form-control" name="banka_sube" >
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Hesap No</label>
                            <input type="text" class="form-control" name="banka_hesap" >
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">IBAN/SWIFT/BCKEY</label>
                            <input type="text" class="form-control" name="banka_iban" >
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Hesap Sahibi Adı</label>
                            <input type="text" class="form-control" name="banka_hesapadi" >
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Banka Logo</label>
                            <input type="file" name="banklogo" size="50" class="btn btn-primary form-control"/>
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
                        <li>Banka hesap bilgilerinizi girerken lütfen kontrol ederek giriş yapınız, yanlış giriş yapmanız durumundan kullanıcılarınızın size ait olmayan hesaplara havale geçmeleri riski bulunmaktadır.</li>
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