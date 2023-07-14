<?php
@$menu = 'genel-ayarlar'; @$page = 'sosyal-ayarlar';
require_once("header.php");
require_once("menu-left.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_sosyalmedya')->select('*')->where('SosID','=',1)->getRow();
if(!$oku){
	yonver('panelim.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'facebook'	=> guvenlik($_POST['facebook']), 
		'twitter'	=> guvenlik($_POST['twitter']),  
		'googleplus'=> guvenlik($_POST['googleplus']),
		'pinterest'	=> guvenlik($_POST['pinterest']),
		'linkedin'	=> guvenlik($_POST['linkedin']),
		'instagram'	=> guvenlik($_POST['instagram']),
		'youtube'	=> guvenlik($_POST['youtube'])
		];
		
$isle = $db->table('dbo_sosyalmedya')->where('SosID','=',1)->update($data);

	if($isle){
		$bilgi = alert('success','Sosyal Medya Ayarları Düzenlendi','sosyal-ayarlar.html',3);
		}else{
		$bilgi = alert('danger','Sosyal Medya Ayarları Düzenlenemedi!','sosyal-ayarlar.html',3);
	}

}
?>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Sosyal Medya Ayarları</small></h3>
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
        <form id="form_validation" method="POST" action="sosyal-ayarlar.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Sms Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control"value="<?=sosyal('facebook')?>" placeholder="Facebook Sayfanız">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Twitter</label>
                            <input type="text" name="twitter" class="form-control"value="<?=sosyal('twitter')?>" placeholder="Twitter Sayfanız">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Google+</label>
                            <input type="text" name="googleplus" class="form-control"value="<?=sosyal('googleplus')?>" placeholder="Google+ Sayfanız">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Pinterest</label>
                            <input type="text" name="pinterest" class="form-control"value="<?=sosyal('pinterest')?>" placeholder="Pinterest Sayfanız">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">LinkedIN</label>
                            <input type="text" name="linkedin" class="form-control"value="<?=sosyal('linkedin')?>" placeholder="LinkedIN Sayfanız">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control"value="<?=sosyal('instagram')?>" placeholder="Instagram Sayfanız">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Youtube</label>
                            <input type="text" name="youtube" class="form-control"value="<?=sosyal('youtube')?>" placeholder="Youtube Sayfanız">
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
                        <li style="padding-bottom:10px;">Boş bıraktığınız alanlar, site üzerinde görüntülenmez.</li>
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