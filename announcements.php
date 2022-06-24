<div class="margin-top-150"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="announcements">
            <h1 class="announcements-header"><i class="fas fa-bullhorn"></i> Duyurular</h1>
            <div class="card-columns">
                <?php
                    $announcements = $db->query("SELECT * FROM announcements ORDER BY id DESC", PDO::FETCH_ASSOC);
                    if($announcements->rowCount()){
                        foreach($announcements as $row){
                ?>
                <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                    <img src="<?=$sitelink?>img/announcements/<?=$row['img']?>" class="card-img" alt="<?=$row['title']?>">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['title']?></h5>
                        <p class="card-text"><?php echo substr($row["content"], 0, 30); ?>
                       
                    </p>
                        <p class="card-text"><small class="text-muted">
                        <?php if (tarihfarki($row["datestamp"]) ==0) {
                                    echo "Bugün";
                                } else {
                                    echo tarihfarki($row["datestamp"])." Gün Önce";
                                }
                        ?><br> <a href="<?=$sitelink?>duyurular/<?=$row["id"]?>/" class="text-black">Devamını Oku >></a></small></p>
                    </div>
                    </div>
                </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        </div>
    </div>
</div>