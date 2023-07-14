<?php
@$page = 'servis';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid= intval($_GET["sil"]);
		
		$isle = $db->table('dbo_servis_talep')->where('SrvTlpID', '=', $silid)->delete();
		
			if($isle){
				$bilgi = alert('success','Talep Silindi','servis-liste.html',3);
				}else{
				$bilgi = alert('success','Talep Silinemedi!','servis-liste.html',3);
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
							<h3><small class="text-muted">Gelen Servis Talepleri</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action" style="display:none;">
							<a href="yonetici-ekle.html" class="btn btn-rounded">Yönetici Ekle</a>
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
								<th>Gönderen</th>
                                <th>Mail Adresi</th>
                                <th>Gsm Numarası</th>
                                <th>Tarihi</th>
                                <th>Durum</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $mesajlar = $db->table('dbo_servis_talep')
										   ->orderBy('SrvTlpID', 'desc')
                                           ->getAll();
                            foreach($mesajlar as $mesajlarget){
							?>
                            <tr>
                                <td><?=$mesajlarget->srv_adsoyad?></td>
                                <td><?=$mesajlarget->srv_eposta?></td>
                                <td><?=$mesajlarget->srv_gsmno?></td>
                                <td><?=cevirtarih($mesajlarget->sv_ek_tarih);?></td>
                                <td><?php if($mesajlarget->srv_goruldu == '0'){echo "<strong>OKUNMADI</strong>";}else{echo "OKUNDU";}?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="servis-kontrol.html?id=<?=$mesajlarget->SrvTlpID?>" class="btn btn-primary" title="Oku"><i class="fa fa-search"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="servis-liste.html?sil=<?=$mesajlarget->SrvTlpID?>" class="btn btn-danger" title="Sil!"><i class="fa fa-trash-o"></i></a>
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