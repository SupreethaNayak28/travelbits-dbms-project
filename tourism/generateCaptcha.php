<?php
session_start();

// Generate a new captcha
$captchaChars = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
$captcha = substr($captchaChars, 0, 6); // Adjust the length as needed

// Store the new captcha in the session for validation
$_SESSION['captcha'] = $captcha;

// Return the captcha for display
echo $captcha;
?>
