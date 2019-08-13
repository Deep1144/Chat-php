<?php
$roomname = $_GET['roomname'];
include 'db.php';
$sql = "SELECT * FROM rooms WHERE roomname = '$roomname'";
$result = mysqli_query($conn, $sql);
if ($result) {
    if (mysqli_num_rows($result) == 0) {
        echo "<script>";
        echo "alert('room does not exsits');";
        echo "window.location = '$loc';";
        echo "</script>";
    }
} else {
    echo "ERROR : " . mysqli_error($conn);
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        body {
            margin: 0 auto;
            max-width: 800px;
            padding: 0 20px;
        }

        .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right: 0;
        }

        .time-right {
            float: right;
            color: #aaa;
        }

        .time-left {
            float: left;
            color: #999;
        }

        .anyclass {
            height: 500px;
            overflow-y: scroll;
        }
    </style>
</head>

<body>

    <h2><?php echo $roomname ?></h2>

    <div class="container">
        <div class="anyclass">

        </div>
    </div>




    <input type="text" name="usermsg" class="form-control" id="usermsg" placeholder="message"><br>
    <button class="btn btn-primary" name="submitmsg" id='submitmsg'>Send</button>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        setInterval(runFunction, 200);

        function runFunction() {
            $.post("display_msg.php", {
                    room: '<?php echo $roomname ?>'
                },
                function(data, status) {
                    document.getElementsByClassName('anyclass')[0].innerHTML = data;
                }
            )
        };




        var input = document.getElementById("usermsg");


        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("submitmsg").click();
            }
        });


        $("#submitmsg").click(function() {
            var clientmsg = $("#usermsg").val();
            $.post(
                "postmsgs.php", {
                    text: clientmsg,
                    room: "<?php echo $roomname ?>",
                    ip: "<?php echo $_SERVER['REMOTE_ADDR'] ?>",
                },
                function(data, status) {
                    document.getElementsByClassName("anyclass")[0].innerHTML = data;
                }
            );
            $("#usermsg").val("");
            return false;
        });
    </script>






</body>

</html>