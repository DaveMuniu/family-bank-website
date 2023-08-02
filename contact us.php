<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family ebanking solutions</title>
    <link rel="stylesheet" href="logo/style.css">
</head>
<body>
    <div class="header">
        <h1>Family Bank</h1>
        <h2>With You For Life</h2>
        <img src="logo/website.jpg" alt="Family Bank Logo" align="left">
    </div>
    <nav>
        <Ul>
				<li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
				<li><a href="signup.php">Sign Up</a></li>
				<li><a href="about us.php">About Us</a></li>
			</Ul>
    </nav>
    <div class="content">
        <h1>Contact Us Today!</h1>
        <p><i>Reach out to us via our phone 0722000000 today! Or send us an email and we will be in touch with you shortly.</i></p>
        <div class="container">
        <form class="form">
            <label for="firstname">Name: </label>
            <input type="text" name="name" required><br><br>
            
            
            <label for="email">Email Address: </label>
            <input type="text" name="email" required><br><br>
                  
            <label for="request_type">Type of Request: </label>
            <select name="type_of_request">
                <option value="inquiry">Inquiry</option>
                <option value="complaint">Complaint</option>
                <option value="compliment">Compliment</option>
            </select><br><br>
            
            <label for="subject">Subject: </label>
            <input type="text" name="subject" required><br><br>
                  
            <label for="comment">Your Comment:</label><br>
            <textarea name="comment" id="comment" cols="30" rows="10" placeholder="What do you think about the bank"></textarea><br><br>
            
            <p>Are you a member of Family Bank?</p>
            <input type="radio" name="membership" value="yes" id="yes">
            <label for="yes">Yes</label>
            <input type="radio" name="membership" value="no" id="no">
            <label for="no">No</label><br><br>
                  
            <input type="submit">
        </form>  
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