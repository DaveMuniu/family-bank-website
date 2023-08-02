<?php
session_start();
include "db.php";

$error = array();

if(isset($_POST['submit'])){
    // Get user inputs
    
    $username= mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $gender= mysqli_real_escape_string($conn,$_POST['gender']);
    $age= mysqli_real_escape_string($conn,$_POST['age']);
    $usertype=$_POST['usertype'];
    $insert = mysqli_query($conn, "INSERT INTO users(name,email,password,cpassword,phone,address,gender,age,user_type) 
         VALUES('$username','$email', '$password', '$cpassword', '$phone', '$address', '$gender', '$age','$usertype')");
         header('location:login.php');
    $select = "SELECT * FROM users WHERE name='$username' && email = '$email'";

    if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exists!';

    }else{

      if($password != $cpassword){
         $error[] = 'password not matched!';
      }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family ebanking solution</title>
    <link rel="stylesheet" href="logo/style.css">
</head>
<body>
<div class="header">
        <img src="images/pesalink-logo-1200x800-600x400.jpg" alt="logo" align="left">
        <h1>Family Bank</h1>
        <h2>With you for life</h2>
    </div>
<div class="container">
<h2>Sign Up</h2>
<form class="form" action="signup.php" method="POST">
    <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>
    </div>
    <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    </div>
    <div class="form-group">
    <label for="cpassword">Confirm Password:</label>
    <input type="password" name="cpassword" required><br>
    </div>
    <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    </div>
    <div class="form-group">
    <label for="phone">Phone:</label>
    <input type="tel" name="phone" required><br>
    </div>
    <div class="form-group">
    <label for="address">Address:</label>
    <input type="text" name="address" required><br>
    </div>
    
    <label for="gender">Gender:</label>
    <p>Male <input type="radio" name="gender" value="Male" required>
    Female <input type="radio" name="gender" value="Female" required></p>
    
    <div class="form-group">
    <label for="age">Age:</label>
    <input type="text" name="age" required><br>
    </div>
    <div class="form-group">
    <select name="usertype">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
    </div>
    <input type="submit" name="submit" class="btn" value="Register now">
    <p>Already a User!?   <a href="login.php" class="btn" >Login</a></p>
</form>
</div>
<footer>
     <div class="footer">
        <p>
            @ Family bank 2023
        </p>
     </div>
     </footer>
</body>
</html>
