<?php
$room = $_POST['room'];

include "db.php";

$sql = "SELECT msg,stime,ip from msgs WHERE room = '$room'";

$result = mysqli_query($conn ,$sql);
$html_content = "";
$res = "";
if($result){
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            
		$res = $res .'<div class="container">';
		$res = $res . $row['ip'];
		$res = $res . "Says : <p>" . $row['msg'];
		$res = $res . '</p> <span class="time-right">' .$row["stime"] . "</span></div>";
    }
}}
echo $res;
mysqli_close($conn);

?>