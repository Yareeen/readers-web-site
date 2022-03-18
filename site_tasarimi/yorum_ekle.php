<?php
session_start();
//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
    
include "include\js_mesaj.inc.php";

if (!isset($_SESSION["yetki"]) and $_SESSION["yetki"] == false) {
    jsmesaj_gonder("Önce giriş yapmalısınız!", "giris.php");
}

if (!isset($_POST["formyorum"])) {
    jsmesaj_gonder("Yorum yapmak için önce formu doldurunuz!", "kitap_elestirileri.php");
  }




//veritabanına bağlandık
include 'include\vt_baglan.inc.php';
  

// Sorgular ve diğer işlemler burada...

  $sql = "insert into yorum (uyeKod, elestiriKod , metin) 
  values (:uyeKod, :elestiriKod , :metin)"; 
  
  $ifade = $vt->prepare($sql);
  $ifade->execute(Array(":uyeKod"=>$_SESSION["Kod"], ":elestiriKod"=>$_POST["yorumkod"],
  ":metin"=>$_POST["txtCkeditor"]));
  //Bağlantıyı yok edelim...
  $vt = null;

  $adres="Location:detay.php?elestirininkodu=".$_POST["yorumkod"];
  header($adres);

?>
