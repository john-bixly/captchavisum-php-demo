<?php
define(CAPTCHA_API, "http://localhost:8000/api/");
define(CHALLENGE_API, CAPTCHA_API . "challenge/");
define(VERIFY_API, CAPTCHA_API . "verify/");
define(API_KEY, "db48aec447e24caaa8fed3e64764f90f");
define(PRIVATE_KEY, "a2f0edab6a7941e38dcc65898a06fabc");

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
            'remote_ip' => '127.0.0.1', //pass client's IP
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, VERIFY_API);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec ($ch);

        curl_close ($ch);

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