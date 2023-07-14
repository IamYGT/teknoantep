<?php
@$menu = 'sayfa-islemleri'; @$page = 'sayfa-liste';
require_once("header.php");
require_once("menu-left.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_sayfa')->where('SayfaID','=',$duzenid)->getRow();
if(!$oku){
	yonver('sayfa-liste.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'sayfa_adi'		=> guvenlik($_POST['sayfa_baslik']), 
		'sayfa_desc'	=> guvenlik($_POST['sayfa_description']),  
		'sayfa_meta'	=> guvenlik($_POST['sayfa_keyword']), 
		'sayfa_icerik'	=> pasifguvenlik($_POST['editor1']),
		'sayfa_tarih'	=> $tarih 
		];
		
$isle = $db->table('dbo_sayfa')->where('SayfaID','=',$oku->SayfaID)->update($data);

	if($isle){
		$bilgi = alert('success','Sayfa Düzenlendi','sayfa-liste.html',3);
		}else{
		$bilgi = alert('danger','Sayfa Düzenlenemedi!','sayfa-liste.html',3);
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
							<h3><small class="text-muted">Sayfa Ekleme</small></h3>
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
        <form id="form_validation" method="POST" action="sayfa-duzenle.html?id=<?=$oku->SayfaID?>" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Sayfa Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Sayfa Başlığı</label>
                            <input type="text" name="sayfa_baslik" value="<?=$oku->sayfa_adi?>" class="form-control" required>
                        </fieldset>
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
                            <label class="form-label">Sayfa Kısa Açıklama (Max 255 karakter)</label>
                            <textarea type="text" name="sayfa_description" class="form-control" required><?=$oku->sayfa_desc?></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Sayfa Anahtar Kelime (Virgül İle Ayırın)</label>
                            <textarea id="tags-editor-textarea" type="text" name="sayfa_keyword" class="form-control" rows="5" required><?=$oku->sayfa_meta?></textarea>
                        </fieldset>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                	<div class="card-block">
                     <fieldset class="form-group">
                        <label class="form-label">Sayfa Açıklama</label>
                        <textarea id="summernote" name="editor1"><?=$oku->sayfa_icerik?></textarea>
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
<script>
	$(function() {
		$('#tags-editor-textarea').tagEditor();
	});
</script>