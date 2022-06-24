<?php
$sef = $_GET["sef"];
$category = $_GET["category"];
$categoryid = $db->query("SELECT * FROM category WHERE seo = '$category'")->fetch(PDO::FETCH_ASSOC);
$productinfo = $db->query("SELECT * FROM products WHERE seo ='$sef'")->fetch(PDO::FETCH_ASSOC);
?>
<div class="margin-top-150"></div>
<div class="container">
	<div class="row">
		<div class="col-lg-12 float-right">
	        <nav aria-label="breadcrumb">
	            <ol class="breadcrumb">
	                <li class="breadcrumb-item"><a href="<?=$sitelink?>">Anasayfa</a></li>
	                <li class="breadcrumb-item"><a href="<?=$sitelink?>urunler/<?=$category?>/"><?=$categoryid["category"]?></a></li>
	                <li class="breadcrumb-item active"><?=$productinfo["name"]?></li>
	            </ol>
	        </nav>
	    </div>
	<div class="col-lg-8">

    <h1 class="mt-4"><?=$productinfo["name"]?></h1>

    <hr>

    <img class="img-fluid rounded" src="<?=$sitelink?>img/products/<?=$productinfo["img"]?>" alt="<?=$productinfo['name']?>">

    <hr>

    <p class="lead"><?=$productinfo["content"]?></p>


	</div>
	  <div class="col-md-4">
	    <div class="card my-4">
	      <h5 class="card-header text-white text-center">ÜRÜN FİYATI</h5>
	      <div class="card-body">
	            <ul class="list-unstyled text-center">
	            	<li><?=$productinfo["price"]?> ₺</li>
	            </ul>
	      </div>
	    </div>
	  </div>

	</div>
</div>