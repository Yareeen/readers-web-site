<?php

session_start();
//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
    
include "include\js_mesaj.inc.php";

//Direkt olarak giriş yapmaya izin verme
if(!isset($_POST["oturum_ac"])){ //Formdan gelmiyorsa
//hata mesajı ve siteye yönlendirme 
if($kayit== false){//Böyle bir kullanici yoksa false değer verir.
    jsmesaj_gonder("Önce formu doldurunuz!","giris.php");

}    
}


include 'include\vt_baglan.inc.php';


$sql ="select * from uye where Kullanici_ismi = :Kullanici_ismi"; //tablonun adını yazdık.
//kullanici_ismi unique olduğu için tek bir değer gelecek ayrıca kayit formundakilerin
//hepsini almamıza gerek yok sadece kullanici_ismi yeterli.


$ifade = $vt->prepare($sql);
$ifade->execute(Array(":Kullanici_ismi"=>$_POST["Kullanici_ismi"]));

$kayit = $ifade->fetch(PDO::FETCH_ASSOC); //döngüye ihtiyacım yok çünkü sadece bir değer dönecek.
//kayit dizi olarak bilgiyi getirir. 

if($kayit== false) {//Böyle bir kullanici yoksa false değer verir.
    jsmesaj_gonder("Kullanıcı adı veya şifre hatalı.","giris.php");

}    

if(!password_verify ($_POST["Sifre"], $kayit["Sifre"]))//Sifreler farklıysa
{
//Alertle mesaj oluştur.
jsmesaj_gonder("Kullanıcı adı veya şifre hatalı.","giris.php");
}

$_SESSION["yetki"]=  true;

$_SESSION["Kullanici_ismi"]= $kayit["Kullanici_ismi"];
$_SESSION["Ad"]= $kayit["Ad"];
$_SESSION["Soyad"]= $kayit["Soyad"];
$_SESSION["Kod"]= $kayit["Kod"];


header("Location: kitap_elestirileri.php");

echo "<pre>";
    print_r($kayit);
  var_dump($kayit);//kayit hakkında bize bilgi verir.
//Sonucu yoksa false üretir.
  echo "</pre>";


$vt = null;


?>