<?php

session_start();
//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
    
/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

include 'include\vt_baglan.inc.php';
include "include\js_mesaj.inc.php";


if (!isset($_SESSION["yetki"]) and $_SESSION["yetki"] == false) {
	jsmesaj_gonder("Önce giriş yapmalısınız!", "giris.php");
}

if (!isset($_POST["formdangelen"])) {
    jsmesaj_gonder("Önce resim yükleyiniz!", "profilim.php");
  }





$hedefKlasor = "profil/"; 
$hedefKlasor = $hedefKlasor.basename($_FILES['yuklenenDosya']['name']);  
//basename ile sadece dosyanın ismi alınıyor. 
//Farklı işletim sistemlerinde basename kullanılmadığında sıkıntı oluşturabiliyor.

if (move_uploaded_file($_FILES['yuklenenDosya']['tmp_name'], $hedefKlasor)) 
{ 
	echo basename( $_FILES['yuklenenDosya']['name'])." ismindeki dosya başarı ile yüklendi."; 
}else{ 
	echo "Bir hata oluştu!"; 
} 





// Sorgular ve diğer işlemler burada...
//uye, tablomuzun adı. 
$sql = "update uye set profil = :profil  where Kod = :Kod";

$ifade = $vt->prepare($sql);
$ifade->execute(Array(":profil"=>$hedefKlasor, ":Kod"=>$_SESSION["Kod"]));
//Bağlantıyı yok edelim...
$vt = null;


jsmesaj_gonder("Profil resmi değiştirildi!", "profilim.php");
?>