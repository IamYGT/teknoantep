<?php
@$page = 'guvenlik';
require_once("header.php");
require_once("menu-left.php");
/********************************************************************************************************/
?>
<link rel="stylesheet" href="css/lib/bootstrap-table/bootstrap-table.min.css">
	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Güvenlik Listesi</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action" style="display:none;">
							<a href="paket-ekle.html" class="btn btn-rounded">Paket Ekle</a>
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
                            <th>IP</th>
                            <th>İşlem</th>
                            <th>Tarih / Saat</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $paket = $db->table('dbo_ban_ip')
										->orderBy('BanID', 'desc')
                                        ->getAll();
                            foreach($paket as $haberyaz){
							?>
                            <tr>
                              <td><?=$haberyaz->ip?></td>
                              <td><?=kisalt($haberyaz->referer_url,150)?></td>
                              <td><?=cevirtarih($haberyaz->date)?> <?=$haberyaz->time?></td>
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