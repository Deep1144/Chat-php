<?php

include 'db.php';

$text = $_POST['text'];
$ip = $_POST['ip'];
$room = $_POST['room'];

$sql = "INSERT INTO `msgs` (`msg`, `room`, `ip`, `stime`) VALUES ('$text', '$room', '$ip',current_timestamp)"; 

$result = mysqli_query($conn , $sql);
if($result){
    echo  " in post msgs";
}
else{
    echo "ERROR : " .mysqli_error($conn);
}
mysqli_close($conn);

?>