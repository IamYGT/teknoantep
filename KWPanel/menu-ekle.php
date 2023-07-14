<?php
@$menu = 'menu-islemleri'; @$page = 'menu-ekle';
require_once("header.php");
require_once("menu-left.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [
		'sira'		=> guvenlik($_POST['sira']),
		'menu'		=> guvenlik($_POST['menuadi']),
		'ustid'		=> guvenlik($_POST['ustmenu']),
		'link'		=> guvenlik($_POST['menulink']),
		'tarih'		=> $tarih,
		'menutipi'	=> guvenlik($_POST['menutip']),
		'sayfaid'	=> guvenlik($_POST['menusayfa'])
		];
	
$isle = $db->table('dbo_menu')->insert($data);

	if($isle){
		$bilgi = alert('success','Kategori Eklendi','menu-liste.html',3);
		}else{
		$bilgi = alert('danger','Kategori Eklenemedi!','menu-liste.html',3);
	}

}
?>
	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Menü Ekleme İşlemi</small></h3>
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
        <form id="form_validation" method="POST" action="menu-ekle.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Menü Bilgileri
                    </header>
                    <div class="card-block">
                        <div class="row">
                        	<div class="col-md-12">
                                <fieldset class="form-group">
                                    <label>Menü Adı</label>
                                    <input type="text" name="menuadi" class="form-control" required>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label>Bağlı Menü</label>
                                    <select id="ustmenu" name="ustmenu" class="form-control">
                                        <option value="">Bağlı Menü Seçin...</option>
                                        <?php 
                                        $baglimenu = $db->table('dbo_menu')
                                                        ->getAll();
                                        foreach($baglimenu as $baglimenuyaz){
                                        ?>
                                        <option value="<?=$baglimenuyaz->MenuID?>"><?=$baglimenuyaz->menu?></option>
                                        <?php } ?>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label>Menü Tipi</label>
                                    <select id="menutip" name="menutip" class="form-control" required onChange="MenuDurum();">
                                        <option value="">Menü Tipi Seçin...</option>
                                        <option value="LINK">Sayfa URL</option>
                                        <option value="SAYFA">Bağlı Sayfa</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-12" id="MenuLink" style="display:none">
                                <fieldset class="form-group">
                                    <label>Link Girin</label>
                    				<input type="text" name="menulink" placeholder="http://" class="form-control">
                                </fieldset>
                            </div>
                            <div class="col-md-12" id="MenuSayfa" style="display:none">
                                <fieldset class="form-group">
                                    <label>Bağlı Sayfa</label>
                                    <select id="menusayfa" name="menusayfa" class="form-control">
                                        <option value="">Sayfa Seçin...</option>
                                        <?php 
										$sayfacek = $db->table('dbo_sayfa')
                                                       ->getAll();
                                        foreach($sayfacek as $sayfayaz){
                                        ?>
                                        <option value="<?=$sayfayaz->SayfaID?>"><?=$sayfayaz->sayfa_adi?></option>
                                        <?php } ?>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                                <fieldset class="form-group">
                                    <label>Menü Sıra</label>
                    				<input type="text" name="sira"class="form-control">
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
                <section class="card">
                	<header class="card-header">
                        Bilgiler
                    </header>
                    <div class="card-block">
                    <li style="margin-bottom:3px;">Oluşturacağınız menüler web sitenizin menü sistemi olarak kullanılmaktadır ve tamamen dinamik çalışma sistemine sahiptir.</li>
                    <li style="margin-bottom:3px;"><strong>Bağlı Menü</strong> seçeneğinde herhangi bir seçim yapmazsanız, eklediğiniz menü ana menü olarak görüntülenir.</li>
                    <li style="margin-bottom:3px;"><strong>Menü Tipi</strong> seçeneğini <strong>Sayfa URL</strong> olarak seçtiğinizde, menüye tıklandığında hangi sayfaya gitmesini istiyorsanız o sayfanın adresini yazınız, ana menü olarak kullanacaksanız # işareti giriniz.</li>
                    <li style="margin-bottom:3px;"><strong>Menü Tipi</strong> seçeneğini <strong>Bağlı Sayfa</strong> olarak seçtiğinizde, menüye tıklandığında hangi sayfaya gitmesini istiyorsanız açılan alt menüden daha önceden oluşturduğunuz sayfayı seçmeniz gerekmektedir.</li>
                    <li style="margin-bottom:3px;"><strong>Menü Sıra</strong> bölümüne yalnızca rakam ile giriş yapınız, istediğiniz sıra numarasını verdiğinizde sitenizde menü verdiğiniz sıra numarasına göre görüntülenir.</li>
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
<script type="text/javascript">
function MenuDurum()
{
	if(document.getElementById('menutip').value == 'LINK'){
		document.getElementById('MenuLink').style.display = 'block';	
	}else{
		document.getElementById('MenuLink').style.display = 'none';	
	}
	if(document.getElementById('menutip').value == 'SAYFA'){
		document.getElementById('MenuSayfa').style.display = 'block';	
	}else{
		document.getElementById('MenuSayfa').style.display = 'none';	
	}
}
</script>