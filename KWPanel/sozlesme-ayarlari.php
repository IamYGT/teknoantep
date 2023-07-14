<?php
@$menu = 'genel-ayarlar'; @$page = 'sozlesme-ayarlari';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'site_gizlilik_sozlesme'	=> $_POST['site_gizlilik_sozlesme'], 
		'site_hizmet_sozlesme'		=> $_POST['site_hizmet_sozlesme'],  
		'site_mesafeli_tasima'		=> $_POST['site_mesafeli_tasima'],
		'site_cerez_politikasi'		=> $_POST['site_cerez_politikasi']
		];
		
$isle = $db->table('dbo_siteayar')->where('SiteID','=',1)->update($data);

	if($isle){
		$bilgi = alert('success','Kayıtlar İşlendi','sozlesme-ayarlari.html',3);
		}else{
		$bilgi = alert('danger','Kayıtlar İşlenemedi!','sozlesme-ayarlari.html',3);
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
							<h3><small class="text-muted">Site Sözleşmeleri</small></h3>
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
        <form id="form_validation" method="POST" action="sozlesme-ayarlari.html" enctype="multipart/form-data">
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                	<div class="card-block">
                     <fieldset class="form-group">
                        <label class="form-label">Gizlilik Sözleşmesi</label>
                        <textarea id="summernote1" name="site_gizlilik_sozlesme"><?=ayar('site_gizlilik_sozlesme')?></textarea>
                     </fieldset>
                     </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                	<div class="card-block">
                     <fieldset class="form-group">
                        <label class="form-label">Hizmet Sözleşmesi</label>
                        <textarea id="summernote2" name="site_hizmet_sozlesme"><?=ayar('site_hizmet_sozlesme')?></textarea>
                     </fieldset>
                     </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                	<div class="card-block">
                     <fieldset class="form-group">
                        <label class="form-label">Mesafeli Satış Sözleşmesi</label>
                        <textarea id="summernote3" name="site_mesafeli_tasima"><?=ayar('site_mesafeli_tasima')?></textarea>
                     </fieldset>
                     </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                	<div class="card-block">
                     <fieldset class="form-group">
                        <label class="form-label">Çerez Politikası</label>
                        <textarea id="summernote4" name="site_cerez_politikasi"><?=ayar('site_cerez_politikasi')?></textarea>
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
<script src="../js/summernote/summernote.min.js"></script>
<script src="../js/summernote/lang/summernote-tr-TR.js"></script>
<script>
$(document).ready(function () {
    var $summernote = $('#summernote1').summernote({
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
<script>
$(document).ready(function () {
    var $summernote = $('#summernote2').summernote({
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
<script>
$(document).ready(function () {
    var $summernote = $('#summernote3').summernote({
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
<script>
$(document).ready(function () {
    var $summernote = $('#summernote4').summernote({
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