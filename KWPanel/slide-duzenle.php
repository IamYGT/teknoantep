<?php
@$menu = 'slide-islemleri'; @$page = 'slide-ekle';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_slide')->where('SlideID','=',$duzenid)->getRow();
if(!$oku){
	yonver('slide-liste.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$image = new Upload($_FILES['slideresim']);
	if ( $image->uploaded ) {
	$image->file_new_name_body = sha1(md5(date("1YmdHis")));
	$image->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$image->mime_check = true;
	$image->no_script = true;
	$image->image_convert = 'png';
	$image->Process( '../uploads/slider/'.date("Y").'/'.date("m").'' );
	
	if (!file_exists('../uploads/slider/'.date("Y").'/'.date("m").'/index.html')) { touch('../uploads/slider/'.date("Y").'/'.date("m").'/index.html'); }
}

$data = [
		'slide_yazi_a'		=> $_POST['slide_yazi_a'],
		'slide_yazi_b'		=> $_POST['slide_yazi_b'],
		'slide_renk_a'		=> $_POST['slide_renk_a'],
		'slide_renk_b'		=> $_POST['slide_renk_b'],
		'slide_buton'		=> $_POST['slide_buton'],
		'slide_buton_renk'	=> $_POST['slide_buton_renk'],
		'slide_buton_url'	=> $_POST['slide_buton_url'],
		'slide_sira'		=> $_POST['slide_sira']
		];
	
$isle = $db->table('dbo_slide')->where('SlideID','=',$duzenid)->update($data);

	if(!empty($image->file_dst_name) && !empty($_FILES['slideresim'])){
		$resup = [ 'slide_resim' => date("Y").'/'.date("m").'/'.$image->file_dst_name ];
		$logo = $db->table('dbo_slide')->where('SlideID','=',$oku->SlideID)->update($resup);
	}

	if($isle || $logo){
		$bilgi = alert('success','Slide Düzenlendi','slide-liste.html',3);
		}else{
		$bilgi = alert('danger','Slide Düzenlenemedi!','slide-liste.html',3);
	}

	}
?>
<link href="css/colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Slide İşlemi</small></h3>
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
        <form id="form_validation" method="POST" action="slide-duzenle.html?id=<?=$oku->SlideID?>" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Slide Bilgileri
                    </header>
                    <div class="card-block">
                    	<div class="row">
                        <div class="col-md-12">
                        <fieldset class="form-group">
                        	<label class="form-label">Resim (1920x600)</label>
                            <input type="file" name="slideresim" size="50" class="form-control btn btn-primary"/>
                        </fieldset>
                        </div>
                        <div class="col-md-9">
                        <fieldset class="form-group">
                            <label class="form-label">Yazı 1</label>
                            <input name="slide_yazi_a" type="text" value="<?=$oku->slide_yazi_a?>" class="form-control" required>
                        </fieldset>
                        </div>
                        <div class="col-md-3">
                        <fieldset class="form-group">
                            <label class="form-label">Renk</label>
                            <input name="slide_renk_a" type="text" value="<?=$oku->slide_renk_a?>" value="#ffffff" class="form-control colored" required>
                        </fieldset>
                        </div>
                        <div class="col-md-9">
                        <fieldset class="form-group">
                            <label class="form-label">Yazı 2</label>
                            <input name="slide_yazi_b" type="text" value="<?=$oku->slide_yazi_b?>" class="form-control" required>
                        </fieldset>
                        </div>
                        <div class="col-md-3 colored2">
                        <fieldset class="form-group">
                            <label class="form-label">Renk</label>
                            <input name="slide_renk_b" type="text" value="<?=$oku->slide_renk_b?>" value="#ffffff" class="form-control colored" required>
                        </fieldset>
                        </div>
                        <div class="col-md-6 colored2">
                        <fieldset class="form-group">
                            <label class="form-label">Buton Yazı</label>
                            <input name="slide_buton" type="text" value="<?=$oku->slide_buton?>" class="form-control" required>
                        </fieldset>
                        </div>
                        <div class="col-md-3 colored2">
                        <fieldset class="form-group">
                            <label class="form-label">Buton URL</label>
                            <input name="slide_buton_url" type="text" value="<?=$oku->slide_buton_url?>" class="form-control" required>
                        </fieldset>
                        </div>
                        <div class="col-md-3 colored2">
                        <fieldset class="form-group">
                            <label class="form-label">Buton Renk</label>
                            <input name="slide_buton_renk" type="text" value="<?=$oku->slide_buton_renk?>" value="#ffffff" class="form-control colored" required>
                        </fieldset>
                        </div>
                        <div class="col-md-2">
                        <fieldset class="form-group">
                            <label class="form-label">Sıra</label>
                            <input name="slide_sira" type="text" value="<?=$oku->slide_sira?>" class="form-control" required>
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
                        <li>Yüklediğiniz resimlerin kayıt edilmemesi durumunda ya da boş kayıt edilmesi durumunda lütfen yüklenen resmin boyutlarını kontrol ediniz, büyük boyutlu resimler hosting ayarlarınız sebebi ile yüklenmeyebilir bu durumda hosting firmanızdan <b>upload_max_filesize</b>,<b>post_max_size</b>,<b>max_input_vars</b> değerinizi yükseltmesini talep ediniz.</li>
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
<script src="css/colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script>
  $(document).ready(function() {
	$('.colored').colorpicker();
  });
</script>
<script src="js/jquery.validate.js"></script>
<script src="js/form-validation.js"></script>
