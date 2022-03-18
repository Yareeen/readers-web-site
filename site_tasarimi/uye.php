<?php
session_start();
//geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
//error_reporting(0); 
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="uye.css">
    <link rel="shortcut icon" href="kullanilan_resimlerin_klasoru\a_booka.png">

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
    ?>

        </div>

        <div style="padding-bottom: 12px" class="content">
            <img src="kullanilan_resimlerin_klasoru\add-user.png" alt="" title="Üye Ol">
            <form id="uye_formu" action="Kayit_kontrol.php" form method="post">
            

               <div class="yatay_flex">
                <input type="text" id="isim" name="Ad" placeholder="Adınız" required>
                <input type="text" id="soyisim" name="Soyad" placeholder="Soyadınız" required>
                </div>
             
                <input type="email" id="email" name="Mail" placeholder="Mailiniz" required>

            
                <input type="text" id="kullanici_isim" name="Kullanici_ismi" placeholder="Kullanıcı İsminiz" required>

                <div class="yatay_flex">
                    <input type="password" name="Sifre1" placeholder="Şifreniz" required>
                    <input type="password" name="Sifre2" placeholder="Şifreniz (Tekrar)" required>
                </div>

                <label for="Dogum_tarihi">Doğum Tarihiniz</label>
                <input type="date" id="Dogum_tarihi" name="Dogum_tarihi" required>

                <label for="Dogum_yeri">Doğum Yeriniz</label>
               
               <?php   include 'include\vt_baglan.inc.php';

                $sql5 = "select * from sehir"; 
          
                $ifade5 = $vt->prepare($sql5);
                $ifade5->execute();  
                ?>

                <select name="Dogum_yeri" id="Dogum_yeri"required >
                <option value="0">------</option>
  <!-- 81 kere yazmaktan bizi kurtardı. -->
                <?php  while ($kayit5 = $ifade5->fetch(PDO::FETCH_ASSOC)) {  ?>
                    <option value='<?php echo $kayit5["plaka"]?>'><?php echo $kayit5["sehir"]?></option>
                    <?php }      $vt = null;?>    ?>
            

                </select>
               
                <input type="submit" id="uye_ol"  value="Üye Ol" name="formdangelen">

            </form>
       
            <?php  if(isset($_SESSION["hata"])) {?>
                <p style="color:red; margin-bottom: 3px; font-weight:bold"> <?php  echo $_SESSION["hata"]; unset($_SESSION["hata"])?></p>
            <?php  }?>

        </div>

        <div class="footer"></div>

    </div>


</body>

</html>