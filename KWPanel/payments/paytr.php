<form id="form_validation" method="POST" action="odeme-tanimlari.html?id=<?=$odemeayar->OdeID?>">
<div class="col-lg-6">
    <section class="card">
        <header class="card-header">
            Mağaza Bilgileri
        </header>
        <div class="card-block">
            <fieldset class="form-group">
                <label class="form-label">Mağaza ID (Mağaza ID)</label>
                <input type="text" class="form-control" value="<?=$odemeayar->merchant_id?>" name="merchant_id" >
            </fieldset>
            <fieldset class="form-group">
                <label class="form-label">Mağaza Parolası (API Key)</label>
                <input type="text" class="form-control" value="<?=$odemeayar->merchant_key?>" name="merchant_key" >
            </fieldset>
            <fieldset class="form-group">
                <label class="form-label">Mağaza Şifresi (API Secret)</label>
                <input type="text" class="form-control" value="<?=$odemeayar->merchant_salt?>" name="merchant_salt" >
            </fieldset>
            <fieldset class="form-group">
                <label class="form-label">Paytr Durumu</label>
                <select class="form-control" name="paytr_durum" required>
                <option value="">Durum Seçiniz</option>
                <option value="Aktif"<?php if($odemeayar->odeme_durum == 'Aktif'){echo"selected";}?>>Paytr Aktif</option>
                <option value="Pasif"<?php if($odemeayar->odeme_durum == 'Pasif'){echo"selected";}?>>Paytr Pasif</option>
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
            <li style="padding-bottom:10px;">PayTR üyeliğinizi tamamlamanız ve sisteminizin aktif olmasının ardından PayTR'den alacağınız api ve secret bilgilerini mutlaka ilgili alanlara kayıt etmeniz gerekmektedir.</li>
            <li style="padding-bottom:10px;">Hatalı bilgi girilmesi durumunda ya da bilgilerin eksik bırakılması durumunda ödeme anında kullanıcılarınızın hata alacağı ve ödeme işlemini yapamayacaklarını unutmayın. PayTR ödeme sistemini kullanmayacağınız durumlarda durumu "PayTR Pasif" olarak seçili olmalıdır.</li>
            <li>Paytr bildirim url adresiniz <span style="color:#A20002; font-weight:bold;"><?=Ayar('site_url')?>/user/paytr.html</span> 'dir, paytr hesabınızı aktif hale getirmek için bildirim url adresinizi isteyecektir.</li>
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