<?php
@$menu = 'galeri-islemleri'; @$page = 'video-galeri';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid = intval($_GET["sil"]);
		$isle = $db->table('dbo_video_galeri')->where('VidGalID', '=', $silid)->delete();
			if($isle){
				$bilgi = '<br><div class="alert alert-success alert-dismissable">
												<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
												Video <strong>Kaldırıldı</strong> Lütfen Bekleyin, Yönlendiriliyorsunuz.
												<meta http-equiv="refresh" content="3;URL=video-galeri.html" />
											</div>';
				}else{
				$bilgi = '<br><div class="alert alert-danger alert-dismissable">
												<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
												Video <strong>Kaldırılamadı!</strong> Lütfen Bekleyin, Yönlendiriliyorsunuz.
												<meta http-equiv="refresh" content="3;URL=video-galeri.html" />
											</div>';
			}
}
?>
<link rel="stylesheet" href="css/lib/bootstrap-table/bootstrap-table.min.css">
	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Video Galeri</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="video-ekle.html" class="btn btn-rounded">Video Ekle</a>
						</div>
					</div>
				</div>
			</div>
		</header><!--.page-content-header-->

		<div class="container-fluid">
			<section class="card">
                <div class="card-block">
                <?=@$bilgi?>
                    <table id="table"
						   data-show-columns="false"
						   data-search="true"
						   data-pagination="true"
						   data-toolbar="#toolbar">
						<thead>
							<tr>
								<th>Sıra</th>
                                <th>Resim</th>
                                <th>Video Adı</th>
                                <th>Kategori Adı</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $video = $db->table('dbo_video_galeri as video')
										->leftJoin('dbo_video_galeri_kat as kategori','kategori.VidGalKat = video.vid_gal_kat_id')
										->orderBy('video.vid_gal_sira','asc')
                                        ->getAll();
                            foreach($video as $videoget){
                            ?>
                            <tr>
                                <td><?=$videoget->vid_gal_sira?></td>
                                <td><?=youtube($videoget->vid_gal_kod,'100','100',$videoget->vid_gal_adi,'hqdefault')?></td>
                                <td><?=$videoget->vid_gal_adi?></td>
                                <td><?=$videoget->vid_kat_adi?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="video-duzenle.html?id=<?=$videoget->VidGalID?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="video-galeri.html?sil=<?=$videoget->VidGalID?>" class="btn btn-danger"><i class="font-icon glyphicon glyphicon-trash"></i></a>
                                </center>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
					</table>
                </div>
            </section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
<?php require_once("footer.php"); ?>
<script src="js/lib/bootstrap-table/bootstrap-table.js"></script>
<script src="js/lib/bootstrap-table/jquery-ui.js"></script>
<script src="js/lib/bootstrap-table/bootstrap-table-reorder-columns.min.js"></script>
<script src="js/lib/bootstrap-table/bootstrap-table-reorder-columns-init.js"></script>