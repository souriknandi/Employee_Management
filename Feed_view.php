<?php
session_start();
require 'Connection.php';
$userprofile = $_SESSION['email'];
if($userprofile == true){

}
else{
    header('location:http://localhost/Project1/Admin.html');

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Check your details</title>
    <style>
         body{
          background-image: url("desktop-wallpaper-dark-green-shine-plain-full-black-shine-thumbnail.jpg");
          background-size: cover;
            
        }
        table{
          background-image: url("desktop-wallpaper-dark-green-shine-plain-full-black-shine-thumbnail.jpg");
          background-size: cover;
        }
        .user_dashboard button{
            background-color: azure;
            border-radius: 5px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            font-size:20px;
            height:40px;
            cursor: pointer;
            border: none;
            outline: none;
            margin-top:30px;
       
        }
        .user_dashboard button:hover{
          background-color:  rgb(255,6,110);
        }
        .user_dashboard{
        color:black;
        }
        td{
          color:azure;
        }
        h1{
          color:azure;
        }
    </style>
  </head>
  <body>
  <h1 align="center">View Feedbacks</h1>  
  <hr>
  <p>
  <center><table border="1" cellspacing="5">
      <tr>
        <td>Email</td>
        <td>Feedback_1</td>
        <td>Feedback_2</td>
        <td>Feedback_3</td>
        <td>Remark</td>
      </tr>
      <?php
      $email = mysqli_real_escape_string($connection, $_SESSION['email']);
      $i = 1;
      $rows = mysqli_query($connection, "SELECT * FROM feedback");
      if(!$rows) {
        die("Database query failed."); // Replace with proper error handling
    }
    $row = mysqli_fetch_all($rows, MYSQLI_ASSOC);

      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
       
        <td><?php echo $row["Email"]; ?></td>
        <td><?php echo $row["Feedback_1"]; ?></td>
        <td><?php echo $row["Feedback_2"]; ?></td>
        <td><?php echo $row["Feedback_3"]; ?></td>
        <td><?php echo $row["Remarks"]; ?></td>
      </tr>
      
      <?php endforeach; ?>
    </table>
    <br>
    <a href="Dash2.php" class="user_dashboard"><button>Admin Dashboard</button></a>

  </body>
</html>