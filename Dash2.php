<?php
session_start();
//echo "Welcome ".$_SESSION['email'];
?>
<?php
include "Connection.php";
error_reporting(0);

$userprofile = $_SESSION['email'];

if($userprofile == true){

}
else{
    header('location:http://localhost/Project1/Admin.html');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       body{
        background-image: url("desktop-wallpaper-dark-green-shine-plain-full-black-shine-thumbnail.jpg");
            background-size: cover;
            
       } 
       .button{
            border-radius: 12px;
            background-color: #5EF1D0;
            font-family:'Times New Roman', Times, serif;
            font-size: 20px;
            float:left;
            margin-right:10px;
            width: 240px;
            height:70px;
        }
        .image{
            float:right;
            min-height:50vh;
        }
     
    </style>    
</head>
<body>
        <div class="middle-section" style="color:white; text-align:center;">
        <?php echo "Welcome ".$_SESSION['email']; ?> 
        <hr>
        </div>
        <a href="Feed_view.php"><button class=button>View Feedbacks</button></a>
        <a href="Detail_view.php"><button class=button>View User Details</button></a>
        <a href="Logout2.php"><button class=button>Logout</button></a>
        
    </div>
        <div class=image>
        <img src="Pic\image.png" alt="Man wearing suit">
      </div>
</body>
</html>
<?php
include "Connection.php";
error_reporting(0);

$userprofile = $_SESSION['email'];

if($userprofile == true){

}
else{
    header('location:http://localhost/Project1/Admin.html');

}
?>