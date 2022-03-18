<?php
session_start();
//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
    
include "include\js_mesaj.inc.php";

if (!isset($_SESSION["yetki"]) and $_SESSION["yetki"] == false) {
    jsmesaj_gonder("Önce giriş yapmalısınız!", "giris.php");
}
  
if (!isset($_POST["form"])) {
    jsmesaj_gonder("Önce eleştiri seçmelisiniz!", "kitap_elestirileri.php");
  }
  



//veritabanına bağlandık
include 'include\vt_baglan.inc.php';

$duzelt_adres="duzelt_form.php?elestirikod=".$_POST["kod"];

if(isset($_POST["kod"])){
  if(!isset($_POST["kitap_ismi"]) or strlen($_POST["kitap_ismi"])<4){
    jsmesaj_gonder("Başlık 4 karakterden az olamaz!", "$duzelt_adres");
    }
    
    if(!isset($_POST["aciklama"]) or strlen($_POST["aciklama"])<20){
      jsmesaj_gonder("Eleştiri 20 karakterden az olamaz!", "$duzelt_adres");
    }
// Sorgular ve diğer işlemler burada...
  
  $sql = "update vt_elestiri set baslik = :baslik, elestiri=:elestiri where kod = :kod"; 
  //Kod otomatik artan olduğu için uye tablosunun içinde yer belirlemedik.
  
  $ifade = $vt->prepare($sql);
  $ifade->execute(Array(":baslik"=>$_POST["kitap_ismi"], ":elestiri"=>$_POST["aciklama"],
   ":kod"=>$_POST["kod"]));
  //Bağlantıyı yok edelim...
  $vt = null;

  jsmesaj_gonder("Eleştiri başarıyla güncellendi.","kitap_elestirileri.php");
}

/*sil*/
else{
  /*eleştiriyi silebilmek için önce favorileri silmek gerekir. Çünkü arada yabancı anahtar var.*/
  $sql2 ="DELETE FROM `begeni` WHERE elestiriKod=:elestiriKod";
 
  $ifade2 = $vt->prepare($sql2);
  $ifade2->execute(Array(":elestiriKod"=>$_POST["silkod"]));
  //Bağlantıyı yok edelim...
  $vt = null;

/*eleştiriyi silebilmek için önce yorumları silmek gerekir. Çünkü arada yabancı anahtar var.*/


include 'include\vt_baglan.inc.php';


  $sql3 ="DELETE FROM `yorum` WHERE  elestiriKod=:elestiriKod";
 
  $ifade3 = $vt->prepare($sql3);
  $ifade3->execute(Array(":elestiriKod"=>$_POST["silkod"]));
  //Bağlantıyı yok edelim...
  $vt = null;



  include 'include\vt_baglan.inc.php';



  $sql ="DELETE FROM `vt_elestiri` WHERE kod=:kod";
 
  $ifade = $vt->prepare($sql);
  $ifade->execute(Array(":kod"=>$_POST["silkod"]));
  //Bağlantıyı yok edelim...
  $vt = null;

  jsmesaj_gonder("Eleştiri başarıyla silindi.","kitap_elestirileri.php");
}


?>