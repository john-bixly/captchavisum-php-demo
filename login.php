<?php
define(CAPTCHA_API, "http://captchavisum.bixly.com/api/");
define(CHALLENGE_API, CAPTCHA_API . "challenge/");
define(VERIFY_API, CAPTCHA_API . "verify/");
define(API_KEY, "6dd4075bd4634f86a42ae648c7e5c59e");
define(PRIVATE_KEY, "dbc551f4b231459daaef459cc4441bd2");

include('utils.php');

session_start();//starting session
$error=''; //variable to store error message

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid"; 
    }
    else {
        // prepare post variables
        $username=$_POST['username'];
        $password=$_POST['password'];
        $challenge=$_POST['challenge'];
        $site=$_POST['site'];
        $challenge_response=$_POST['challenge_response'];

        // verify challenge: post request
        $post  = array (
            'challenge' => $challenge,
            'challenge_response' => $challenge_response,
            'private_key' => PRIVATE_KEY,
            'remote_ip' => get_ip(), //pass client's IP
        );
        $result = verify_api($post);

        // if failed
        if ($result!='true') {
            $error = $result; 
        }
        else{
            // verified
            // login user here
            $_SESSION['login_user']=$username;//Initializing Session
            header("location: profile.php");//Redirecting to other page 
        }
    }
}
?>