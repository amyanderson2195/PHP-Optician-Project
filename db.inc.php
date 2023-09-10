<?php
$host = "localhost";
$user = "root";
$password = "password"; //THIS IS A BAD IDEA IN A REAL LIFE SITUATION!!!!!! I'm only putting a plaintext password in this code for ease.
$con = new mysqli($host, $user, $password);

if(!$con){
    die("Failed to connect to database: ".mysql_connect_error());
}
?>