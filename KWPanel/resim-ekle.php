<?php
@$menu = 'galeri-islemleri'; @$page = 'resim-galeri';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$image = new Upload($_FILES['resgal_resim']);
	if ( $image->uploaded ) {
	$image->file_new_name_body = seo($_POST['resgal_resim_adi']);
	$image->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$image->mime_check = true;
	$image->no_script = true;
	$image->image_watermark = '../uploads/genelresim/'.ayar('site_watermark');
	$image->Process( '../uploads/resimgaleri/'.date("Y").'/'.date("m").'' );
	if (!file_exists('../uploads/resimgaleri/'.date("Y").'/'.date("m").'/index.html')) { touch('../uploads/resimgaleri/'.date("Y").'/'.date("m").'/index.html'); }
}

$imagex = new Upload($_FILES['resgal_resim']);
	if ( $image->uploaded ) {
	$imagex->file_new_name_body = seo('thumb_'.$_POST['resgal_resim_adi']);
	$imagex->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$imagex->mime_check = true;
	$imagex->no_script = true;
	$imagex->image_resize = true;
	$imagex->image_ratio_crop = true;
	$imagex->image_y = 290;
	$imagex->image_x = 370;
	$imagex->image_watermark = '../uploads/genelresim/'.ayar('site_watermark');
	$imagex->Process( '../uploads/resimgaleri/'.date("Y").'/'.date("m").'' );
	if (!file_exists('../uploads/resimgaleri/'.date("Y").'/'.date("m").'/index.html')) { touch('../uploads/resimgaleri/'.date("Y").'/'.date("m").'/index.html'); }
}

$data = [ 
		'resgal_resim_adi'		=> guvenlik($_POST['resgal_resim_adi']), 
		'resgal_resim'			=> date("Y").'/'.date("m").'/'.$image->file_dst_name,
		'resgal_resim_thumb'	=> date("Y").'/'.date("m").'/'.$imagex->file_dst_name,
		'resgal_sira'			=> guvenlik($_POST['resgal_sira']),
		'resgal_kat_id'			=> guvenlik($_POST['resgal_kat_id'])
		];
		
$isle = $db->table('dbo_resim_galeri')->insert($data);

	if($isle){
		$bilgi = alert('success','Resim Eklendi','resim-galeri.html',3);
		}else{
		$bilgi = alert('danger','Resim Eklenemedi!','resim-galeri.html',3);
	}

}
?>
<link href="css/separate/vendor/tags_editor.min.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../js/summernote/summernote.css"/>
<link rel="stylesheet" href="../js/summernote/editor.min.css">

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Resim Ekleme</small></h3>
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
        <form id="form_validation" method="POST" action="resim-ekle.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Resim Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Resim Adı</label>
                            <input type="text" name="resgal_resim_adi" class="form-control" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Resim Kategori</label>
                            <select name="resgal_kat_id" class="form-control">
                            	<?php
                                $bkat = $db->table('dbo_resim_galeri_kat')
										   ->getall();
								foreach($bkat as $bkatget){
								?>
                                <option value="<?=$bkatget->ResGalKatID?>"><?=$bkatget->rgal_kat_adi?></option>
                                <?php } ?>
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Resim</label>
                            <input type="file" name="resgal_resim" size="50" class="form-control btn btn-primary"/>
                        </fieldset>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-6">
                <section class="card">
                	<header class="card-header">
                        Diğer Bilgiler
                    </header>
                    <div class="card-block">
                        <div class="row">
                        	<div class="col-md-12" style="margin-bottom:15px;">
                                <li style="list-style:none; text-align:center; border:1px solid #C30003; padding:15px;">Büyük boyutlu resimler yüklerken hata alıyor ya da kayıt işlemini yapamıyorsanız hosting firmanız ile görüşerek lütfen <b>post_max_file_size</b> değerini yükseltmelerini ve yükleme esnasında hata verebilecek <b>time_out</b> değerini arttırmasını isteyiniz.</li>
                        	</div>
                            <div class="col-md-3">
                                <fieldset class="form-group">
                                    <label class="form-label">Resim Sıra</label>
                                    <input type="number" name="resgal_sira" class="form-control" required>
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
<script src="js/jquery.validate.js"></script>
<script src="js/form-validation.js"></script>
<script type='text/javascript' src="js/lib/jquery-tag-editor/jquery.tag-editor.min.js"></script>
<script>
	$(function() {
		$('#tags-editor-textarea').tagEditor();
	});
</script>