<?php
$sef = $_GET["category"];
$categoryid = $db->query("SELECT * FROM category WHERE seo = '$sef'")->fetch(PDO::FETCH_ASSOC);
$categoryinfo = $db->query("SELECT * FROM products WHERE category =".$categoryid['id']."", PDO::FETCH_ASSOC);
?>

<div class="margin-top-150"></div>
<div class="container">
	<div class="row">
	<div class="col-lg-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=$sitelink?>">Anasayfa</a></li>
                <li class="breadcrumb-item active"><?=$categoryid["category"]?></li>
            </ol>
        </nav>
    </div>
<?php 
if($categoryinfo->rowCount()){
	foreach ($categoryinfo as $row) {	
?>
		<div class="col-md-4">
			<a href="<?=$sitelink?>urunler/<?=$categoryid['seo']?>/<?=$row['seo']?>.html" class="product-link">
			<div class="card product-card">
			  <img src="<?=$sitelink?>img/products/<?=$row['img']?>" class="card-img products-img" alt="<?=$row['name']?>">
			  <div class="card-img-overlay products-overlay" data-desc="<?=$row["name"]?>">
			    <h5 class="card-title margin-top--10"><?=$row["name"]?></h5>
			  </div>
			</div>
			</a>
		</div>


<?php
	}
}
?>
	</div>
</div>