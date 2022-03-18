<?php
    session_start();

    //geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
    //error_reporting(0); 
    

    include "include\js_mesaj.inc.php";
    
    if (!isset($_SESSION["yetki"]) and $_SESSION["yetki"] == false) {
        jsmesaj_gonder("Bu sayfaya gidebilmek için giriş yapmalısınız!", "giris.php");
    }
  

    include 'include\vt_baglan.inc.php';


    $sql ="select * from vt_elestiri where kod = :elestirikod"; //tablonun adını yazdık.
    //kullanici_ismi unique olduğu için tek bir değer gelecek ayrıca kayit formundakilerin
    //hepsini almamıza gerek yok sadece kullanici_ismi yeterli.
    
    
    $ifade = $vt->prepare($sql);
    $ifade->execute(Array(":elestirikod"=>$_GET["elestirikod"]));
    
    $elestiri = $ifade->fetch(PDO::FETCH_ASSOC); //döngüye ihtiyacım yok çünkü sadece bir değer dönecek.
    //kayit dizi olarak bilgiyi getirir. 
    if ($_SESSION["Kod"] != $elestiri["elestirinin_sahibi"]) {
        jsmesaj_gonder("Böyle bir eleştiri bulunamadı.", "kitap_elestirileri.php");
    }
    if($elestiri== false) {//Böyle bir eleştiri yoksa false değer verir. Kontrol sağlanmış olur.
        jsmesaj_gonder("Böyle bir eleştiri bulunamadı.","kitap_elestirileri.php");
    
    }    
  


    
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
    include "include\header.inc.php";
    ?>

        </div>


        <div class="elestiri">
        <main>
            <h1> Kitap Eleştirini Güncelle </h1>
           
            <form enctype="multipart/form-data" action="duzelt.php" method="POST"> 
                <input type="hidden" name="kod" value="<?php echo $elestiri["kod"];?>">
                <input type="text" name="kitap_ismi" id="kitap_ismi" required value="<?php echo $elestiri["baslik"];?>"> 
                <!--  <input name="yuklenenDosya" type="file">-->
                <label for="aciklama">Kitap Eleştirinizi Giriniz. </label>
                <textarea style="color:white" rows="9" name="aciklama" id="aciklama" required><?php echo $elestiri["elestiri"];?></textarea>
                <input type="submit" id="elestiri_yukle" value="Düzelt" name="form" required >
            </form> 

        </main>


        </div>


      

        
       

      <!--   <div class="footer"></div>-->

    </div>


</body>

</html>