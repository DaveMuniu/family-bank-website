<?php
session_start();
include "db.php";

$username = $_SESSION['name'];
$result = mysqli_query($conn,"SELECT * FROM users WHERE name='$username'");
$row = mysqli_fetch_assoc($result);
$fullname = $row['name'];
$member_since = $row['date_of_registration'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" href="logo/style.css">
</head>
<body>
	<section class="main">
	<div class="container2">

   <div class="content">
			<h3>Welcome, <span><?php echo $fullname; ?>!</span></h3>
			</div>
			</div>
		<nav>
			
			<Ul>
				<li><a href="depositmoney.php">Deposit or Withdraw Cash Here</a></li>
				<li><a href="loans.php">Loan Page</a></li>
				<li><a href="contact us.php">Contact Us</a></li>
				<li><a href="about us.php">About Us</a></li>
				<li><a href="logout.php">Logout</a></li>
			</Ul>
		</nav>
	</section>
<footer>
     <div class="footer">
        <p>
            @ Family bank 2023
        </p>
     </div>
     </footer>
</body>
</html>

