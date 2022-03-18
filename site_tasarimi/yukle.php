<?php
session_start();
//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
      
$_SESSION["kitap_ismi"] = $_POST["kitap_ismi"];
$_SESSION["elestiri"] = $_POST["aciklama"];

include "include\js_mesaj.inc.php";

if (!isset($_SESSION["yetki"]) and $_SESSION["yetki"] == false) {
    jsmesaj_gonder("Önce giriş yapmalısınız!", "giris.php");
}


if(!isset($_POST["kitap_ismi"]) or strlen($_POST["kitap_ismi"])<4){
  jsmesaj_gonder("Başlık 4 karakterden az olamaz!", "kitap_elestirisi_ekle.php");
  
}

if(!isset($_POST["aciklama"]) or strlen($_POST["aciklama"])<20){
  jsmesaj_gonder("Eleştiri 20 karakterden az olamaz!", "kitap_elestirisi_ekle.php");
}/*else{
  $aciklama= trim($_POST["aciklama"]);
}*/

// Formdan geldiği halde önce çok büyük boyutta bir dosya mı yüklüyor buna bakalım
if (isset($_GET["formdangeldi"]) and !isset($_POST["formdangelen"])) {
  jsmesaj_gonder("Yüklemeye çalıştığınız dosya boyutu çok büyük!", "kitap_elestirisi_ekle.php");
}

if (!isset($_POST["formdangelen"])) {
    jsmesaj_gonder("Yükleme yapmak için önce yükle formu doldurunuz!", "kitap_elestirisi_ekle.php");
  }





//Dosya yüklerken hata oluştu mu?
if ($_FILES["yuklenenDosya"]["error"] != 0) {
    jsmesaj_gonder("Dosya yüklerken bir hata oluştu!", "kitap_elestirisi_ekle.php");
  }
  
  // Yüklenen resim dosyası mı kontrol et!
  // Yüklenen dosyanın tipi ile izin verilen dosya tiplerini karşılaştır.
  if ($_FILES["yuklenenDosya"]["type"] == "image/png" or $_FILES["yuklenenDosya"]["type"] == "image/jpeg") {
    // devam edecek
  } else {
    jsmesaj_gonder("Yükleyeceğiniz dosya bir resim dosyası olmalıdır!", "kitap_elestirisi_ekle.php");
  }





$hedefKlasor = "kullanicilarin_yukledikleri/"; 
$hedefKlasor .= time(); //aynı isimde resim yüklenmesine çözüm üretir.
$hedefKlasor = $hedefKlasor.basename($_FILES['yuklenenDosya']['name']);  
//basename ile sadece dosyanın ismi alınıyor. 
//Farklı işletim sistemlerinde basename kullanılmadığında sıkıntı oluşturabiliyor.

if (move_uploaded_file($_FILES['yuklenenDosya']['tmp_name'], $hedefKlasor)) 
{ 
	//echo basename( $_FILES['yuklenenDosya']['name'])." ismindeki dosya başarı ile yüklendi."; 
}else{ 
  jsmesaj_gonder("Dosya yükleme işleminde bir hata oluştu!", "kitap_elestirisi_ekle.php");

} 


//veritabanına bağlandık
include 'include\vt_baglan.inc.php';
  

// Sorgular ve diğer işlemler burada...

  $sql = "insert into vt_elestiri (baslik, elestiri, dosya, elestirinin_sahibi) 
  values (:baslik, :elestiri, :dosya, :elestirinin_sahibi)"; 
  //Kod otomatik artan olduğu için uye tablosunun içinde yer belirlemedik.
  
  $ifade = $vt->prepare($sql);
  $ifade->execute(Array(":baslik"=>$_POST["kitap_ismi"], ":elestiri"=>$_POST["aciklama"],
  ":dosya"=>$hedefKlasor, ":elestirinin_sahibi"=>$_SESSION["Kod"]));
  //Bağlantıyı yok edelim...
  $vt = null;

  jsmesaj_gonder("Eleştiri başarıyla eklendi.","kitap_elestirileri.php");


?>
