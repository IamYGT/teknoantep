<?php
@$menu = 'menu-islemleri'; @$page = 'menu-liste';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid = intval($_GET["sil"]);
		$isle = $db->table('dbo_menu')->where('MenuID', '=', $silid)->delete();
			if($isle){
				$bilgi = '<br><div class="alert alert-success alert-dismissable">
												<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
												Menü <strong>Kaldırıldı</strong> Lütfen Bekleyin, Yönlendiriliyorsunuz.
												<meta http-equiv="refresh" content="3;URL=menu-liste.html" />
											</div>';
				}else{
				$bilgi = '<br><div class="alert alert-danger alert-dismissable">
												<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
												Menü <strong>Kaldırılamadı!</strong> Lütfen Bekleyin, Yönlendiriliyorsunuz.
												<meta http-equiv="refresh" content="3;URL=menu-liste.html" />
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
							<h3><small class="text-muted">Menü Listesi</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="menu-ekle.html" class="btn btn-rounded">Menü Ekle</a>
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
                              <th>Menü Adı</th>
                              <th>Bağlı Sayfa</th>
                              <th>Bağlı Link</th>
                              <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $menuler = $db->table('dbo_menu as menu')
										  ->leftJoin('dbo_sayfa as sayfa','menu.sayfaid=sayfa.SayfaID')
                                          ->getAll();
                            foreach($menuler as $menuyaz){
                            ?>
                            <tr>
                                <td><?=$menuyaz->sira?></td>
                                <td><?=$menuyaz->menu?></td>
                                <td><?php if(empty($menuyaz->sayfaid)){echo '<span class="label label-custom label-pill label-danger">Boş</span>';}else{echo $menuyaz->sayfa_adi;}?></td>
                          		<td><?php if(empty($menuyaz->link)){echo '<span class="label label-custom label-pill label-danger">Boş</span>';}else{echo $menuyaz->link;}?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="menu-duzenle.html?id=<?=$menuyaz->MenuID?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="menu-liste.html?sil=<?=$menuyaz->MenuID?>" class="btn btn-danger"><i class="font-icon glyphicon glyphicon-trash"></i></a>
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