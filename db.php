<?php
$server = 'localhost';
$user = 'root';
$db = 'chatapp';
$pass = '';
$loc  = 'http://localhost/chatapp';
$conn = mysqli_connect($server , $user ,$pass ,$db);
if(!$conn){
  die("Error : " .mysqli_connect_error());
}
?>