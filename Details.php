<?php
session_start();
require 'Connection.php';
$userprofile = $_SESSION['email'];
if($userprofile == true){

}
else{
    header('location:http://localhost/Project1/User.html');

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
  <h1 align="center">Check Your Details</h1>  
  <hr>
  <p>
  <center><table border="1" cellspacing="5">
      <tr>
        <td>Email</td>
        <td>Name</td>
        <td>College</td>
        <td>Branch</td>
        <td>Contact</td>
        <td>Date Of Birth</td>
        <td>Image</td>
      </tr>
      <?php
      $email = mysqli_real_escape_string($connection, $_SESSION['email']);
      $i = 1;
      $rows = mysqli_query($connection, "SELECT * FROM complete_info WHERE email = '$email' ");
      if(!$rows) {
        die("Database query failed."); // Replace with proper error handling
    }
    $row = mysqli_fetch_all($rows, MYSQLI_ASSOC);

      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
       
        <td><?php echo $row["Email"]; ?></td>
        <td><?php echo $row["Name"]; ?></td>
        <td><?php echo $row["College"]; ?></td>
        <td><?php echo $row["Course"]; ?></td>
        <td><?php echo $row["Contact"]; ?></td>
        <td><?php echo $row["DOB"]; ?></td>
        <td> <img src="Image/<?php echo $row["Pic"]; ?>" width = 100px height=100px title="<?php echo $row['Pic']; ?>"> </td>
      </tr>
      
      <?php endforeach; ?>
    </table>
    <br>
    <a href="Dash.php" class="user_dashboard"><button>User Dashboard</button></a>

  </body>
</html>