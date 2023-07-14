<?php
@$menu = 'ana-sayfa'; @$page = 'hizmet-liste';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$image = new Upload($_FILES['hizmet_resim']);
	if ( $image->uploaded ) {
	$image->file_new_name_body = seo($_POST['hizmet_adi']);
	$image->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$image->mime_check = true;
	$image->no_script = true;
	$image->image_watermark = '../uploads/hizmetler/'.ayar('site_watermark');
	$image->Process( '../uploads/hizmetler/'.date("Y").'/'.date("m").'' );
	if (!file_exists('../uploads/hizmetler/'.date("Y").'/'.date("m").'/index.html')) { touch('../uploads/hizmetler/'.date("Y").'/'.date("m").'/index.html'); }
}

$data = [
    'hizmet_adi'		=> guvenlik($_POST['hizmet_adi']),
	'hizmet_resim'		=> date("Y").'/'.date("m").'/'.$image->file_dst_name,
	'hizmet_sira'		=> intval($_POST['hizmet_sira']),
	'hizmet_aciklama'	=> guvenlik($_POST['hizmet_aciklama']),
	'hizmet_meta'		=> guvenlik($_POST['hizmet_meta']),
	'hizmet_icerik'		=> pasifguvenlik($_POST['hizmet_icerik']),
	];
	
$isle = $db->table('dbo_hizmet')->insert($data);

	if($isle){
		$bilgi = alert('success','Hizmet Eklendi','hizmet-liste.html',3);
		}else{
		$bilgi = alert('danger','Hizmet Eklenemedi!','hizmet-liste.html',3);
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
							<h3><small class="text-muted">Hizmet Ekleme İşlemi</small></h3>
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
        <form id="form_validation" method="POST" action="hizmet-ekle.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Hizmet Bilgileri
                    </header>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Hizmet Adı</label>
                                    <input type="text" name="hizmet_adi" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label class="form-label">Hizmet Resim (370x200)</label>
                                    <input type="file" name="hizmet_resim" size="50" class="form-control btn btn-primary"/>
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                                <fieldset class="form-group">
                                    <label class="form-label">Hizmet Sıra</label>
                                    <input type="number" name="hizmet_sira" class="form-control" required>
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
                        SEO Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Hizmet Açıklama (Max 255 karakter)</label>
                            <textarea type="text" name="hizmet_aciklama" class="form-control" required></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Hizmet Anahtar Kelime (Virgül İle Ayırın)</label>
                            <textarea id="tags-editor-textarea" type="text" name="hizmet_meta" class="form-control" rows="5" required></textarea>
                        </fieldset>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                	<div class="card-block">
                     <fieldset class="form-group">
                        <label class="form-label">Hizmet Detayları</label>
                        <textarea id="summernote" name="hizmet_icerik"></textarea>
                     </fieldset>
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
<script src="../js/summernote/summernote.min.js"></script>
<script src="../js/summernote/lang/summernote-tr-TR.js"></script>
<script>
$(document).ready(function () {
    var $summernote = $('#summernote').summernote({
        height: 300,
		  toolbar: [
			['style', ['style', 'paragraph']],
			['fontsize', ['fontsize']],
			['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['insert', ['picture', 'video', 'link', 'hr']],
			['table', ['table']]
		  ],
		lang: 'tr-TR',
        callbacks: {
            onImageUpload: function (files) {
                sendFile($summernote, files[0]);
            }
        }
    });
});

function sendFile($summernote, file) {
    var formData = new FormData();
    formData.append("file", file);
    $.ajax({
        url: 'saveimage.html',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (data) {
            $summernote.summernote('insertImage', data, function ($image) {
                $image.attr('src', data);
            });
        }
    });

}
</script>
<script type="text/javascript">
	$(function() {
		$('#tags-editor-textarea').tagEditor();
	});
</script>