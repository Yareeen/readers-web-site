<div class="header">
            <div class="Marka_ismi">

                <a href="kitap_elestirileri.php"><img src="include\amblem.png" alt=""></a>

            </div>
            <div class="yonlendirme_link">
              
                <?php 
                   /* arama başlangıç*/
    
                   echo  '<form action="ara.php"id="ara" method="get">';
                   echo'<input type="text" placeholder="Aranacak ifadeyi giriniz." name="ifade" id="ara_input">';
                    echo '<input type="submit" value="Ara" id="ara_btn" name="ara">';
                    echo  ' </form>';
      
             /*arama bitiş */
                if (isset($_SESSION["yetki"]) and $_SESSION["yetki"] == true) {
                  
          
                    echo "<a href='kitap_elestirileri.php'>Kitap Eleştirileri</a>";
         
                    echo "<a href='kitap_elestirisi_ekle.php'>Kitap Eleştirisi Ekle</a>";
                    echo "<a href='Hakkımızda.php'>Hakkımızda</a>";
                    echo "<a href='profilim.php'>Profilim</a>";
                    echo "<a href='cikis.php'>Çıkış</a>";
                } else{

                ?>
                <a href='kitap_elestirileri.php'>Kitap Eleştirileri</a>
                <a href='Hakkımızda.php'>Hakkımızda</a>
                <a href="giris.php">Giriş Yap</a>
                <a href="uye.php">Üye Ol</a>
                
                <?php
                }

                ?>


            </div>
</div>