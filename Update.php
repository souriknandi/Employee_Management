<?php
session_start();
require 'Connection.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('location: http://localhost/Project1/Admin.html');
    exit();
}

// Fetch the user details
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($connection, $_GET['email']);

    // Prepare and execute the query to fetch the user details
    $query = "SELECT * FROM complete_info WHERE Email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found.";
        exit();
    }

    $stmt->close();
}

// Handle the form submission for updating user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $college = mysqli_real_escape_string($connection, $_POST['college']);
    $course = mysqli_real_escape_string($connection, $_POST['course']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $dob = mysqli_real_escape_string($connection, $_POST['dob']);

    // Optional: Handle file upload for the image
    if ($_FILES['pic']['name']) {
        $pic = $_FILES['pic']['name'];
        $target_dir = "Image/";
        $target_file = $target_dir . basename($_FILES["pic"]["name"]);

        // Upload file
        if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
            // Update record with new image
            $update_query = "UPDATE complete_info SET Email=? ,Name = ?, College = ?, Course = ?, Contact = ?, DOB = ?, Pic = ? WHERE Email = ?";
            $stmt = $connection->prepare($update_query);
            $stmt->bind_param("ssssssss", $email,$name, $college, $course, $contact, $dob, $pic, $email);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        // Update record without changing the image
        $update_query = "UPDATE complete_info SET Email=?, Name = ?, College = ?, Course = ?, Contact = ?, DOB = ? WHERE Email = ?";
        $stmt = $connection->prepare($update_query);
        $stmt->bind_param("sssssss", $email,$name, $college, $course, $contact, $dob, $email);
    }

    if ($stmt->execute()) {
        echo "Record updated successfully.";
        header('Location: Detail_view.php'); // Redirect to the list page
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            background-image: url("desktop-wallpaper-dark-green-shine-plain-full-black-shine-thumbnail.jpg");
            background-size: cover;
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
            margin-top: 5vh;
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
            font-size: 16px;
            color:#073727;
            pointer-events: none;
        }
        .input_field input{
            width:300px;
            height:40px;
            font-size: 16px;
            color:#073727;
            padding:0 5px;
            background:transparent;
            border: none;
            outline:none;
        }
        .Login{
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
        .Login:hover{
            background-color: rgb(255,6,110);
            color:white;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Update User</h2>
    <form action="Update.php" method="post" enctype="multipart/form-data">
        <div class="input_field">
        <label for="email">Email:</label>
        <input type="email" name="email" style="font-family: Georgia, 'Times New Roman', Times, serif;" value="<?php echo htmlspecialchars($user['Email']); ?>">
        </div>
        <div class="input_field">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" style="font-family: Georgia, 'Times New Roman', Times, serif;" value="<?php echo htmlspecialchars($user['Name']); ?>" required>
        </div>

        <div class="input_field">
        <label for="college">College:</label>
        <input type="text" id="college" name="college" style="font-family: Georgia, 'Times New Roman', Times, serif;" value="<?php echo htmlspecialchars($user['College']); ?>" required>
        </div>

        <div class="input_field">
        <label for="course">Branch:</label>
        <input type="text" id="course" name="course" style="font-family: Georgia, 'Times New Roman', Times, serif;" value="<?php echo htmlspecialchars($user['Course']); ?>" required>
    </div>

      <div class="input_field">  
        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" style="font-family: Georgia, 'Times New Roman', Times, serif;" value="<?php echo htmlspecialchars($user['Contact']); ?>" required>
    </div>

    <div class="input_field">    
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob"style="font-family: Georgia, 'Times New Roman', Times, serif;"  value="<?php echo htmlspecialchars($user['DOB']); ?>" required>
    </div>
    <div class="input_field">
        <label for="pic">Profile Image:</label>
        <input type="file" id="pic" name="pic" style="font-family: Georgia, 'Times New Roman', Times, serif;" >
        <?php if ($user['Pic']): ?>
            <img src="Image/<?php echo htmlspecialchars($user['Pic']); ?>" width="100px" height="100px">
        <?php endif; ?>
        </div>

        <input type="submit" value="Update" class="Login"><br>
    </form>
</div>
</body>
</html>
