<?php
@$menu = 'referans-islemleri'; @$page = 'referans-ekle';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$image = new Upload($_FILES['ref_logo']);
	if ( $image->uploaded ) {
	$image->file_new_name_body = seo($_POST['ref_adi']);
	$image->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$image->mime_check = true;
	$image->no_script = true;
	$image->image_resize = true;
	$image->image_ratio_crop = true;
	$image->image_y = 95;
	$image->image_x = 205;
	$image->Process( '../uploads/referans/'.date("Y").'/'.date("m").'' );
	if (!file_exists('../uploads/referans/'.date("Y").'/'.date("m").'/index.html')) { touch('../uploads/referans/'.date("Y").'/'.date("m").'/index.html'); }
}

$data = [ 
		'ref_adi'	=> guvenlik($_POST['ref_adi']), 
		'ref_logo'	=> date("Y").'/'.date("m").'/'.$image->file_dst_name,
		'ref_tarih'	=> $tarih
		];
		
$isle = $db->table('dbo_referans')->insert($data);

	if($isle){
		$bilgi = alert('success','Referans Eklendi','referans-ekle.html',3);
		}else{
		$bilgi = alert('danger','Referans Eklenemedi!','referans-ekle.html',3);
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
							<h3><small class="text-muted">Referans Ekleme</small></h3>
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
        <form id="form_validation" method="POST" action="referans-ekle.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Referans Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Referans Adı</label>
                            <input type="text" name="ref_adi" class="form-control" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Referans Logo</label>
                            <input type="file" name="ref_logo" size="50" class="form-control btn btn-primary"/>
                        </fieldset>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Bilgiler
                    </header>
                    <div class="card-block">
                        <li>Ekleyeceğiniz logo png formatında ve arkaplan'ı transparan olmalıdır, diğer türlü yüklenen resimler sitenizde kalitesiz bir görüntüye sebep olabilir.</li>
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