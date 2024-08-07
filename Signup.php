<h1><p align="center">
<?php
error_reporting(0);

$email=$_POST['email'];
$npassword=$_POST['npassword'];
$cpassword=$_POST['cpassword'];




$serv="localhost:3306";
$user="root";
$pwd="";
$dt="project1";

$connection=new mysqli($serv,$user,$pwd,$dt);


if ($npassword === $cpassword) {
    // Passwords match, insert into database
    //$hashed_password = password_hash($npassword, PASSWORD_DEFAULT); // Hash the password for security

    $sql = "INSERT INTO logs (Email,Log_Password) VALUES ('$email','$npassword')";

    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
        header("location:http://localhost/Project1/index.html");
    } 
    else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
} 
else {
    
    header("location:http://localhost/Project1/Signup.php");
    echo "Passwords do not match";
}

?>

