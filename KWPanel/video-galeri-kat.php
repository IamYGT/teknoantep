<?php
@$menu = 'galeri-islemleri'; @$page = 'video-kat';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid = intval($_GET["sil"]);
		$isle = $db->table('dbo_video_galeri_kat')->where('VidGalKat', '=', $silid)->delete();
			if($isle){
				$bilgi = '<br><div class="alert alert-success alert-dismissable">
												<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
												Kategori <strong>Kaldırıldı</strong> Lütfen Bekleyin, Yönlendiriliyorsunuz.
												<meta http-equiv="refresh" content="3;URL=video-galeri-kat.html" />
											</div>';
				}else{
				$bilgi = '<br><div class="alert alert-danger alert-dismissable">
												<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
												Kategori <strong>Kaldırılamadı!</strong> Lütfen Bekleyin, Yönlendiriliyorsunuz.
												<meta http-equiv="refresh" content="3;URL=video-galeri-kat.html" />
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
							<h3><small class="text-muted">Video Galeri Kategori</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="video-galeri-kat-ekle.html" class="btn btn-rounded">Kategori Ekle</a>
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
								<th>Kategori Adı</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $kategori = $db->table('dbo_video_galeri_kat')
                                           ->getAll();
                            foreach($kategori as $kategoriget){
                            ?>
                            <tr>
                                <td><?=$kategoriget->vid_kat_adi?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="video-galeri-kat-duzenle.html?id=<?=$kategoriget->VidGalKat?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="video-galeri-kat.html?sil=<?=$kategoriget->VidGalKat?>" class="btn btn-danger"><i class="font-icon glyphicon glyphicon-trash"></i></a>
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