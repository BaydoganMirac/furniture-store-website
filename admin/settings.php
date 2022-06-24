<script>
   function savesettings(){
        var sitetitle = $("#sitetitle").val();
        var sitelink = $("#sitelink").val();
        var sitedescription = $("#sitedescription").val();
        var siteemail = $("#siteemail").val();
        var adress = $("#adress").val();
        var instagram = $("#instagram").val();
        var facebook = $("#facebook").val();
        var tel = $("#tel").val();
        var aboutme = $("#aboutme").val();
        $.ajax({
            url: '<?=$sitelink?>admin/ajax.php',
            method: "post",
            data:{type:"settings", sitetitle:sitetitle,sitelink:sitelink,sitedescription:sitedescription, siteemail:siteemail, adress:adress, instagram:instagram, facebook:facebook, tel:tel, aboutme:aboutme},
            success: function(cevap){
                if(cevap == 1){
                  alert("BAŞARIYLA GÜNCELLENDİ");
                  location.reload();
                }else{
                    alert("GÜNCELLEME SIRASINDA HATA OLUŞTU");
                    console.log(cevap);
                    location.reload();
                }
            }
        })
    }
</script>
<div class="margin-top-150"></div>
    <div class="form-group">
        <label for="sitetitle">Site Başlığı</label>
        <input type="text" class="form-control" name="sitetitle" id="sitetitle" value="<?=$sitetitle?>">
    </div>
    <div class="form-group">
        <label for="sitelink">Site Bağlantı Adresi</label>
        <input type="text" class="form-control" name="sitelink" id="sitelink" value="<?=$sitelink?>">
    </div>
    <div class="form-group">
        <label for="sitedescription">Site Açıklaması</label>
        <input type="text" class="form-control" name="sitedescription" id="sitedescription" value="<?=$sitedescription?>">
    </div>
    <div class="form-group">
        <label for="siteemail">Site Email</label>
        <input type="text" class="form-control" name="siteemail" id="siteemail" value="<?=$siteemail?>">
    </div>
    <div class="form-group">
        <label for="adress">Adress</label>
        <input type="text" class="form-control" name="adress" id="adress" value="<?=$adress?>">
    </div>
    <div class="form-group">
        <label for="instagram">Instagram Kullanıcı Adı</label>
        <input type="text" class="form-control" name="instagram" id="instagram" value="<?=$instagram?>">
    </div>
    <div class="form-group">
        <label for="facebook">Facebook Kullanıcı Adı</label>
        <input type="text" class="form-control" name="facebook" id="facebook" value="<?=$facebook?>">
    </div>
    <div class="form-group">
        <label for="tel">Telefon</label>
        <input type="number" class="form-control" name="tel" id="tel" value="<?=$tel?>">
    </div>
    <div class="form-group">
        <label for="aboutme">Firma Hakkında</label>
        <textarea class="form-control" name="aboutme" id="aboutme" rows="10" ><?=$aboutme?></textarea>
    </div>
    <button onclick="savesettings()" class="btn btn-success">KAYDET</button>
