<?php
$sef = $_GET["sef"];
$category = $_GET["category"];
$productinfo = $db->query("SELECT * FROM products WHERE seo = '$sef'")->fetch(PDO::FETCH_ASSOC);
?>
<script>
        $(document).on("submit","form", function () {
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
                  alert("BAŞARIYLA GÜNCELLENDİ");
                  location.reload();
                }else{
                  alert("GÜNCELLEME SIRASINDA HATA OLUŞTU");
                  location.reload();
                }
            }
          });
        });
        function deleteproduct(){
          var id = $("#productid").val();
          $.ajax({
          url: "<?=$sitelink?>admin/ajax.php",
          method:"post",
          data:{type:"deleteproduct", id:id},
            success: function(cevap){
                if(cevap == 1 ){
                  alert("BAŞARIYLA SİLİNDİ");
                  location.href = "<?=$sitelink?>admin/urunler.html";
                }else{
                  alert("SİLİNME SIRASINDA HATA OLUŞTU");
                  location.reload();
                }
            }
          });
        }
</script>
<div class="margin-top-150"></div>
<img class="img-fluid" src="<?=$sitelink?>img/products/<?=$productinfo['img']?>">
<div class="alert alert-danger" role="alert">
  Ürün Fotoğrafını Değiştirmek İstemiyorsanız Yeni Bir Fotoğraf Yüklemeyiniz.
</div>
<button id="deleteproduct" onclick="deleteproduct()" class="btn btn-danger">
			ÜRÜNÜ SİL <span class="badge badge-light"><i class="fas fa-minus"></i></span>
			<span class="sr-only">unread messages</span>
</button>
<form action="javascript:void(0);" enctype="multipart/form-data" method="post">
  <div class="form-group">
    <input type="hidden" name="type" value="productupdate">
    <input type="hidden" name="id" id="productid" value="<?=$productinfo['id']?>">
    <label for="img">Ürün Fotoğrafı Seçiniz</label>
    <input type="file" name="img" class="form-control-file" id="img">
  </div>
  <div class="form-group">
    <label for="name">Ürün Adı</label>
    <input type="text" class="form-control" name="name" id="name" value="<?=$productinfo['name']?>">
  </div>
  <div class="form-group">
    <label for="price">Ürün Fiyatı</label>
    <input type="number" class="form-control" name="price" id="price" value="<?=$productinfo['price']?>">
  </div>
  <div class="form-group">
    <label for="category">Ürün Kategorisi</label>
    <select class="custom-select custom-select-lg mb-3" id="category" name="category">
        <?php
            $categories = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
            foreach($categories as $row):
        ?>
        <option <?php if($row["id"] == $productinfo['category']) echo "selected"; ?> value="<?=$row["id"]?>"><?=$row["category"]?></option>
        <?php
            endforeach;
        ?>
    </select>
 </div>
 <div class="form-group">
    <label for="content">Ürün Açıklaması</label>
    <textarea class="form-control" id="content" name="content"><?=$productinfo['content']?></textarea>
 </div>
 <button type="submit" class="btn btn-primary">KAYDET</button>
 </form>
