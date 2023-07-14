$("#lgbtn").click(function(){
    $.ajax({
        type:'POST',
        url:'ajax/process_login.html',
        data:$('#lgfrm').serialize(),
        success: function(cvp) { 
			$('#sonuc').hide().html(cvp).fadeIn("slow");
		}
    });
});

  /* Picture Delete */
$('.resimsil').click(function(){
	var degisken = $(this);
	var Bkldir = degisken.attr('id');
	var veri = 'resimsil=' + Bkldir;
		$.ajax({
		   type: "GET",
		   url: "firma-liste.html",
		   data: veri,
		   success: function(){}
		});
	$(this).parents("p").animate({backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow"); 
	return false;
});

  /* Picture Delete */
$('.etksil').click(function(){
	var degisken = $(this);
	var Bkldir = degisken.attr('id');
	var veri = 'etksil=' + Bkldir;
		$.ajax({
		   type: "GET",
		   url: "yazilim-liste.html",
		   data: veri,
		   success: function(){}
		});
	$(this).parents("li").animate({backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow"); 
	return false;
});

  /* Web Ürün Sipariş */
$("#UrBtn").click(function(){
    $.ajax({
        type:'POST',
        url:'ajax/usr_w_islem.html',
        data:$('#UrFrm').serialize(),
		beforeSend: function(msg) {
        $("#UrBtn").val('Lütfen Bekleyin...').attr("disabled", "disabled"); 
        },
        success: function(cvp) { 
			$('#sonuc').hide().html(cvp).fadeIn("slow");
			$("#UrBtn").val('Siparişi Ekle').prop("disabled", false);
		}
    });
});

  /* Hizmet Ürün Sipariş */
$("#HiBtn").click(function(){
    $.ajax({
        type:'POST',
        url:'ajax/usr_h_islem.html',
        data:$('#HiFrm').serialize(),
		beforeSend: function(msg) {
        $("#HiBtn").val('Lütfen Bekleyin...').attr("disabled", "disabled"); 
        },
        success: function(cvp) { 
			$('#sonuch').hide().html(cvp).fadeIn("slow");
			$("#HiBtn").val('Siparişi Ekle').prop("disabled", false);
		}
    });
});

  /* Bayi Paket Sipariş */
$("#BaBtn").click(function(){
    $.ajax({
        type:'POST',
        url:'ajax/usr_b_islem.html',
        data:$('#BaFrm').serialize(),
		beforeSend: function(msg) {
        $("#BaBtn").val('Lütfen Bekleyin...').attr("disabled", "disabled"); 
        },
        success: function(cvp) { 
			$('#sonucb').hide().html(cvp).fadeIn("slow");
			$("#BaBtn").val('Siparişi Ekle').prop("disabled", false);
		}
    });
});

  /* Ödeme Hatırlatma (Mail) */
$("#MahBtn").click(function(){
    $.ajax({
        type:'POST',
        url:'ajax/usr_mail_hat.html',
        data:$('#MahFrm').serialize(),
		beforeSend: function(msg) {
        $("#MahBtn").val('Lütfen Bekleyin...').attr("disabled", "disabled"); 
        },
        success: function(cvp) { 
			$('#sonucx').hide().html(cvp).fadeIn("slow");
			$("#MahBtn").val('Tekrar Gönder').prop("disabled", false);
		}
    });
});

  /* Ödeme Hatırlatma (SMS) */
$("#SahBtn").click(function(){
    $.ajax({
        type:'POST',
        url:'ajax/usr_sms_hat.html',
        data:$('#SahFrm').serialize(),
		beforeSend: function(msg) {
        $("#SahBtn").val('Lütfen Bekleyin...').attr("disabled", "disabled"); 
        },
        success: function(cvp) { 
			$('#sonucx').hide().html(cvp).fadeIn("slow");
			$("#SahBtn").val('Tekrar Gönder').prop("disabled", false);
		}
    });
});