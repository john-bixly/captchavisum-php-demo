<?php
include('login.php');//includes login script
?>
<html>
<head>
<title>CaptchaVisum PHP Demo</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div id="main">
        <h1>CaptchaVisum PHP Demo</h1>
        <div id="login">
            <h2>Login Form</h2>
            <hr/>
            <form action="" method="post">
                <label>UserName  :</label>
                <input type="text" name="username" id="name" placeholder="username"/><br /><br />
                <label>Password  :</label>
                <input type="password" name="password" id="password" placeholder="**********"/><br/><br />
                <!-- required div element with id 'captchavisum_widget_div' 
                where the challenge question will be placed -->
                <div id="captchavisum_widget_div"></div>
                <input type="submit" value=" Login " name="submit"/><br />
                <span><?php echo $error; ?></span>
            </form>
        </div>
        <!-- Right side div -->
        <div id="formget">
        </div>

    </div>

<!-- Challenge API. Pass your site's public key. -->
<script src="<?php echo CHALLENGE_API . '?key=' . API_KEY; ?>"></script>
</body>
</html>
