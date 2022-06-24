<?php
include "src/config.db.php";
include "src/functions.php";
include "pages.php";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$sitelink?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$sitelink?>css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"/>
    <script src="<?=$sitelink?>js/jquery-3.3.1.min.js"></script>
    <title><?=$sitetitle?></title>
    <script>
        $(document).ready(function(){
            var topbar = $(".top-bar");
            if(topbar.css("display") == "block"){
                $("#navbar").addClass("navbar-toppx");
            }
        })
        $(document).on("scroll", function(){
            var topbar = $(".top-bar");
            if(topbar.css("display") == "block"){
                if($(document).scrollTop() > 20){
                    $("nav").removeClass("navbar-toppx")
                }else{
                    $("nav").addClass("navbar-toppx")
                }
            }
        })
    </script>
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-inside">
            <a href="mailto:<?=$siteemail?>" class="vhr" alt="Mail Adresi"><i class="fas fa-envelope"></i> <?=$siteemail?></a> 
            <a href="#" alt="Konum" class="vhr"><i class="fas fa-map-marker-alt"></i> <?=$adress?></a> 
            <a href="https://instagram.com/<?=$instagram?>" target="_blank" alt="Instagram" class="vhr"><i class="fab fa-instagram"></i></a>   &nbsp;&nbsp;<a href="https://facebook.com/<?=$facebook?>" target="_blank" alt="Facebook"><i class="fab fa-facebook"></i></a>
        </div>
    </div>
    <nav id="navbar" class="navbar fixed-top navbar-expand-lg bg-secondary-c">
    <a class="navbar-brand" href="<?=$sitelink?>"><img src="<?=$sitelink?>img/logobeyaz.png" height="100px" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fas fa-bars text-white"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="<?=$sitelink?>hakkimizda.html">Kurumsal</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=$sitelink?>#urunler">Ürünlerimiz</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=$sitelink?>duyurular.html">Duyurular</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=$sitelink?>iletisim.html">İletişim</a>
        </li>
        </ul>
    </div>
    </nav>
        <?php 
            @$page = $_GET["page"];
            if($page){
                include($pages[$page]);
            }else{
                include($pages["anasayfa"]);
            }
        ?>
    <footer>
        <div>
            <img src="<?=$sitelink?>img/logobeyaz.png" alt="BaydoganMirac" height="100px"><br>
            <a href="mailto:<?=$siteemail?>"  alt="Mail Adresi"><i class="fas fa-envelope"></i> <?=$siteemail?></a><br>
            <a href="#" alt="Konum" ><i class="fas fa-map-marker-alt"></i> <?=$adress?></a><br>
            <a href="https://instagram.com/<?=$instagram?>" target="_blank" alt="Instagram" data-desc="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://facebook.com/<?=$facebook?>" target="_blank" alt="Facebook" data-desc="Facebook"><i class="fab fa-facebook"></i></a>
        </div>
        <div>
            <h3 class="announcements-header"><i class="fas fa-bullhorn text-white"></i> <a class="text-white" href="<?=$sitelink?>duyurular.html" alt="Tüm Duyurular">Duyurular</a></h3>
                    <?php
                        $announcements = $db->query("SELECT * FROM announcements ORDER BY id DESC LIMIT 3", PDO::FETCH_ASSOC);
                        if($announcements->rowCount()){
                            foreach($announcements as $row){
                    ?>
                    <span class="card-title"><a href="<?=$sitelink?>duyurular/<?=$row["id"]?>/" class="text-white"><i class="fas fa-angle-right"></i> <?=$row["title"]?></a></span><br>
                    <?php
                            }
                        }
                    ?>
        </div>
        <div>
        <h3 class=" text-white" id="urunler"><i class="fas fa-clipboard-list text-white"></i> Kategoriler</h3>
            <?php 
                $category = $db->query("SELECT * FROM category LIMIT 5", PDO::FETCH_ASSOC);
                if($category->rowCount()){
                    foreach($category as $row){
            ?>
                    <a href="<?=$sitelink?>urunler/<?=$row['seo']?>/"><i class="fas fa-angle-right"></i> <?=$row['category']?></a><br>
            <?php    
                    }
                }
            ?>
      
        </div>
    </footer>
    <script src="<?=$sitelink?>js/bootstrap.min.js"></script>
</body>
</html>