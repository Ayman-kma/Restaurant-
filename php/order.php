<?php
$redirect = $_GET["back"];
setcookie("recent-bought", $_COOKIE["cart"] , time() + (86400 * 30), "/");
setcookie("cart", "", time() + (86400 * 30), "/");
header("Location: /index.php".$redirect);
?>