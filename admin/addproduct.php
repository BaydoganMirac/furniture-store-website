<script>
        $(document).on("submit","form", function () {
            var data = new FormData(this);
          $.ajax({
          url: "<?=$sitelink?>admin/ajax.php",
          method:"post",
          data:data,
          processData: false,
          contentType: false,
            success: function(cevap){
                if(cevap == 1 ){
                  alert("BAŞARIYLA EKLENDİ");
                  location.href= "<?=$sitelink?>admin/urunler.html";
                }else{
                  alert("EKLEME SIRASINDA HATA OLUŞTU");
                  location.reload();
                }
            }
          });
    })
</script>
<div class="margin-top-150"></div>
<form action="javascript:void(0);" enctype="multipart/form-data" method="post">
  <div class="form-group">
    <input type="hidden" name="type" value="addproduct">
    <label for="img">Ürün Fotoğrafı Seçiniz</label>
    <input type="file" name="img" class="form-control-file" id="img">
  </div>
  <div class="form-group">
    <label for="name">Ürün Adı</label>
    <input type="text" class="form-control" name="name" id="name">
  </div>
  <div class="form-group">
    <label for="price">Ürün Fiyatı</label>
    <input type="number" class="form-control" name="price" id="price">
  </div>
  <div class="form-group">
    <label for="category">Ürün Kategorisi</label>
    <select class="custom-select custom-select-lg mb-3" id="category" name="category">
        <?php
            $categories = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
            foreach($categories as $row):
        ?>
        <option value="<?=$row["id"]?>"><?=$row["category"]?></option>
        <?php
            endforeach;
        ?>
    </select>
 </div>
 <div class="form-group">
    <label for="content">Ürün Açıklaması</label>
    <textarea class="form-control" id="content" name="content"></textarea>
 </div>
 <button type="submit" class="btn btn-primary">KAYDET</button>
 </form>