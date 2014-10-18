<?php                        
session_start();// Starting Session

$login_session = $_SESSION['login_user'];

if(!isset($login_session)){
    header('Location: index.php');//Redirecting to home page 
}
?>