<?php
    $code = $_GET['code'];
    $password = $_GET['password'];

    if($code == "209618252" and $password == "pass") {
        echo "Usuario existente";
    } else {
        echo "EL usuario no existe";
    }
?>
