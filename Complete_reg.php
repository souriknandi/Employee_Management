<?php
session_start();
include "Connection.php";
error_reporting(0);

$userprofile = $_SESSION['email'];
if (!$userprofile) {
    header('location:http://localhost/Project1/User.html');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $college = $_POST['college'];
    $branch = $_POST['branch'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    // Function to check if email exists
function emailExists($email) {
    global $connection;

    $sql="select * FROM complete_info WHERE Email = '$email'";

    $verify=mysqli_query($connection,$sql);
    $total=mysqli_num_rows($verify);
    if($total==1){
        return true;
    }
    else{
        return false;
    }
}

    // Check if file was uploaded without errors
    if ($_FILES["pic"]["error"] == 4) {
        echo "<script>alert('Image Does Not Exist');</script>";
    } else {
        $fileName = $_FILES["pic"]["name"];
        $fileSize = $_FILES["pic"]["size"];
        $tmpName = $_FILES["pic"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } else if ($fileSize > 1000000) {
            echo "<script>alert('Image Size Is Too Large');</script>";
        } else {
            // Generate a unique name for the image
            $pic = uniqid() . '.' . $imageExtension;
            
            // Move the uploaded file to the specified directory
            move_uploaded_file($tmpName, 'Image/' . $pic);

            // Insert data into database
            if(!emailExists($email)){
                $sql = "INSERT INTO complete_info (Email, Name, College, Course, Contact, DOB, Pic) 
                    VALUES ('$email', '$name', '$college', '$branch', '$contact', '$dob', '$pic')";
                $insert = mysqli_query($connection, $sql);
            }
            else{
                echo "<script>
                        alert('User Already Exist');
                        window.location.assign('Dash.php');
                      </script>";
            }

                if ($insert) {
                     echo "<script>
                        alert('Registration Completed');
                        window.location.assign('Dash.php');
                      </script>";
                } else {
                    echo "<script>alert('Records failed to submit');</script>";
                }
            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <title>Complete Registration</title>
    <style>
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
    <link rel="stylesheet" href="Complete_registration.css?v=<?php echo time(); ?>">
</head>
<body>
    <p><a href="Dash.php"><button class=button>Back</button></a>
    <a href="index.html"><button class=button>Home</button></a></p>
<div class="main">
    <div class="container">
        <form class="form" action="http://localhost/Project1/Complete_reg.php" method="POST" autocomplete="off" enctype="multipart/form-data">
            <h2>Complete Your Registration</h2>
            <div class="input_field">
                <label id="email" for="email">Email</label>
                <input type="email" name="email" style="font-family: Georgia, 'Times New Roman', Times, serif;" id="email" value="<?php echo htmlspecialchars($userprofile);?>"required>
            </div>
            <div class="input_field">
                <label for="tname">Trainee Name</label>
                <input type="text" name="name" style="font-family: Georgia, 'Times New Roman', Times, serif;" id="name" required>
            </div>
            <div class="input_field">
                <label for="tcollegename">College Name</label>
                <input type="text" name="college" style="font-family: Georgia, 'Times New Roman', Times, serif;" id="cname" required>
            </div>
            <div class="input_field">
                <label for="tbranch">Branch</label>
                <select name="branch" id="branch" style="border:none; border-radius: 5px; width: 100%; padding: 15px; outline: none; margin-bottom: 5px; font-size: 16px; margin-right: 25px;" required>
                    <option value="select">Select</option>
                    <option value="Computer Science">Computer Science Engineering</option>
                    <option value="Computer Science and IT">Computer Science and Information Technology</option>
                    <option value="ECE">Electronics and Communication Engineering</option>
                    <option value="Mechanical">Mechanical Engineering</option>
                    <option value="Electrical">Electrical Engineering</option>
                    <option value="ECE">Civil Engineering</option>
                </select>
            </div>
            <div class="input_field">
                <label for="tcontact">Contact Number</label>
                <input type="number" name="contact" style="font-family: Georgia, 'Times New Roman', Times, serif;" id="tno" required>
            </div>
            <div class="input_field">
                <label for="dob">Date Of Birth</label>
                <input type="date" name="dob" style="font-family: Georgia, 'Times New Roman', Times, serif;" id="dateofbirth" required>
            </div>
            <div class="input_field">
                <label for="tphoto">Photo</label>
                <input class="photo" type="file" name="pic" id="pic" accept=".jpg, .jpeg, .png" required>
            </div>
            <div style="text-align: center;">
            <input style="width:200px;height:50px"type="submit" value="Register" class="Sign_Up">
        </div>
        </form>
    </div>
</div>
</body>
</html>
