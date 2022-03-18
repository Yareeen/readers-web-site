<?php
session_start();
//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
    

session_destroy(); //oturumu sonlandırır.
$_SESSION=null; //olası bugların önüne geçer.

header("Location: giris.php");
?>