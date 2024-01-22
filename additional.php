<?php
include("signIn.html");
require("signinphp.php");
$sign = new signinphp();
$sign->signInFormVerifier();
$sign->signInRedirect();
exit();
?>