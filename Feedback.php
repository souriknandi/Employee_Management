<?php
session_start();

// Include database connection file
include "Connection.php";

// Suppress error reporting for production, but enable during development
// error_reporting(0);

$userprofile = $_SESSION['email'];

if (!$userprofile) {
    header('Location: http://localhost/Project1/User.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $feed1 = $_POST['feed1'];
    $feed2 = $_POST['feed2'];
    $feed3 = $_POST['feed3'];
    $comment = $_POST['comment'];

    // Database connection details
    $serv = "localhost:3306";
    $user = "root";
    $pwd = "";
    $dt = "project1";

    // Establish connection
    $connection = new mysqli($serv, $user, $pwd, $dt);

    function emailExists($email){
        global $connection;

        $sql="select * FROM feedback WHERE Email = '$email'";

        $verify=mysqli_query($connection,$sql);
        $total=mysqli_num_rows($verify);
        if($total==1){
            return true;
        }
        else{
            return false;
        }
    }

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if(!emailExists($email)){
        $sql = "INSERT INTO feedback (Email, Feedback_1, Feedback_2, Feedback_3, Remarks) VALUES ('$email', '$feed1', '$feed2', '$feed3', '$comment')";

        $insert = $connection->query($sql);
    }
    else{
        echo "<script>
            alert('Feedback Already Exists');
            window.location.assign('Dash.php');
            </script>";
    }
    

    if ($insert) {
        echo "<script>
                alert('Feedback Recorded');
                window.location.assign('Dash.php');
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    // Close the connection
    $connection->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        /* Your existing styles here */
        
        body{
            background-image: url("desktop-wallpaper-dark-green-shine-plain-full-black-shine-thumbnail.jpg");
            background-size: cover;
            
        }
        .main{
            display:flex;
            align-items: center;
            justify-content: center;
            min-height: 50vh;
        }
        .container{
            position: relative;
            border-radius: 20px;
            background-color: aquamarine;
            width:80%;
            max-width:400px;
            box-shadow:0 0 5px #E7F7F4;
            margin-top: 7vh;
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 30px;
            padding-bottom: 50px;
        }
        h2{
            font-size: 30px;
            color:#073727;
            text-align: center;
        }
        .input_field{
            position: relative;
            margin:30px;
            border-bottom: 2px solid white;
        }
        .input_field label{
            font-size: 20px;
            color:#073727;
            pointer-events: none;
        }
        .input_field input{
            width:300px;
            height:20px;
            font-size: 16px;
            color:#073727;
            padding:0 5px;
            background:transparent;
            border: none;
            outline:none;
        }
        .Sign_Up{
            position: relative;
            width:100%;
            height:40px;
            background: rgb(241,238, 240);
            font-size: 18px;
            color:black;
            cursor:pointer;
            border-radius:30px;
            border:none;
            outline:none;
            align-items: center;
            justify-content: center;
        }
        .Sign_Up:hover{
            background-color: rgb(255,6,110);
            color:white;
        }
        .button{
            border-radius:5px;
            background-color: #5EF1D0;
            font-family:'Times New Roman', Times, serif;
            font-size:16px;
        }
    </style>
</head>
<body>
<p><a href="Dash.php"><button class=button>Back</button></a>
<a href="index.html"><button class=button>Home</button></a></p>
<div class='main'>
    <div class='container'>
        <h2>Feedback:</h2>
        <form action="Feedback.php" method="post">
            <div class='input_field'>
                <label for="email">Email:</label>
                <input type="text" id="email" style="font-family: Georgia, 'Times New Roman', Times, serif;" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
            </div>
            <div class='input_field'>
                <label for="feed1">Feedback 1:</label>
                <input type="text" id="feed1" style="font-family: Georgia, 'Times New Roman', Times, serif;" name="feed1" required>
            </div>
            <div class='input_field'>
                <label for="feed2">Feedback 2:</label>
                <input type="text" id="feed2" style="font-family: Georgia, 'Times New Roman', Times, serif;" name="feed2" required>
            </div>
            <div class='input_field'>
                <label for="feed3">Feedback 3:</label>
                <input type="text" id="feed3" style="font-family: Georgia, 'Times New Roman', Times, serif;" name="feed3" required>
            </div>
            <div class='input_field'>
                <label for="comment">Remarks:</label>
                <textarea name="comment" required></textarea>
            </div>
            <input type="submit" value="Submit And Logout" class="Sign_Up">
        </form>
    </div>
</div>
</body>
</html> 