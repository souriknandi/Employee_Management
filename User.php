<h1><p align="center">
<?php
session_start();
error_reporting(0);

$email=$_POST['email'];
$password=$_POST['password'];


$serv="localhost:3306";
$user="root";
$pwd="";
$dt="project1";

$connection=new mysqli($serv,$user,$pwd,$dt);
$sql="select * FROM logs WHERE Email = '$email' AND Log_Password = '$password'";

$verify=mysqli_query($connection,$sql);
$total=mysqli_num_rows($verify);
if($total==1){
    $_SESSION['email'] = $email;
    header('location:http://localhost/Project1/Dash.php');
}
else{
    echo "<script> 
    alert ('Login Failed');
    </script>";
}
    
?>

