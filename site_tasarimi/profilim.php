<?php
    session_start();
    //geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
    //error_reporting(0); 
    
include "include\js_mesaj.inc.php";

if (!isset($_SESSION["yetki"]) and $_SESSION["yetki"] == false) {
    jsmesaj_gonder("Profilinizi görmek için giriş yapmalısınız!", "giris.php");
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
    include "include\aramasiz_header.inc.php";

    include 'include\vt_baglan.inc.php';

    $sql ="select * from uye where Kod = :Kod"; //tablonun adını yazdık.
//kullanici_ismi unique olduğu için tek bir değer gelecek ayrıca kayit formundakilerin
//hepsini almamıza gerek yok sadece kullanici_ismi yeterli.


$ifade = $vt->prepare($sql);
$ifade->execute(Array(":Kod"=>$_SESSION["Kod"]));

$uye = $ifade->fetch(PDO::FETCH_ASSOC); //döngüye ihtiyacım yok çünkü sadece bir değer dönecek.
//kayit dizi olarak bilgiyi getirir. 

/*
if($kayit== false) {//Böyle bir kullanici yoksa false değer verir.
    jsmesaj_gonder("Kullanıcı adı veya şifre hatalı.","giris.php");

}    
*/
    ?>



        </div>


        <div class="profil">
  
            <form enctype="multipart/form-data" action="profili_yukle.php" method="POST"> 
                
                <?php
                    echo "<img style='margin: 10px auto;' class='profil_foto' src='";
                    echo $uye["profil"];//veritabanından dosya ismini aldık.
                    echo "'>";
                ?>
                <div id="button_yan">
                <input id="profil_fotosu" name="yuklenenDosya" type="file">
                <input type="submit" id="elestiri_yukle" value="Yükle" name="formdangelen">
                </div>
                <p id="isim">
                <?php echo htmlentities($_SESSION["Ad"]); 
                echo " ";
                echo htmlentities($_SESSION["Soyad"]);
                
                ?>
                </p>
                <!--  <label for="aciklama">Kitap Eleştirinizi Giriniz. </label>
                <textarea rows="9" name="aciklama" id="aciklama"></textarea>-->
                
            </form> 
        



        </div>

        <?php



         $sql3 ="select count(*) as kac_kis from vt_elestiri where elestirinin_sahibi=:elestirinin_sahibi";
         $ifade3 = $vt->prepare($sql3);
         $ifade3->execute(Array(":elestirinin_sahibi"=>$_SESSION["Kod"]));
         $kayit3 = $ifade3->fetch(PDO::FETCH_ASSOC);
            
          if($kayit3["kac_kis"]>0){   ?>


        <div style="margin-top: 2%; margin-bottom: 1px;" class="kitap_elestiri">
 
 <section  style="margin: 0px auto; width:950px;">
     <article  class="tablo_baslik">
 
         <div class="Resim_stn">Resim</div>
         <div class="Kitap_ismi_stn">Kitap İsmi</div>
         
         <div class="Islem"> İşlem </div>
     
     </article>

       </section>


      

   
       

      <!--   <div class="footer"></div>-->

    </div>
    <section style="width:950px; margin: 10px auto;">

    <?php
    //veritabanına bağlandık
   include 'include\vt_baglan.inc.php';

   

    $sql6 = "select * from vt_elestiri where elestirinin_sahibi=:elestirinin_sahibi"; 
    
    //limit 2 koyarsan 2 tane gösterir.
    $ifade6 = $vt->prepare($sql6);
    $ifade6->execute(Array(":elestirinin_sahibi"=>$_SESSION["Kod"])); 

    
    while ($kayit6 = $ifade6->fetch(PDO::FETCH_ASSOC)) {
        
        echo "<article class='tablo_satir'>\r\n";
        echo "<div class='Resim_stn'>";
        echo "<img class='kucukresim' src='";
        echo $kayit6["dosya"];//veritabanından dosya ismini aldık.
        echo "'></div>";
        echo "<a style='margin-left:200px;' id='detaybaslik' href='detay.php?elestirininkodu=";
        echo $kayit6["kod"];
        echo "' class='Kitap_ismi_stn'>";
        echo htmlentities($kayit6['baslik']);
        echo "</a>";
       
        echo "<div class='Islem'>";
        
        echo "<a style='margin-left:40px' class='guncelle_btn' href='duzelt_form.php?elestirikod="; 
        echo $kayit6["kod"];
        echo "'>Güncelle </a> ";?>
        <form action="duzelt.php" method="POST"> <!-- sil button halinde -->
            <input type="hidden" name="silkod" value="<?php echo $kayit6['kod'];?>">
            <input style="margin-left:40px" type="submit" name="form" value="Sil" class='guncelle_btn'>
        </form>

  
       
        <?php  echo "</article>"; } $vt=null; ?>
  
    </section>
    <?php    } ?>
</body>

</html>