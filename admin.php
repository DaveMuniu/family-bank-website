<?php
session_start();
include "db.php";

if ($_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   
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
      <h3><i>Hi, <span>Admin</span></i></h3>
      <h1><i>Welcome <span><?php echo $_SESSION['admin_name'] ?></span></i></h1>

      <h1><i>User Management</i></h1>
<p><b><i><strong>Create New User: </strong></i></b></p>
<?php
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

    $result = mysqli_query($conn, "SELECT * FROM users WHERE name='$username' && email = '$email'");

    if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exists!';

    }else{

      if($password != $cpassword){
         $error[] = 'password not matched!';
      }
    }
}

?>
<form class="form" method="POST">
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
    <input type="submit" name="submit" value="Save">
    
</form>


   
       <h3><b><i>Users' List</b></i></h3>
<?php
if(isset($_GET['username']))
{
     $username=mysqli_real_escape_string($conn,$_GET['username']);
     $delete=mysqli_query($conn,"DELETE FROM users WHERE name='$username'");
     if($delete)
     {
        echo "<p style='color:green'>Success, record has been deleted</p>";
     }
     else{
        echo "<p style='color:red'>Error, record cannot be deleted</p>";
     }
}

$query=mysqli_query($conn,"SELECT * FROM users");
echo '<table border="1">
<tr>
<th>Username</th>
<th>Email</th>
<th>Phone</th>
<th>Address</th>
<th>Gender</th>
<th>Age</th>
<th>User Type</th>
<th>Action</th>
</tr>';
while ($row=mysqli_fetch_array($query)) 
{
    echo '<tr>
    <td>'.$row['name'].'</td>
    <td>'.$row['email'].'</td>
    <td>'.$row['phone'].'</td>
    <td>'.$row['address'].'</td>
    <td>'.$row['gender'].'</td>
    <td>'.$row['age'].'</td>
    <td>'.$row['user_type'].'</td>
    <td>
    <a href="edit_user.php?user='.$row['name'].'"><button class="btn">Edit</button></a>
    <a href="?username='.$row['name'].'" onclick="return confirm(\'Are you sure you want to delete this user?\')"><button class="btn2">Delete</button></a>
    </td>
    </tr>';
}
echo '</table>';

?>

<?php
if(isset($_POST['submit'])){
    $user=isset($_GET['user']) ? htmlspecialchars($_GET['user'],ENT_QUOTES) : '';
    $username=htmlspecialchars($_POST['username'],ENT_QUOTES);
    $email=htmlspecialchars($_POST['email'],ENT_QUOTES);
    $usertype=htmlspecialchars($_POST['usertype'],ENT_QUOTES);
    
    if(!empty($user)){
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, user_type=? WHERE name=?");
        $stmt->bind_param("ssss", $username, $email, $usertype, $user);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            echo "<p style='color:green'>Success, record has been saved</p>";
        }
        else{
            echo "<p style='color:red'>Error, record has not been saved</p>";
        }
    }
}

if(isset($_GET['user']))
{
    $username=htmlspecialchars($_GET['user'],ENT_QUOTES);

    //fetch this user from db table
    $query=mysqli_query($conn,"SELECT * FROM users WHERE name='$username'");
    $row=mysqli_fetch_array($query);
    echo'<form method="post">
    <input type="hidden" name="user" value="'.$row['name'].'">
<p>Username: <input type="text" name="username" value="'.$row['name'].'"></p>
<p>Email: <input type="email" name="email" value="'.$row['email'].'"></p>
<p>Phone: <input type="tel" name="phone" value="'.$row['phone'].'"></p>
<p>Address: <input type="text" name="address" value="'.$row['address'].'"></p>
<p>Gender: Male <input type="radio" name="gender" value="Male" >
    Female <input type="radio" name="gender" value="Female" >value="'.$row['gender'].'"
</p>
<p>Age: <input type="text" name="age" value="'.$row['age'].'"></p>
<p>User Type: <select name="usertype">
<option value="admin" ';
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
      <a href="logout.php" class="btn">logout</a>
<footer>
     <div class="footer">
        <p>
            @ Family bank 2023
        </p>
     </div>
     </footer>
</body>
</html>