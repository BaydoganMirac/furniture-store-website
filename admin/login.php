<?php
include "../src/config.db.php";
include "../src/functions.php";
ob_start();
session_start();
if(isset($_SESSION["Admin"])){
    session_destroy();
    header("location:anasayfa.html");
}
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mobilya Scripti Yönetim Paneli</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
        function signin(){
                    var admin_username  = $("#inputEmailAddress").val();
                    var admin_password  = $("#inputPassword").val();
        
                    if(admin_password == "")
                    {
                        var newHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Lütfe Şifre Giriniz. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';   
                        document.getElementById("uyari").innerHTML=newHTML;  
                    }
                    else if(admin_username == "")
                    {   
                        var newHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Lütfen Email Giriniz. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                        document.getElementById("uyari").innerHTML=newHTML;  
                    }else{
                                $.ajax({       
                                    type: "POST",
                                    url:  "<?=$sitelink?>admin/ajax.php",
                                    data : {type:'signin', admin_username:admin_username,admin_password:admin_password},
                                    success: function(sonuc){
                                        if(sonuc == 1){
                                            var newHTML = '<div class="alert alert-success alert-dismissible fade show" role="alert"> Giriş Başarılı. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                                            document.getElementById("uyari").innerHTML=newHTML;
                                            window.location = "<?=$sitelink?>admin/"
                                        }else{
                                            var newHTML ='<div class="alert alert-success alert-dismissible fade show" role="alert"> Giriş Yapılamadı Lüften Tekrar Deneyiniz. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';   
                                            document.getElementById("uyari").innerHTML=newHTML;
                                        }
                                    }
                                })                                             
                    }
        
                }
        
                </script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div id="uyari"></div>
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Kullanıcı Adı" /></div>
                                            <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" type="password" placeholder="Şifre" /></div>
                                            <a class="btn btn-primary" onclick="signin()">Login</a></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
