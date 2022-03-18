<?php
session_start();

//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
    

include "include\js_mesaj.inc.php";

if (isset($_SESSION["yetki"]) and $_SESSION["yetki"] == true) {
    jsmesaj_gonder("Giriş sayfasına gidebilmek için çıkış yapmalısınız.", "kitap_elestirileri.php");
}
  


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="kullanilan_resimlerin_klasoru\a_booka.png">
    <!--import icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Readex+Pro:wght@200&family=Roboto:wght@100&display=swap"
        rel="stylesheet">
    <title>Readers</title>


</head>

<body>
    <div id="container">

    <?php
    include "include\aramasiz_header.inc.php";
    ?>


        <div class="content">
            <div></div>
            <div id="Form_kutu">
                <div class="Baslik">
                    <img src="kullanilan_resimlerin_klasoru/login.png" alt="">
                </div>
                <form id="giris_formu" form method="post" action="Giris_kontrol.php">
                    <div class="input_container">
                        <i class="fa fa-user icon"></i>
                        <input id="kullanici_isim" type="text" name="Kullanici_ismi" placeholder="Kullanıcı İsminiz" required>
                    </div>
                    <div class="input_container">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="Sifre" placeholder="Şifreniz" required>
                    </div>
                    <input type="submit" name="oturum_ac" value="Oturum Aç" id="oturum_ac_button">
                    <a href="#" id="sifre_unutma">Şifreni mi unuttun?</a>
                    <a href="uye.php" id="yeni_hesap_olustur">Hesabın yok mu? Üye Ol</a>
            </div>
            </form>
        </div>
        

        <div class="footer"></div>

    </div>


</body>

</html>