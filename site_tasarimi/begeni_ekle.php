<?php
    session_start();
    //geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
    //error_reporting(0); 
    
    include "include\js_mesaj.inc.php";
    
    if (!isset($_SESSION["yetki"]) and $_SESSION["yetki"] == false) {
        jsmesaj_gonder("Bu sayfaya gidebilmek için giriş yapmalısınız!", "giris.php");
    }
    if (!isset($_POST["begen"])) {
        jsmesaj_gonder("Beğenmek için önce eleştiri seçiniz!", "kitap_elestirileri.php");
      }
    

      //veritabanına bağlandık
      include 'include\vt_baglan.inc.php';
        
      if(isset($_POST["begenkod"])){
      // Sorgular ve diğer işlemler burada...
      
        $sql = "insert into begeni (uyeKod, elestiriKod) 
        values (:uyeKod, :elestiriKod)"; 
        
        $ifade = $vt->prepare($sql);
        $ifade->execute(Array(":uyeKod"=>$_SESSION["Kod"], ":elestiriKod"=>$_POST["begenkod"]));
        //Bağlantıyı yok edelim...
        $vt = null;
      
        $adres="Location:detay.php?elestirininkodu=".$_POST["begenkod"];
        header($adres);

        }else{


        //dislikeeeee
      
        $sql = "delete from begeni where uyeKod = :uyeKod and elestiriKod = :elestiriKod";
 
        $ifade = $vt->prepare($sql);
        $ifade->execute(Array(":uyeKod"=>$_SESSION["Kod"], ":elestiriKod"=>$_POST["dislike"]));
        //Bağlantıyı yok edelim...
        $vt = null;
      
        $adres="Location:detay.php?elestirininkodu=".$_POST["dislike"];
        header($adres);

    }

      ?>
      
    

  


    


