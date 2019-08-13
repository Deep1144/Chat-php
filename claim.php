<?php
$room = $_POST['room'];
$password = $_POST['password'];
$loc  = 'http://localhost/chatapp';
if (strlen($room)<2) {
    echo "<script>";
    echo "window.alert('room name is to small please enter name > 2');";
    echo "window.location='$loc';";
    echo "</script>";
}
else{
    include 'db.php';
}

$sql = "SELECT *  FROM `rooms` WHERE `roomname` = '$room' AND `pass` = '$password'";
$result = mysqli_query($conn , $sql);


if($result){
    if(mysqli_num_rows( $result) > 0){
        //if room exsits do this 
        echo "<script>";
        echo "alert('room exsists forwarding there ...');";
        echo "window.location = '$loc/rooms.php?roomname=".$room."';";
        echo "</script>";
        echo "inserted";
    }

    else{
        // try to create a new room .
        $sql = "INSERT INTO `rooms` (`roomname`, `stime`, `pass`) VALUES ('$room', current_timestamp(), '$password')";
        $insert = mysqli_query($conn , $sql);
        if($insert){
            //if rrom created succesfully forward user to that room .
            echo "<script>";
            echo "alert('room does not exsits creating new');";
            echo "window.location = '$loc/rooms.php?roomname=".$room."';";
            echo "</script>";
            echo "inserted";
        }
        else{
            //if error in creating room display it .
            echo "error : ".mysqli_error($conn);
        }
    }
}


else{
    //if error in searching for room show it here.
    echo "ERROR : " .mysqli_error($conn);
}


?>