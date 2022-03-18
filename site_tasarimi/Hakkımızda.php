<?php
    session_start();
    //geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
    //error_reporting(0); 
    
include "include\js_mesaj.inc.php";



?>  
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="uye.css">
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

    include 'include\vt_baglan.inc.php';

   ?>



    </div >


        <div style='width: 550px;' class="profil">
  
           
         <img style='margin: 20px auto; width:200px; height: 200px;' class='profil_foto' src="kullanilan_resimlerin_klasoru\YAREN_VESİKALIK.jpeg">
         <p style='margin: 17px 30px; text-align:justify; font-size:18px;'> Bu proje Ocak 2022 tarihinde Yaren CAN tarafından Web Tabanlı Programlama
             dersinin proje ödevi için hazırlanmıştır. Projede veritabanına bağlanmak için PDO'dan yararlanılmıştır. Projede dosya yükleme, güncelleme, silme gibi özellikler bulunmaktadır. 
             Proje hazırlanırken HTML, CSS, PHP, çok az da Javascriptten faydalanılmıştır. 

         </p>

         </div>
               
        



        </div>

</body>

</html>