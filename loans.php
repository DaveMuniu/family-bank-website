<?php
// loan_process.php
session_start();

require_once 'db.php';

if (!isset($_SESSION['name'])) {
    echo "Error: User not logged in";
    exit();
}

$name = $_SESSION['name'];
if(isset($_POST['submit'])){

    $amount = $_POST['amount']; // Get loan amount from form data

    // Check if loan amount is within user's credit limit
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $credit_limit = $user['balance'] * 2; 
    }

    // Process loan application and update user's balance
    $new_balance = $user['balance'] + $amount;
    $sql = "UPDATE users SET balance = $new_balance WHERE name = '$name'";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green'>Loan approved. Your new account balance is </p>" . $new_balance;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Loan Application</title>
</head>
<body>
    <h1>Loan Application</h1>
    <form action="loans.php" method="POST">
        <label for="amount">Loan Amount:</label>
        <input type="number" name="amount" id="amount" required>
        <br><br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
