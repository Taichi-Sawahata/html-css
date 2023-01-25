
<?php 
session_start();
if(isset($_SESSION['id'])){
    //unset 指定した変数を破棄
    unset($_SESSION['id']);
}
header('Location: logn.php');
?>