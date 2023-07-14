<form id="form_validation" method="POST" action="odeme-tanimlari.html?id=<?=$odemeayar->OdeID?>">
<div class="col-lg-6">
    <section class="card">
        <header class="card-header">
            API Erişim Bilgileriniz
        </header>
        <div class="card-block">
            <fieldset class="form-group">
                <label class="form-label">API Key</label>
                <input type="text" class="form-control" value="<?=$odemeayar->shopier_apikey?>" name="api_key" >
            </fieldset>
            <fieldset class="form-group">
                <label class="form-label">API Secret</label>
                <input type="text" class="form-control" value="<?=$odemeayar->shopier_apisecret?>" name="api_secret" >
            </fieldset>
            <fieldset class="form-group">
                <label class="form-label">Ürün Kod ( Altın Üyelik )</label>
                <input type="text" class="form-control" value="<?=$odemeayar->shopier_siplink1?>" name="shopier_siplink1" >
            </fieldset>
            <fieldset class="form-group">
                <label class="form-label">Ürün Kod ( Üyelik Bedeli )</label>
                <input type="text" class="form-control" value="<?=$odemeayar->shopier_siplink2?>" name="shopier_siplink2" >
            </fieldset>
            <fieldset class="form-group">
                <label class="form-label">Shopier Durumu</label>
                <select class="form-control" name="shopier_durum" required>
                <option value="">Durum Seçiniz</option>
                <option value="Aktif"<?php if($odemeayar->odeme_durum == 'Aktif'){echo"selected";}?>>Shopier Aktif</option>
                <option value="Pasif"<?php if($odemeayar->odeme_durum == 'Pasif'){echo"selected";}?>>Shopier Pasif</option>
                </select>
            </fieldset>
        </div>
    </section>
</div>
<!------------------------------------------------------->
<div class="col-lg-6">
    <section class="card">
        <header class="card-header">
            Bilgilendirme
        </header>
        <div class="card-block">
            <li style="padding-bottom:10px;">Shopier üyeliğinizi tamamlamanız ve sisteminizin aktif olmasının ardından Shopier'den alacağınız api ve secret bilgilerini mutlaka ilgili alanlara kayıt etmeniz gerekmektedir.</li>
            <li style="padding-bottom:10px;">Ödeme alabilmeniz için shopier panelinize girip sol alandan <b>Yeni Ürün Listeleme</b> alanına girerek Üyelik Paketi adında bir ürün eklemeniz gerekmektedir, daha sonra size shopier tarafından verilen <b>Sipariş Linki</b>'nde bulunan bağlantı adresini sonunda bulunan kodu sol'da bulunan <b>Sipariş Linki alanına yapıştırmanız gerekli.</b></li>
            <li style="padding-bottom:10px;">Hatalı bilgi girilmesi durumunda ya da bilgilerin eksik bırakılması durumunda ödeme anında kullanıcılarınızın hata alacağı ve ödeme işlemini yapamayacaklarını unutmayın. Shopier ödeme sistemini kullanmayacağınız durumlarda durumu "Shopier Pasif" olarak seçili olmalıdır.</li>
            <li style="padding-bottom:10px;">Shopier bildirim url adresiniz <span style="color:#A20002; font-weight:bold;"><?=Ayar('site_url')?>/user/shopier.html</span> 'dir, shopier hesabınızı aktif hale getirmek için bildirim url adresinizi isteyecektir bunun için Shopier panelinize giriş yapıp sol alandan <b>Özelleştirmeler > Api Erişimi</b> bölümüne girerek <b>Geri dönüş URL (1)</b> alanına yukarıdaki bildirim url adresini yapıştırıp kayıt ediniz.</li>
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