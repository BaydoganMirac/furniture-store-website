<?php
$categoryinfo = $db->query("SELECT * FROM products ORDER BY id DESC", PDO::FETCH_ASSOC);
?>
<div class="margin-top-150"></div>
<div class="container">
	<div class="row">
	<div class="col-md-12">
	<a href="<?=$sitelink?>admin/urunekle.html" class="btn btn-success">
			ÜRÜN EKLE <span class="badge badge-light"><i class="fas fa-plus"></i></span>
			<span class="sr-only">unread messages</span>
	</a>
	</div>
<?php 
if($categoryinfo->rowCount()){
	foreach ($categoryinfo as $row) {	
	$category = $db->query("SELECT * FROM category WHERE id ='".$row['category']."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>
		<div class="col-md-4">
			<a href="<?=$sitelink?>admin/urunler/<?=$category['seo']?>/<?=$row['seo']?>.html" class="product-link">
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