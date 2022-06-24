<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php
        $slider = $db->query("SELECT * FROM slideshow", PDO::FETCH_ASSOC);
        if ( $slider->rowCount() ){
            $sayac = 0;
            foreach( $slider as $row ){
    ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?=$sayac?>" <?php if($sayac == 0){echo 'class="active"';} ?>></li>

    <?php
            $sayac++;
            }
        }
    ?>
    </ol>
    <div class="carousel-inner" role="listbox">
    <?php
        $slider = $db->query("SELECT * FROM slideshow", PDO::FETCH_ASSOC);
        if ( $slider->rowCount() ){
            $sayac = 0;
             foreach( $slider as $row ){
    ?>
        <div class="carousel-item <?php if($sayac == 0){echo 'active';} ?>" style="background-image: url('img/slider/<?=$row["slideimg"]?>')">
        </div>
    <?php
            $sayac++;
            }
        }
    ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>

  <div class="container">
        <h1 class="category" id="urunler">Kategoriler</h1>
        <div class="category-content" >
            <?php 
                $category = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
                if($category->rowCount()){
                    foreach($category as $row){
            ?>
                <div class="category-card" data-desc="<?=$row['category']?>">
                    <a href="<?=$sitelink?>urunler/<?=$row['seo']?>/"><img class="category-img" src="<?=$sitelink?>img/category/<?=$row['img']?>" alt="<?=$row['category']?>" data-desc="<?=$row['category']?>"></a>
                </div>  
            <?php    
                    }
                }
            ?>
      
        </div>
        <div class="announcements">
            <h1 class="announcements-header"><i class="fas fa-bullhorn"></i> <a class="text-bg" href="<?=$sitelink?>duyurular.html" alt="Tüm Duyurular">Duyurular</a></h1>
            <div class="card-columns">
                <?php
                    $announcements = $db->query("SELECT * FROM announcements ORDER BY id DESC LIMIT 6", PDO::FETCH_ASSOC);
                    if($announcements->rowCount()){
                        foreach($announcements as $row){
                ?>
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title"><a href="<?=$sitelink?>duyurular/<?=$row["id"]?>/" class="text-black"><?=$row["title"]?></a></h5>
                    <p class="card-text"><?=$row["content"]?></p>
                    <p class="card-text"><small class="text-muted">
                        <?php if (tarihfarki($row["datestamp"]) ==0) {
                                    echo "Bugün";
                                } else {
                                    echo tarihfarki($row["datestamp"])." Gün Önce";
                                }
					    ?></small></p>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
  </div>
