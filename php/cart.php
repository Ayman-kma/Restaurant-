<?php 
print_r($_GET);

$id =$_GET['id'];


$back_parameter=$_GET["back"];
//$back = $_GET['back'];
//header("location:".$back);
$cookie_name = "cart";
$cookie_value = $id;
if(!isset($_COOKIE[$cookie_name])) {
setcookie($cookie_name, $cookie_value."," , time() + (86400 * 30), "/");
} else {
    setcookie($cookie_name, $_COOKIE["cart"].$cookie_value."," ,time() + (86400 * 30), "/");
}

header('Location:'.$back_parameter);

?>
