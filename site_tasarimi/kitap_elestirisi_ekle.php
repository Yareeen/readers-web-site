<?php
    session_start();
    //geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
   // error_reporting(0); 
    
    include "include\js_mesaj.inc.php";
    
    if (!isset($_SESSION["yetki"]) and $_SESSION["yetki"] == false) {
        jsmesaj_gonder("Eleştiri eklemek için giriş yapmalısınız!", "giris.php");
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

<body>

    <div id="container">

    <?php
    include "include\aramasiz_header.inc.php";
    ?>

        </div>


        <div class="elestiri">
        <main>
            <h1> Kitap Eleştirini Ekle </h1>
            <form enctype="multipart/form-data" action="yukle.php?formdangeldi=1" method="POST"> 
                
                <?php  if(isset($_SESSION["kitap_ismi"])){   ?>
                    
                   <input type="text" name="kitap_ismi" id="kitap_ismi" value="<?php echo $_SESSION["kitap_ismi"]; unset($_SESSION["kitap_ismi"]); ?>" required>  
                <?php  } else{?>
                <input type="text" name="kitap_ismi" id="kitap_ismi" placeholder="Kitabın ismini giriniz." required> 
                <?php  }?>
               
                <input name="yuklenenDosya" type="file" required>
                <label for="aciklama">Kitap Eleştirinizi Giriniz. </label>
                  
                <?php  if(isset($_SESSION["elestiri"])){   ?>
                    <textarea style="color:white" rows="9" name="aciklama" id="aciklama" required><?php echo $_SESSION["elestiri"]; unset($_SESSION["elestiri"]);?></textarea>
                <?php  } else{?>
                    <textarea  style="color:white" rows="9" name="aciklama" id="aciklama" required></textarea>
                <?php  }?>
                <input type="submit" id="elestiri_yukle" value="Yükle" name="formdangelen">
            </form> 

        </main>


        </div>


      

        
       

      <!--   <div class="footer"></div>-->

    </div>


</body>

</html>