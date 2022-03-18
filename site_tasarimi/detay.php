<?php
session_start();
// GET["kod"] tanımlanmış mı?

//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
    
include "include\js_mesaj.inc.php";

if (!isset($_GET["elestirininkodu"])) {
    jsmesaj_gonder("Detayını görmek için önce ürün seçmelisiniz!", "kitap_elestirileri.php");
    exit;
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

<?php

    include "include\header.inc.php";


include 'include\vt_baglan.inc.php';

$sql ="select vt_elestiri.*, uye.Ad, uye.Soyad from uye inner join vt_elestiri on uye.Kod = vt_elestiri.elestirinin_sahibi and vt_elestiri.kod=:kod"; //tablonun adını yazdık.


$ifade = $vt->prepare($sql);
$ifade->execute(Array(":kod"=>$_GET["elestirininkodu"]));

$kayit = $ifade->fetch(PDO::FETCH_ASSOC); //döngüye ihtiyacım yok çünkü sadece bir değer dönecek.
//kayit dizi olarak bilgiyi getirir. 

if($kayit== false) {//Böyle bir eleştiri yoksa false değer verir.
    jsmesaj_gonder("Böyle bir eleştiri bulunamadı.","kitap_elestirileri.php");
    exit;
}    


//BEGENİDE KULLANILACAK.
$elestiriKod=$kayit["kod"];
?>



<body>

    <div style="margin-bottom: 0.5%;" class="detay">

        <h1 style="margin-bottom: 2%; ">  <?php echo htmlentities($kayit["baslik"]); ?> </h1>
        <div id="yatayflex_detay">
            <img id="detay_resim" src="<?php echo $kayit["dosya"]; ?>" alt="">
            <div id="bilgiler"> 
               
                <p> <span style="font-weight: bold;">Eleştirmen:</span>  <?php echo htmlentities($kayit["Ad"]); echo " "; echo htmlentities($kayit["Soyad"]); ?> </p>
                <p> <span style="font-weight: bold;">Paylaşıldığı Tarih: </span> <?php echo $kayit["yuklenme_tarihi"]; ?> </p>
                <p> <span style="font-weight: bold;">Eleştiri:</span>  </p>
                <p><?php echo htmlentities($kayit["elestiri"]); ?>
            
            </div>
          

 

</div>
</div>
    <!-- like -->
<!-- beğeni sayısını bulalım -->

<?php 
 $sql3 ="select count(*) as kac_kisi from begeni where elestiriKod = :elestiriKod";
 $ifade3 = $vt->prepare($sql3);
 $ifade3->execute(Array(":elestiriKod"=>$elestiriKod));
 $kayit3 = $ifade3->fetch(PDO::FETCH_ASSOC);

?>


    <?php
        if (isset($_SESSION["yetki"]) and $_SESSION["yetki"] == true) {
          // Veri tabanına yukarıda bağlanıldı.
        
          $sql2 ="select count(*) as sayi from begeni where uyeKod = :uyeKod and elestiriKod = :elestiriKod";
          $ifade2 = $vt->prepare($sql2);
          $ifade2->execute(Array(":uyeKod"=>$_SESSION["Kod"],":elestiriKod"=>$elestiriKod));
          $kayit2 = $ifade2->fetch(PDO::FETCH_ASSOC);
          if ($kayit2["sayi"] == 0) { // Daha önce favori eklememiş
         
         ?>



<p class="begenisayisi"> <?php echo $kayit3["kac_kisi"];?> </p>
        
        <form action="begeni_ekle.php" method="post">
        <input type="hidden" name="begenkod" value="<?php echo $kayit['kod'];?>">
      
        
        <input type="submit" id="like" value="Beğen" name="begen">
        <i id="i_like"style="color:darkgrey;" class="fa fa-heart"> </i>
        </form>
      
        <!-- like bitiş -->
        <?php }  else{ ?> 
<!-- dislike başlangıç -->
        <form action="begeni_ekle.php" method="post">
        <input type="hidden" name="dislike" value="<?php echo $kayit['kod'];?>">
        <p id="after_begenisayisi"> <?php echo $kayit3["kac_kisi"]; ?></p>
        <input type="submit" id="dislike" value="Beğeniyi kaldır" name="begen">
        <i id="i_dislike"style="color:red;" class="fa fa-heart"> </i>
        </form>


        <?php } } 
        else{?>
  
        <i id="nogrs_like"style="color:red;" class="fa fa-heart"> </i>
        <p class="begenisayisi" style="font-size: 18px;  left: 74%; cursor:default;"> Beğeni Sayısı: <?php echo $kayit3["kac_kisi"];?> </p>
    
        <?php  }?>
<?php
if(isset($_SESSION["yetki"]) and $_SESSION["yetki"]==true){ ?>
<div id="yorum">
         <!--  <h1 style="margin-bottom: 2%; font-size:30px;">  Yorum Yap</h1>-->
        
                <form action="yorum_ekle.php" method="post" id="ck" >
                <input type="hidden" name="yorumkod" value="<?php echo $kayit["kod"]; ?>">
                <textarea style="color:white; margin-top:3%"rows="5" class="ckeditor"  placeholder="Bir yorum yaz." name="txtCkeditor"></textarea>
            
                <input type="submit" name="formyorum" id="yorum_buton" value="Yorumu Paylaş">
                </form>  
   
</div>


<?php } ?>



<!-- yorumları görüntüleme -->
<section id="detay_yorum">
          <?php
     
          
          $sql ="select yorum.*, uye.Ad, uye.Soyad from yorum inner join uye on uye.Kod = yorum.uyeKod and yorum.elestiriKod = :elestiriKod order by zaman desc";
          $ifade = $vt->prepare($sql);
          $ifade->execute(Array("elestiriKod"=>$kayit["kod"]));
          
          while ($kayit = $ifade->fetch(PDO::FETCH_ASSOC)) {
            echo '<div  style="margin-top: 10px; padding-top: 10px; padding-bottom: 10px; padding-left: 8px; padding-right:8px; border-top: thick double lightgrey;">';
            
            echo '<p> <span style="font-weight: bold;">Yazan: </span>';
            echo htmlentities($kayit["Ad"]);
            echo " ";
            echo htmlentities($kayit["Soyad"]);
            echo " </p>";
            echo '<p> <span style="font-weight: bold;">Yorum: </span>';
            echo htmlentities($kayit["metin"]);
            echo '</p>';
            echo '<p> <span style="font-weight: bold;">Zaman: </span>';
            echo $kayit["zaman"];
            echo '</p>'; 
         
            echo "</div>";
          }
          $vt = null;
           ?>

           
        </section>
    </body>

</html>