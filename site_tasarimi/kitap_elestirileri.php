<?php
    session_start();
    //geliştirme aşamasında olduğumdan dlayı eror_reporting kısmı aktif değil.
    //error_reporting(0); 
    
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
include 'include\header.inc.php';
?>


        <div class="kitap_elestiri">
 
        <section>
            <article class="tablo_baslik">
        
                <div class="Resim_stn">Resim</div>
                <div class="Kitap_ismi_stn">Kitap İsmi</div>
                <div class="Elestirmen_stn">Eleştirmen</div>
               
               <!-- Giriş yapılmazsa işlem gözükmez. -->
                
              <?php if(isset($_SESSION["yetki"]) and $_SESSION["yetki"] == true){?>
                <div class="Islem"> İşlem </div>
                <?php   }?>
            </article>

   

                <?php
                    //veritabanına bağlandık
                   include 'include\vt_baglan.inc.php';

       


                    $sql = "select vt_elestiri.*, uye.Ad, uye.Soyad from uye inner join vt_elestiri on uye.Kod = vt_elestiri.elestirinin_sahibi"; 
                    //limit 2 koyarsan 2 tane gösterir.
                    $ifade = $vt->prepare($sql);
                    $ifade->execute(); 
                    
                    while ($kayit = $ifade->fetch(PDO::FETCH_ASSOC)) {
                        if(isset($_SESSION["yetki"]) and $_SESSION["yetki"] == true){
                        echo "<article class='tablo_satir'>\r\n";
                        echo "<div class='Resim_stn'>";
                        echo "<img class='kucukresim' src='";
                        echo $kayit["dosya"];//veritabanından dosya ismini aldık.
                        echo "'></div>";
                        echo "<a id='detaybaslik' href='detay.php?elestirininkodu=";
                        echo $kayit["kod"];
                        echo "' class='Kitap_ismi_stn'>";
                        echo htmlentities($kayit['baslik']);
                        echo "</a>";
                        echo "<div class='Elestirmen_stn'>";
                        echo htmlentities($kayit["Ad"]);
                        echo " ";
                        echo htmlentities($kayit["Soyad"]);
                        echo "</div>";
                        echo "<div class='Islem'>";
                        
                        if(isset($_SESSION["Kod"]) and $kayit["elestirinin_sahibi"]==$_SESSION["Kod"]){
                        
                        echo "<a class='guncelle_btn' href='duzelt_form.php?elestirikod="; 
                        echo $kayit["kod"];
                        echo "'>Güncelle </a> ";?>
                        <form action="duzelt.php" method="POST"> <!-- sil button halinde -->
                            <input type="hidden" name="silkod" value="<?php echo $kayit['kod'];?>">
                            <input type="submit" name="form" value="Sil" class='guncelle_btn'>
                        </form>

                  

                        <?php
                    
                        } else{
                            echo "İlan sahiplerine özel!";
                        }
                       /*echo "<div class='Islem'><a> <input type='button' value='İşlem'> </a>";*/
                      
                        echo "</div>";
                        
                        echo "</article>";
          
                    } 
                    //Giriş yapılmazs işlem gözükmez
                    else{

                        echo "<article class='tablo_satir'>\r\n";
                        echo "<div class='Resim_stn'>";
                        echo "<img class='kucukresim' src='";
                        echo $kayit["dosya"];//veritabanından dosya ismini aldık.
                        echo "'></div>";
                        echo "<a class='detayb' href='detay.php?elestirininkodu=";
                        echo $kayit["kod"];
                        echo "' class='Kitap_ismi_stn'>";
                        echo htmlentities($kayit['baslik']);
                        echo "</a>";
                        echo "<div class='Elestirmen_stn'>";
                        echo htmlentities($kayit["Ad"]);
                        echo " ";
                        echo htmlentities($kayit["Soyad"]);
                        echo "</div>";
                      //  echo "<div class='Islem'><a> <input type='button' value='İşlem'> </a>";
                        /*echo $kayit["fiyat"];*/
                        //echo "</div>";
                        
                        echo "</article>";
                    }




                        /*echo "<br/>";
                        print_r($kayit);*/
                      }
                      
                    $vt = null;


            ?>


    

        </section>


        </div>


      

        
       

      <!--   <div class="footer"></div>-->

    </div>


</body>

</html>