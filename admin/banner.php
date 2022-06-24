<script>
    function deleteslider(id){
        $.ajax({
          url: "<?=$sitelink?>admin/ajax.php",
          method:"post",
          data:{type:"deleteslider", id:id},
            success: function(cevap){
                if(cevap == 1 ){
                  alert("BAŞARIYLA SİLİNDİ");
                  location.reload();
                }else{
                  alert("SİLİNME SIRASINDA HATA OLUŞTU");
                    console.log(cevap);
                  //location.reload();
                }
            }
          });
    }
    $(document).on("submit", "form", function(){
        var data = new FormData(this);
            console.log(data);
          $.ajax({
          url: "<?=$sitelink?>admin/ajax.php",
          method:"post",
          data:data,
          processData: false,
          contentType: false,
            success: function(cevap){
                if(cevap == 1 ){
                  alert("BAŞARIYLA EKLENDİ");
                  location.reload();
                }else{
                  alert("EKLEME SIRASINDA HATA OLUŞTU");
                  console.log(cevap);
                  //location.reload();
                }
            }
          });
    });
</script>
<div class="margin-top-150"></div>
<button onclick='$("#addann").toggle()' class="btn btn-success">
        SLİDER EKLE <span class="badge badge-light"><i class="fas fa-plus"></i></span>
        <span class="sr-only">unread messages</span>
</button> 
<br>
<div id="addann">
        <form action="javascript:void(0);" enctype="multipart/form-data" method="post">
        <div class="form-group">
            <input type="hidden" name="type" value="addannouncement">
            <label for="img">Slider Fotoğrafı Seçiniz</label>
            <input type="file" name="img" class="form-control-file" id="img">
        </div>
        <input type="hidden" name="type" value="addslider">
        <button type="submit" class="btn btn-primary">KAYDET</button>
        </form>   
    </div>
    <br>  
<div class="container">
    <div class="row">
    <?php
        $slider = $db->query("SELECT * FROM slideshow", PDO::FETCH_ASSOC);
        if ( $slider->rowCount() ){
            foreach( $slider as $row ){
    ?>
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <img src="<?=$sitelink?>img/slider/<?=$row['slideimg']?>" class="card-img-top">
            <div class="card-body">
                <p class="card-text">
                <button id="deleteslider" onclick="deleteslider(<?=$row['id']?>)" class="btn btn-danger">
                    SLİDER SİL <span class="badge badge-light"><i class="fas fa-minus"></i></span>
                    <span class="sr-only">unread messages</span>
                </button>
                </p>
            </div>
        </div>
    </div>
    <?php
                }
            }
    ?>
    </div>
</div>
