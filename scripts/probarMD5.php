<?php
$hash = password_hash("EdaAtnit", PASSWORD_BCRYPT);
echo $hash;

if (password_verify("EdaAtnit", $hash)) {
    echo "SI";
} else {
    echo "NO";
}
header("Location: ../views/home.php");
