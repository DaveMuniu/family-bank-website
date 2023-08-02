<?php
session_start();
include "db.php";

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if username and password are not empty
    if(empty($username) || empty($password)){
        $error = 'Username or Password is invalid';
    }else{
        // Query the database to check if user exists
        $query = "SELECT * FROM users WHERE name='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);

            if($row['user_type'] == 'admin'){
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['admin_name'] = $row['name'];
                header('location:admin.php');
            }elseif($row['user_type'] == 'user'){
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['name'] = $row['name'];
                header('location:dashboard.php');
            }

        }else{
            $error = 'Incorrect username or password!';
        }
    }
}

mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="logo/style.css">
</head>
<body>
    <div class="header">
        <img src="images/pesalink-logo-1200x800-600x400.jpg" alt="logo" align="left">
        <h1>Family Bank</h1>
        <h2>With you for life</h2>
    </div>
    <div class="container">
        <h2>Login</h2>
        <?php 
        // Display error message if there is one
        if(isset($error)){
            echo '<div class="error">' . $error . '</div>';
        }
        ?>
        <form method="post" action="" class="form">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button input type="submit" name="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="signup.php" class="btn">Sign up</a></p>
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