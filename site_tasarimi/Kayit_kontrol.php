<?php

session_start();
//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
    

include 'include\vt_baglan.inc.php';
include "include\js_mesaj.inc.php";

//Giriş yapmış kişi bu sayfayı göremez.
if (isset($_SESSION["yetki"]) and $_SESSION["yetki"] == true) {
  jsmesaj_gonder("Lütfen önce çıkış yapın.", "kitap_elestirileri.php");
}

if (!isset($_POST["formdangelen"])) {
  jsmesaj_gonder("Üye olma sayfasına yönlendiriliyorsunuz", "uye.php");
}



if($_POST["Sifre1"]!=$_POST["Sifre2"]){
  jsmesaj_gonder("Şifreler uyumsuz, lütfen tekrar deneyin","uye.php");
}



// Şifre istenilen formatta mı?
//Şifre, en az bir tane büyük harf, küçük harf, rakam içermelidir ve 6 karakterden fazla olmalıdır.
if(strlen($_POST["Sifre1"])<6  
 or (!preg_match("@[A-ZİĞÜÖŞÇ]+@",$_POST["Sifre1"]))//Türkçe karakterleri ekledim İ, Ğ, Ü, Ö, Ş, Ç 
 or (!preg_match("@[a-zöçşğüı]+@",$_POST["Sifre1"])) //Türkçe karakterleri ekledim öçşğüı
 or (!preg_match("@[0-9]+@",$_POST["Sifre1"]))
){
  jsmesaj_gonder("Şifre, en az bir tane büyük harf, küçük harf, rakam içermelidir ve 6 karakterden fazla olmalıdır.","uye.php");

}

$Sifre= password_hash($_POST["Sifre1"], PASSWORD_DEFAULT); //şifremizi kriptoladık.

include 'include\vt_baglan.inc.php';
$sql1 ="select * from uye where Kullanici_ismi = :Kullanici_ismi"; //tablonun adını yazdık.
//kullanici_ismi unique olduğu için tek bir değer gelecek ayrıca kayit formundakilerin
//hepsini almamıza gerek yok sadece kullanici_ismi yeterli.

/*kullanıcı adı daha önce alınmış mı?*/
$ifade1 = $vt->prepare($sql1);
$ifade1->execute(Array(":Kullanici_ismi"=>$_POST["Kullanici_ismi"]));


$kayit1 = $ifade1->fetch(PDO::FETCH_ASSOC); //döngüye ihtiyacım yok çünkü sadece bir değer dönecek.
//kayit dizi olarak bilgiyi getirir. 

if($kayit1!=false) {//Böyle bir kullanici yoksa false değer verir.
    header("Location: uye.php");
    $_SESSION["hata"]="Bu kullanıcı adı daha önce alınmış.";
} 

/*mail daha önce alınmış mı?*/
include 'include\vt_baglan.inc.php';
$sql2="select * from uye where Mail = :Mail"; //tablonun adını yazdık.

$ifade2 = $vt->prepare($sql2);
$ifade2->execute(Array(":Mail"=>$_POST["Mail"]));


$kayit2 = $ifade2->fetch(PDO::FETCH_ASSOC); //döngüye ihtiyacım yok çünkü sadece bir değer dönecek.
//kayit dizi olarak bilgiyi getirir. 

if($kayit1!=false) {//Böyle bir kullanici yoksa false değer verir.
    header("Location: uye.php");
    $_SESSION["hata"]="Bu kullanıcı adı daha önce alınmış.";
} else if($kayit2!=false){
  header("Location: uye.php");
  $_SESSION["hata"]="Bu maille daha önce hesap açılmış.";
}
else{

// Sorgular ve diğer işlemler burada...
//uye, tablomuzun adı. 
$sql = "insert into uye (Ad, Soyad, Mail, Kullanici_ismi, Sifre, Dogum_tarihi, Dogum_yeri) 
values (:Ad, :Soyad, :Mail, :Kullanici_ismi, :Sifre, :Dogum_tarihi, :Dogum_yeri)"; 
//Kod otomatik artan olduğu için uye tablosunun içinde yer belirlemedik.

$ifade = $vt->prepare($sql);
$ifade->execute(Array(":Ad"=>$_POST["Ad"], ":Soyad"=>$_POST["Soyad"],
":Mail"=>$_POST["Mail"], ":Kullanici_ismi"=>$_POST["Kullanici_ismi"],":Sifre"=>$Sifre,
 ":Dogum_tarihi"=>$_POST["Dogum_tarihi"],":Dogum_yeri"=>$_POST["Dogum_yeri"] ));
//Bağlantıyı yok edelim...
$vt = null;

jsmesaj_gonder("Üye oldunuz. Giriş sayfasına yönlendiriliyorsunuz.","giris.php");
}   
?>

