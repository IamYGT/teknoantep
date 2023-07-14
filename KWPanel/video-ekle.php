<?php
@$menu = 'galeri-islemleri'; @$page = 'video-galeri';
require_once("header.php");
require_once("menu-left.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [ 
		'vid_gal_adi'		=> guvenlik($_POST['vid_gal_adi']), 
		'vid_gal_kod'		=> guvenlik($_POST['vid_gal_kod']),
		'vid_gal_kat_id'	=> guvenlik($_POST['vid_gal_kat_id']),
		'vid_gal_sira'		=> guvenlik($_POST['vid_gal_sira'])
		];
		
$isle = $db->table('dbo_video_galeri')->insert($data);

	if($isle){
		$bilgi = alert('success','Video Eklendi','video-galeri.html',3);
		}else{
		$bilgi = alert('danger','Video Eklenemedi!','video-galeri.html',3);
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
							<h3><small class="text-muted">Video Ekleme</small></h3>
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
        <form id="form_validation" method="POST" action="video-ekle.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Resim Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Video Adı</label>
                            <input type="text" name="vid_gal_adi" class="form-control" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Video Kategori</label>
                            <select name="vid_gal_kat_id" class="form-control">
                            	<?php
                                $bkat = $db->table('dbo_video_galeri_kat')
										   ->getall();
								foreach($bkat as $bkatget){
								?>
                                <option value="<?=$bkatget->VidGalKat?>"><?=$bkatget->vid_kat_adi?></option>
                                <?php } ?>
                            </select>
                        </fieldset>
                       <fieldset class="form-group">
                            <label class="form-label">Video Link (Youtube)</label>
                            <input type="text" name="vid_gal_kod" class="form-control" required>
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
                                <li style="list-style:none; text-align:center; border:1px solid #C30003; padding:15px;">Video eklemek için youtube'de izlediğiniz videonun tam link satırını kopyalamanız gerekmtektedir, Örn : https://www.youtube.com/watch?v=xcJtL7QggTI</li>
                        	</div>
                            <div class="col-md-3">
                                <fieldset class="form-group">
                                    <label class="form-label">Video Sıra</label>
                                    <input type="number" name="vid_gal_sira" class="form-control" required>
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