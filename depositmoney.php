<?php
session_start();
include "db.php";

// process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $amount = $_POST["amount"];
  $action = $_POST["action"];
  $qry = "SELECT name, balance FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $qry);
  
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    $name = $row["name"];
    $balance = $row["balance"];

    // update the balance based on the action (withdraw or deposit)
    if ($action == "withdraw" && $balance >= $amount) {
      $new_balance = $balance - $amount;
      $qry = "UPDATE users SET balance = '$new_balance' WHERE email = '$email'";
      if (mysqli_query($conn, $qry)) {
        $new_balance = $action == "withdraw" ? $balance - $amount : $balance + $amount;
       echo "<p style='color: green;'>Transaction of $amount successful. Your new balance is $new_balance.</p>";
      } else {
        echo "<p style='color:red;'>Error updating record: </p>" . mysqli_error($conn);
      }

    } elseif ($action == "deposit") {
      $new_balance = $balance + $amount;
      $qry = "UPDATE users SET balance = '$new_balance' WHERE email = '$email'";
      if (mysqli_query($conn, $qry)) {
       echo "<p style='color: green;'>Deposit of $amount successful. Your new balance is $new_balance.</p>";
      } else {
        echo "<p style='color:red;'>Error updating record:</p>" . mysqli_error($conn);
      }
    } else {
      echo "<p style='color:red;'>Insufficient funds or invalid action.</p>";
    }
  } else {
    echo "<p style='color:red;'>Invalid email or password.,</p>";
  }

  // close the database connection
  mysqli_close($conn);
}

// handle logout
if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header("Location: dashboard.php");
}

?>


<!DOCTYPE html>
<html>
<head>
<title>Transactions</title>
<link rel="stylesheet" href="logo/style.css">
</head>
<body>
<div class="header">
        <img src="images/pesalink-logo-1200x800-600x400.jpg" alt="logo" align="left">
        <h1>Family Bank</h1>
        <h2>With You For Life</h2>
    </div>
 <div class="container">
<h2>Transactions</h2>
  <form method="post" class="form" action="">
  <div class="form-group">
    Email: <input type="text" name="email" required><br>
    </div>
    <div class="form-group">
    Password: <input type="password" name="password" required><br>
    </div>
    <div class="form-group">
    Amount: <input type="number" name="amount" required><br>
    </div>
    <div class="form-group">
    Action:
    <select name="action" required>
      <option value="">Select an action</option>
      <option value="withdraw">Withdraw</option>
      <option value="deposit">Deposit</option>
    </select><br>
    </div>
    <input type="submit" value="Submit">
  </form>
</div>
  </p><a href="?logout=true" class="btn" >Logout</a></p>
  
  <footer>
     <div class="footer">
        <p>
            @ Family bank 2023
        </p>
     </div>
     </footer>
</body>
</html>