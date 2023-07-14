<?php
@$menu = 'genel-ayarlar'; @$page = 'banka-ayarlari';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid= intval($_GET["sil"]);
	
		$sql1 = $db->table('dbo_banka')->where('BankaID', '=', $silid)->getAll();
			foreach($sql1 as $sql1resim){
				unlink("../uploads/genelresim/".$sql1resim->banka_logo);
			}
		
		$isle = $db->table('dbo_banka')->where('BankaID', '=', $silid)->delete();
		
			if($isle){
				$bilgi = alert('success','Banka Silindi','banka-ayarlari.html',3);
				}else{
				$bilgi = alert('success','Banka Silinemedi!','banka-ayarlari.html',3);
			}
}
/********************************************************************************************************/
?>
<link rel="stylesheet" href="css/lib/bootstrap-table/bootstrap-table.min.css">
	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Tanımlı Banka Listesi</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="banka-ekle.html" class="btn btn-rounded">Banka Ekle</a>
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
								<th>Banka Adı</th>
                                <th>Hesap No</th>
                                <th>IBAN/SWIFT/BCKEY</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $banka = $db->table('dbo_banka')
                                        ->select('*')
										->orderBy('BankaID', 'desc')
                                        ->getAll();
                            foreach($banka as $bankaget){
							?>
                            <tr>
                                <td><?=$bankaget->banka_adi?></td>
                                <td><?=$bankaget->banka_h_no?></td>
                                <td><?=$bankaget->banka_iban?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="banka-duzenle.html?id=<?=$bankaget->BankaID?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="banka-ayarlari.html?sil=<?=$bankaget->BankaID?>" class="btn btn-danger" title="Sil!"><i class="fa fa-trash-o"></i></a>
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