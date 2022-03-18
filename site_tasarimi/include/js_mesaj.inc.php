<?php

function jsmesaj_gonder($mesaj,$adres){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('$mesaj');
    window.location.href='$adres';
    </script> ");
    exit;
}

?>