<?php
@$menu = 'blog-islemleri'; @$page = 'blog-liste';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_blog')
		  ->where('BlogID','=',$duzenid)
		  ->getRow();
if(!$oku){
	yonver('blog-liste.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$image = new Upload($_FILES['blog_resim']);
	if ( $image->uploaded ) {
	$image->file_new_name_body = seo($_POST['blog_baslik']);
	$image->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$image->mime_check = true;
	$image->no_script = true;
	$image->image_resize = true;
	$image->image_ratio_crop = true;
	$image->image_y = 458;
	$image->image_x = 836;
	$image->image_watermark = '../uploads/genelresim/'.ayar('site_watermark');
	$image->Process( '../uploads/blog/'.date("Y").'/'.date("m").'' );
	if (!file_exists('../uploads/blog/'.date("Y").'/'.date("m").'/index.html')) { touch('../uploads/blog/'.date("Y").'/'.date("m").'/index.html'); }
}

$imagex = new Upload($_FILES['blog_resim']);
	if ( $image->uploaded ) {
	$imagex->file_new_name_body = seo('thumb_'.$_POST['blog_baslik']);
	$imagex->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
	$imagex->mime_check = true;
	$imagex->no_script = true;
	$imagex->image_resize = true;
	$imagex->image_ratio_crop = true;
	$imagex->image_y = 208;
	$imagex->image_x = 358;
	$imagex->image_watermark = '../uploads/genelresim/'.ayar('site_watermark');
	$imagex->Process( '../uploads/blog/'.date("Y").'/'.date("m").'' );
	if (!file_exists('../uploads/blog/'.date("Y").'/'.date("m").'/index.html')) { touch('../uploads/blog/'.date("Y").'/'.date("m").'/index.html'); }
}

$data = [ 
		'blog_baslik'	=> guvenlik($_POST['blog_baslik']), 
		'blog_desc'		=> guvenlik($_POST['blog_desc']),  
		'blog_meta'		=> guvenlik($_POST['blog_meta']), 
		'blog_icerik'	=> pasifguvenlik($_POST['blog_icerik']),
		'blog_kat_id'	=> guvenlik($_POST['blog_kat_id'])
		];
		
$isle = $db->table('dbo_blog')->where('BlogID','=',$oku->BlogID)->update($data);

	/*********************************************************************************************/
	if(!empty($image->file_dst_name) && !empty($_FILES['blog_resim'])){
		$resup = [ 'blog_resim' => date("Y").'/'.date("m").'/'.$image->file_dst_name ];
		$logo = $db->table('dbo_blog')->where('BlogID','=',$oku->BlogID)->update($resup);
	}
	/*********************************************************************************************/
		if(!empty($imagex->file_dst_name) && !empty($_FILES['blog_resim'])){
		$resupx = [ 'blog_thumb' => date("Y").'/'.date("m").'/'.$imagex->file_dst_name ];
		$logox = $db->table('dbo_blog')->where('BlogID','=',$oku->BlogID)->update($resupx);
	}
	/*********************************************************************************************/

	if($isle || $logo || $logox){
		$bilgi = alert('success','Blog Düzenlendi','blog-liste.html',3);
		}else{
		$bilgi = alert('danger','Blog Düzenlemedi!','blog-liste.html',3);
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
							<h3><small class="text-muted">Blog Düzenle</small></h3>
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
        <form id="form_validation" method="POST" action="blog-duzenle.html?id=<?=$oku->BlogID?>" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Blog Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Blog Başlığı</label>
                            <input type="text" name="blog_baslik" value="<?=$oku->blog_baslik?>" class="form-control" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Blog Resim</label>
                            <input type="file" name="blog_resim" size="50" class="form-control btn btn-primary"/>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Blog Kategori</label>
                            <select name="blog_kat_id" class="form-control">
                            	<?php
                                $bkat = $db->table('dbo_blog_kat')
										   ->getall();
								foreach($bkat as $bkatget){
								?>
                                <option value="<?=$bkatget->BlogKatID?>" <?php if($bkatget->BlogKatID == $oku->blog_kat_id){ echo 'selected'; }?>><?=$bkatget->blog_kat_adi?></option>
                                <?php } ?>
                            </select>
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
                            <label class="form-label">Blog Kısa Açıklama (Max 255 karakter)</label>
                            <textarea type="text" name="blog_desc" class="form-control" required><?=$oku->blog_desc?></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Blog Anahtar Kelime (Virgül İle Ayırın)</label>
                            <textarea id="tags-editor-textarea" type="text" name="blog_meta" class="form-control" rows="5" required><?=$oku->blog_meta?></textarea>
                        </fieldset>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                	<div class="card-block">
                     <fieldset class="form-group">
                        <label class="form-label">Haber Açıklama</label>
                        <textarea id="summernote" name="blog_icerik"><?=$oku->blog_icerik?></textarea>
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
<script>
	$(function() {
		$('#tags-editor-textarea').tagEditor();
	});
</script>