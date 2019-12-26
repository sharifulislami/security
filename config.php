<?php
$host     = "localhost"; // Database Host
$user     = "rahat_source"; // Database Username
$password = "[D_!L}vS2nn4"; // Database's user Password
$database = "rahat_source"; // Database Name
$prefix   = "security_"; // Database Prefix for the script tables

$connect = mysqli_connect($host, $user, $password, $database);

// Checking Connection
if (mysqli_connect_errno()) {
    echo "Failed to connect with MySQL: " . mysqli_connect_error();
}

mysqli_set_charset($connect, "utf8");

$client = "No";

$site_url             = "http://rahat.iqsademo.com";
$projectsecurity_path = "http://rahat.iqsademo.com/project";
?>