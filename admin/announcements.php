<script>
    function deleteannouncement(id){
          $.ajax({
          url: "<?=$sitelink?>admin/ajax.php",
          method:"post",
          data:{type:"deleteannouncement", id:id},
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
                  location.reload();
                }
            }
          });
    });

</script>
<div class="margin-top-150"></div>
    <button onclick='$("#addann").toggle()' class="btn btn-success">
        DUYURU EKLE <span class="badge badge-light"><i class="fas fa-plus"></i></span>
        <span class="sr-only">unread messages</span>
    </button>  
    <div id="addann">
        <form action="javascript:void(0);" enctype="multipart/form-data" method="post">
        <div class="form-group">
            <input type="hidden" name="type" value="addannouncement">
            <label for="img">Duyuru Fotoğrafı Seçiniz</label>
            <input type="file" name="img" class="form-control-file" id="img">
        </div>
        <div class="form-group">
            <label for="name">Duyuru Başlığı</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="content">Duyuru Açıklaması</label>
            <textarea class="form-control" id="content" name="content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">KAYDET</button>
        </form>   
    </div>  
<div class="announcements">
    <h1 class="announcements-header">Duyurular</h1>
    <div class="card-columns">
        <?php
            $announcements = $db->query("SELECT * FROM announcements ORDER BY id DESC", PDO::FETCH_ASSOC);
            if($announcements->rowCount()){
                foreach($announcements as $row){
        ?>
        <div class="card">
            <div class="card-body">
            <h5 class="card-title"><?=$row["title"]?></h5>
            <p class="card-text"><?=$row["content"]?></p>
            <p class="card-text"><small class="text-muted">
                <?php if (tarihfarki($row["datestamp"]) ==0) {
                            echo "Bugün";
                        } else {
                            echo tarihfarki($row["datestamp"])." Gün Önce";
                        }
                ?></small></p>
                <button onclick="deleteannouncement(<?=$row['id']?>)" class="btn btn-danger">
                            DUYURUYU SİL <span class="badge badge-light"><i class="fas fa-minus"></i></span>
                            <span class="sr-only">unread messages</span>
                </button>            
            </div>
        </div>
        <?php
                }
            }
        ?>
    </div>
</div>