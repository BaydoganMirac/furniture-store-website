<?php 
$id = $_GET["duyuruid"];
$postinfo = $db->query("SELECT * FROM announcements WHERE id='$id' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>
<div class="margin-top-150"></div>
<div class="container">

<div class="row">
    <div class="col-lg-12 float-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=$sitelink?>">Anasayfa</a></li>
                <li class="breadcrumb-item"><a href="<?=$sitelink?>/duyurular/">Duyurular</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?=$postinfo["title"]?></li>
            </ol>
        </nav>
    </div>
  <div class="col-lg-8">

    <h1 class="mt-4"><?=$postinfo["title"]?></h1>

    <hr>

    <p><?=$postinfo["date"]?></p>
    <hr>

    <img class="img-fluid rounded" src="<?=$sitelink?>img/announcements/<?=$postinfo["img"]?>" alt="<?=$postinfo["title"]?>">

    <hr>

    <p class="lead"><?=$postinfo["content"]?></p>


  </div>

  <div class="col-md-4">
    <div class="card my-4">
      <h5 class="card-header text-white">Son 5 Duyuru</h5>
      <div class="card-body">
        <div class="row">
            <ul class="list-unstyled">
            <?php
            $announcements = $db->query("SELECT * FROM announcements ORDER BY id DESC LIMIT 5", PDO::FETCH_ASSOC);
            if($announcements->rowCount()){
                foreach($announcements as $row){
            ?>
              <li>
                <a class="text-black margin-left-20" href="<?=$sitelink?>duyurular/<?=$row["id"]?>/"><?=$row["title"]?></a>
              </li>
            <?php
                }
            }
            ?>
            </ul>
        </div>
      </div>
    </div>
  </div>

</div>

</div>
