<?php 
require "../src/config.db.php";
require "../src/functions.php";
session_start();
ob_start();
if($_POST){
		// GİRİŞ İŞLEMLERİ
		if($_POST["type"]=='signin'){
			$admin_username = trim(htmlspecialchars(addslashes($_POST["admin_username"])));
			$admin_pw = md5(trim(htmlspecialchars(addslashes($_POST["admin_password"]))));
			$baglan = $db->query("SELECT * FROM admins WHERE adminusername='$admin_username' and adminpassword='$admin_pw' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
			if(count($baglan) >0){
				$_SESSION["Admin"] = $baglan["adminusername"];
				echo "1";
			}else{
				echo "2";
			}
		}
		// ÜRÜN GÜNCELLEME
		if($_POST["type"] == 'productupdate'){
			$productname = trim(htmlspecialchars(addslashes($_POST["name"])));
			$productprice = trim(htmlspecialchars(addslashes($_POST["price"])));
			$productcontent = trim(htmlspecialchars(addslashes($_POST["content"])));
			$productcategory = trim(htmlspecialchars(addslashes($_POST["category"])));
			$productid =  trim(htmlspecialchars(addslashes($_POST["id"])));
			$productimg = $_FILES["img"];

			if($productimg["size"]>1){
				$extension = substr($productimg["name"],-4,4);
				$newFileName = rand(0,999999999).$extension;
				$filePath = "../img/products/".$newFileName;
					if($productimg["type"]=="image/jpeg" || $productimg["type"]=="image/png" || $productimg["type"]=="image/jpg" || $productimg["type"]=="image/gif"){
						if(is_uploaded_file($productimg["tmp_name"])){
							$moveNewFile = move_uploaded_file($productimg["tmp_name"], $filePath);
							if($moveNewFile){
								$oldPic = $db->query("SELECT * FROM products WHERE id='$productid' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
								$oldPicDelete = unlink("../img/products/".$oldPic["img"]);
								if($oldPicDelete){
									$update = $db->prepare("UPDATE products SET
									name = :name,
									price = :price,
									content = :content,
									category = :category,
									seo = :seo,
									img = :img
									WHERE id = :id");
									$productUpdate = $update->execute(array(
										"name" =>$productname,
										"price" =>$productprice,
										"content" => $productcontent,
										"category" => $productcategory,
										"id" => $productid,
										"seo" => seo($productname),
										"img" => $newFileName
									));
									if($productUpdate){
										echo "1";
									}else{
										echo "2";
									}
								}
							}
						}else{
							echo "4";
						}
					}else{
						echo "5";
					}
			}else{
				$update = $db->prepare("UPDATE products SET
				name = :name,
				price = :price,
				content = :content,
				category = :category,
				seo = :seo
				WHERE id = :id");
				$productUpdate = $update->execute(array(
					"name" =>$productname,
					"price" =>$productprice,
					"content" => $productcontent,
					"category" => $productcategory,
					"id" => $productid,
					"seo" => seo($productname)
				));
				if($productUpdate){
					echo "1";
				}else{
					echo "2";
				}
			}
		}
		// ÜRÜN EKLEME
		if($_POST["type"] == 'addproduct'){
			$productname = trim(htmlspecialchars(addslashes($_POST["name"])));
			$productprice = trim(htmlspecialchars(addslashes($_POST["price"])));
			$productcontent = trim(htmlspecialchars(addslashes($_POST["content"])));
			$productcategory = trim(htmlspecialchars(addslashes($_POST["category"])));
			$productimg = $_FILES["img"];

			if($productimg["size"]>1){
				$extension = substr($productimg["name"],-4,4);
				$newFileName = rand(0,999999999).$extension;
				$filePath = "../img/products/".$newFileName;
					if($productimg["type"]=="image/jpeg" || $productimg["type"]=="image/png" || $productimg["type"]=="image/jpg" || $productimg["type"]=="image/gif"){
						if(is_uploaded_file($productimg["tmp_name"])){
							$moveNewFile = move_uploaded_file($productimg["tmp_name"], $filePath);
							if($moveNewFile){
									$add = $db->prepare("INSERT INTO products SET
									name = :name,
									price = :price,
									content = :content,
									category = :category,
									seo = :seo,
									img = :img");
									$productAdd = $add->execute(array(
										"name" =>$productname,
										"price" =>$productprice,
										"content" => $productcontent,
										"category" => $productcategory,
										"seo" => seo($productname),
										"img" => $newFileName
									));
									if($productAdd){
										echo "1";
									}else{
										echo "2";
									}
								
							}
						}else{
							echo "4";
						}
					}else{
						echo "5";
					}
			}else{
				echo "7";
			}
		}
		// URUN SİLME
		if($_POST["type"]=='deleteproduct'){
			$productid		=	trim(htmlspecialchars(addslashes($_POST["id"])));
			$productinfo 	=	$db->query("SELECT * FROM products WHERE id='$productid'")->fetch(PDO::FETCH_ASSOC);
			$productimg 	= 	$productinfo["img"];
			$filepath 		= 	"../img/products/".$productimg;
			$deleteimg		=	@unlink("$filepath");
				if($deleteimg){
					$query = $db->prepare("DELETE FROM products WHERE id = :id");
					$delete = $query->execute(array(
					   'id' => $productid
					));
					if($delete){
						echo "1";
					}else{
						echo "2";
					}
				}else{
					echo "Resim Silinirken Hata";
				}
		}
		// DUYURU SİLME
		if($_POST["type"]=='deleteannouncement'){
			$announcementid		=	trim(htmlspecialchars(addslashes($_POST["id"])));
			$announcementinfo 	=	$db->query("SELECT * FROM announcements WHERE id='$announcementid'")->fetch(PDO::FETCH_ASSOC);
			$announcementimg 	= 	$announcementinfo["img"];
			$filepath 		= 	"../img/announcements/".$announcementimg;
			$deleteimg		=	unlink("$filepath");
				if($deleteimg){
					$query = $db->prepare("DELETE FROM announcements WHERE id = :id");
					$delete = $query->execute(array(
					   'id' => $announcementid
					));
					if($delete){
						echo "1";
					}else{
						echo "2";
					}
				}else{
					echo "Resim Silinirken Hata";
				}
		}
		// DUYURU EKLEME
		if($_POST["type"] == 'addannouncement'){
			$ANNtitle = trim(htmlspecialchars(addslashes($_POST["name"])));
			$ANNcontent = trim(htmlspecialchars(addslashes($_POST["content"])));
			$ANNimg = $_FILES["img"];
			setlocale(LC_TIME,'turkish'); 
			$date = iconv('latin5','utf-8',strftime('%e %B %Y %A %H:%M:%S'));
			$datestamp = time();
			if($ANNimg["size"]>1){
				$extension = substr($ANNimg["name"],-4,4);
				$newFileName = rand(0,999999999).$extension;
				$filePath = "../img/announcements/".$newFileName;
					if($ANNimg["type"]=="image/jpeg" || $ANNimg["type"]=="image/png" || $ANNimg["type"]=="image/jpg" || $ANNimg["type"]=="image/gif"){
						if(is_uploaded_file($ANNimg["tmp_name"])){
							$moveNewFile = move_uploaded_file($ANNimg["tmp_name"], $filePath);
							if($moveNewFile){
								$add = $db->prepare("INSERT INTO announcements SET
									title = :title,
									content = :content,
									date = :date,
									datestamp = :datestamp,
									img = :img
								");
								$ANNadd = $add->execute(array(
									"title" => $ANNtitle,
									"content" => $ANNcontent,
									"date" => $date,
									"datestamp" => $datestamp,
									"img" => $newFileName
								));
								if($ANNadd){
									echo "1";
								}else{
									echo "2";
								}
								
							}
						}else{
							echo "4";
						}
					}else{
						echo "5";
					}
			}else{
				echo "7";
			}
		}
		// SİTE AYARLARI
		if($_POST["type"]=="settings"){
			$sitetitle	 = trim(htmlspecialchars(addslashes($_POST["sitetitle"])));
			$sitedescription = trim(htmlspecialchars(addslashes($_POST["sitedescription"])));
			$sitelink = trim(htmlspecialchars(addslashes($_POST["sitelink"])));
			$siteemail = trim(htmlspecialchars(addslashes($_POST["siteemail"])));
			$adress = trim(htmlspecialchars(addslashes($_POST["adress"])));
			$instagram = trim(htmlspecialchars(addslashes($_POST["instagram"])));
			$facebook = trim(htmlspecialchars(addslashes($_POST["facebook"])));
			$aboutme = trim(htmlspecialchars($_POST["aboutme"]));
			$tel = trim(htmlspecialchars(addslashes($_POST["tel"])));
			$update = $db->prepare("UPDATE settings SET
				sitetitle =:sitetitle,
				sitedescription = :sitedescription,
				sitelink = :sitelink,
				siteemail = :siteemail,
				adress = :adress,
				instagram = :instagram,
				facebook = :facebook,
				aboutme = :aboutme,
				tel = :tel	 WHERE id=1
			");
			$settingsupdate = $update->execute(array(
				"sitetitle" => $sitetitle,
				"sitedescription" => $sitedescription,
				"sitelink" => $sitelink,
				"siteemail" => $siteemail,
				"adress" => $adress,
				"instagram" =>$instagram,
				"facebook" =>$facebook,
				"aboutme" =>$aboutme,
				"tel" => $tel
			));
			if($settingsupdate){
				echo "1";
			}else{
				echo "2";
			}
		}
		// SLİDER SİLME
		if($_POST["type"]=='deleteslider'){
			$sliderid		=	trim(htmlspecialchars(addslashes($_POST["id"])));
			$sliderinfo 	=	$db->query("SELECT * FROM slideshow WHERE id='$sliderid'")->fetch(PDO::FETCH_ASSOC);
			$categoryimg 	= 	$sliderinfo["slideimg"];
			$filepath 		= 	"../img/slider/".$categoryimg;
			$deleteimg		=	unlink("$filepath");
				if($deleteimg){
					$query = $db->prepare("DELETE FROM slideshow WHERE id = :id");
					$delete = $query->execute(array(
					   'id' => $sliderid
					));
					if($delete){
						echo "1";
					}else{
						echo "2";
					}
				}else{
					echo "Resim Silinirken Hata";
				}
		}
		// SLİDER EKLEME
		if($_POST["type"] == 'addslider'){
			
			$sliderimg = $_FILES["img"];
			if($sliderimg["size"]>1){
				$extension = substr($sliderimg["name"],-4,4);
				$newFileName = rand(0,999999999).$extension;
				$filePath = "../img/slider/".$newFileName;
					if($sliderimg["type"]=="image/jpeg" || $sliderimg["type"]=="image/png" || $sliderimg["type"]=="image/jpg" || $sliderimg["type"]=="image/gif"){
						if(is_uploaded_file($sliderimg["tmp_name"])){
							$moveNewFile = move_uploaded_file($sliderimg["tmp_name"], $filePath);
							if($moveNewFile){
								$add = $db->prepare("INSERT INTO slideshow SET
									slideimg = :img
								");
								$SliderADD = $add->execute(array(
									"img" => $newFileName
								));
								if($SliderADD){
									echo "1";
								}else{
									echo "2";
								}
								
							}
						}else{
							echo "4";
						}
					}else{
						echo "5";
					}
			}else{
				echo "7";
			}
		}
	// KATEGORİ EKLEME
	if($_POST["type"] == 'addcategory'){
		$categoryname = trim(htmlspecialchars(addslashes($_POST["category"])));
		$categoryimg = $_FILES["img"];
		if($categoryimg["size"]>1){
			$extension = substr($categoryimg["name"],-4,4);
			$newFileName = rand(0,999999999).$extension;
			$filePath = "../img/category/".$newFileName;
				if($categoryimg["type"]=="image/jpeg" || $categoryimg["type"]=="image/png" || $categoryimg["type"]=="image/jpg" || $categoryimg["type"]=="image/gif"){
					if(is_uploaded_file($categoryimg["tmp_name"])){
						$moveNewFile = move_uploaded_file($categoryimg["tmp_name"], $filePath);
						if($moveNewFile){
							$add = $db->prepare("INSERT INTO category SET
								img = :img,
								category = :category,
								seo = :seo
							");
							$categoryADD = $add->execute(array(
								"category" => $categoryname,
								"seo" => seo($categoryname),
								"img" => $newFileName
							));
							if($categoryADD){
								echo "1";
							}else{
								echo "2";
							}
							
						}
					}else{
						echo "4";
					}
				}else{
					echo "5";
				}
		}else{
			echo "7";
		}
	}
	// KATEGORİ SİLME
	if($_POST["type"]=='deletecategory'){
		$categoryid		=	trim(htmlspecialchars(addslashes($_POST["id"])));
		$categoryinfo 	=	$db->query("SELECT * FROM category WHERE id='$categoryid'")->fetch(PDO::FETCH_ASSOC);
		$categoryimg 	= 	$categoryinfo["img"];
		$filepath 		= 	"../img/category/".$categoryimg;
		$deleteimg		=	unlink("$filepath");
			if($deleteimg){
				$query = $db->prepare("DELETE FROM category WHERE id = :id");
				$delete = $query->execute(array(
				'id' => $categoryid
				));
				if($delete){
					echo "1";
				}else{
					echo "2";
				}
			}else{
				echo "Resim Silinirken Hata";
			}
	}
}
?>