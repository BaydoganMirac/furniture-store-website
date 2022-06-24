<?php
error_reporting(E_ALL);
try{
    $db = new PDO("mysql:host=localhost;dbname=mobilya;charset=utf8", "root", "");
}catch(PDOException $e){
    print $e->getMessage();
}


$siteinfo = $db->query("SELECT * FROM settings")->fetch(PDO::FETCH_ASSOC);
$sitetitle = $siteinfo["sitetitle"];
$sitedescription = $siteinfo["sitedescription"];
$siteemail = $siteinfo["siteemail"];
$adress = $siteinfo["adress"];
$instagram = $siteinfo["instagram"];
$facebook = $siteinfo["facebook"];
$tel = $siteinfo["tel"];
$sitelink = $siteinfo["sitelink"];
$aboutme = $siteinfo["aboutme"];
?>
