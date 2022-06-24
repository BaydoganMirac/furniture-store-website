<script>
    function deletecategory(id){
        $.ajax({
          url: "<?=$sitelink?>admin/ajax.php",
          method:"post",
          data:{type:"deletecategory", id:id},
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
        KATEGORİ EKLE <span class="badge badge-light"><i class="fas fa-plus"></i></span>
        <span class="sr-only">unread messages</span>
</button> 
<br>
<div id="addann">
        <form action="javascript:void(0);" enctype="multipart/form-data" method="post">
        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" name="category" class="form-control">
        </div>
        <div class="form-group">
            <label for="img">Kategori Fotoğrafı Seçiniz</label>
            <input type="file" name="img" class="form-control-file" id="img">
        </div>
        <input type="hidden" name="type" value="addcategory">
        <button type="submit" class="btn btn-primary">KAYDET</button>
        </form>   
    </div>
    <br>  
<div class="container">
    <div class="row">
    <?php
        $category = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
        if ( $category->rowCount() ){
            foreach( $category as $row ){
    ?>
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <img src="<?=$sitelink?>img/category/<?=$row['img']?>" class="card-img-top">
            <div class="card-body">
                <p class="card-text">
                <button id="deletecategory" onclick="deletecategory(<?=$row['id']?>)" class="btn btn-danger">
                    KATEGORİ SİL <span class="badge badge-light"><i class="fas fa-minus"></i></span>
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