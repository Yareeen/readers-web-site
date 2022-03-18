<?php
// Veri tabanına bağlanalım...
try {
  $vt = new PDO("mysql:dbname=readers;host=localhost;charset=utf8","root", "");
  $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}

?>