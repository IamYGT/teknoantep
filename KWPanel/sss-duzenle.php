<?php
@$menu = 'sss-islemleri'; @$page = 'sss-liste';
require_once("header.php");
require_once("menu-left.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_sss')->select('*')->where('SssID','=',$duzenid)->getRow();
if(!$oku){
	yonver('sayfa-liste.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'soru'	=> guvenlik($_POST['soru']), 
		'cevap'	=> pasifguvenlik($_POST['cevap']),
		'sira'	=> pasifguvenlik($_POST['sira'])
		];
		
$isle = $db->table('dbo_sss')->where('SssID','=',$oku->SssID)->update($data);

	if($isle){
		$bilgi = alert('success','SSS Düzenlendi','sss-liste.html',3);
		}else{
		$bilgi = alert('danger','SSS Düzenlenemedi!','sss-liste.html',3);
	}

}
?>
<link rel="stylesheet" href="../js/summernote/summernote.css"/>
<link rel="stylesheet" href="../js/summernote/editor.min.css">

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">S.S.S Düzenleme</small></h3>
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
        <form id="form_validation" method="POST" action="sss-duzenle.html?id=<?=$oku->SssID?>" enctype="multipart/form-data">
			<div class="col-lg-12">
                <section class="card">
                    <header class="card-header">
                        S.S.S Bilgileri
                    </header>
                    <div class="card-block">
                        <div class="row">
                        <div class="col-md-12">
                        <fieldset class="form-group">
                            <label class="form-label">S.S.S Soru</label>
                            <input type="text" name="soru" value="<?=$oku->soru?>" class="form-control" required>
                        </fieldset>
                        </div>
                        <div class="col-md-12">
                        <fieldset class="form-group">
                            <label class="form-label">S.S.S Cevap</label>
                            <textarea id="summernote" type="text" name="cevap" class="form-control" rows="6" required><?=$oku->cevap?></textarea>
                        </fieldset>
                        </div>
                        <div class="col-md-1">
                        <fieldset class="form-group">
                            <label class="form-label">Sıra</label>
                            <input type="text" name="sira" value="<?=$oku->sira?>" class="form-control" required>
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
<script src="../js/summernote/summernote.min.js"></script>
<script src="../js/summernote/lang/summernote-tr-TR.js"></script>
<script>
$(document).ready(function () {
    var $summernote = $('#summernote').summernote({
        height: 300,
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