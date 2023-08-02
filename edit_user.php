<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin User Edit Page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="logo/style.css">

</head>
<body>
<div class="header">
     <img src="logo/website.jpg" alt="logo" ALIGN="left" >
        <h1 >Family Bank</h1>
        <h2>With You For Life</h2>
    </div>
    <div class="container">
    <div class="content">

<?php
include "db.php";

if(isset($_POST['submit'])){
    $user=htmlspecialchars($_POST['user'],ENT_QUOTES);
    $username=htmlspecialchars($_POST['username'],ENT_QUOTES);
    $email=htmlspecialchars($_POST['email'],ENT_QUOTES);
    $phone=htmlspecialchars($_POST['phone'],ENT_QUOTES);
    $address=htmlspecialchars($_POST['address'],ENT_QUOTES);
    $gender=htmlspecialchars($_POST['gender'],ENT_QUOTES);
    $age=htmlspecialchars($_POST['age'],ENT_QUOTES);
    $usertype=htmlspecialchars($_POST['usertype'],ENT_QUOTES);
    $insert=mysqli_query($conn,"UPDATE users SET name='$username', email='$email',phone='$phone',address='$address',gender='$gender',age='$age', user_type='$usertype'
    WHERE name='$user'");

    if($insert)
    {
        echo "<p style='color:green'>Success, record has been saved</p>";
        header('Location: admin.php');
        exit();
    }
    else{
        echo"<p style='color:red'>Error, record has not been saved</p>";
    }
}

if(isset($_GET['user']))
{
    $username=htmlspecialchars($_GET['user'],ENT_QUOTES);

    //fetch this user from db table
    $query=mysqli_query($conn,"SELECT * FROM users WHERE name='$username'");
    $row=mysqli_fetch_array($query);
    echo'<h2>Edit User</h2>';
    echo'<form method="post">
    <input type="hidden" name="user" value="'.$row['name'].'">
<p>Username: <input type="text" name="username" value="'.$row['name'].'"></p>
<p>Email: <input type="email" name="email" value="'.$row['email'].'"></p>
<p>Phone: <input type="tel" name="phone" value="'.$row['phone'].'"></p>
<p>Address: <input type="text" name="address" value="'.$row['address'].'"></p>
<p>Gender: Male <input type="radio" name="gender" value="Male" ';
    if($row['gender'] == 'Male') {
        echo 'checked';
    }
    echo '> Female <input type="radio" name="gender" value="Female" ';
    if($row['gender'] == 'Female') {
        echo 'checked';
    }
    echo '></p>
<p>Age: <input type="text" name="age" value="'.$row['age'].'"></p>
<p>User Type: <select name="usertype">
<option  value="Admin" ';
    if($row['user_type']=='admin')
    {
        echo 'selected';
    }
    echo'>Admin</option>
<option value="user"';
    if($row['user_type']=='user')
    {
        echo 'selected';
    }
    echo'>User</option>
</select></p>
<p><input type="submit" name="submit" value="submit"></p></p>
</form>';
}
?>
</div>
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
