<?php 
    include "../config/db.php";
    include "../models/UserModel.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $database = new Database();
        $db = $database->connect(); // instantiate mysqli connection

        $user = new User($db); // construct new User and pass the db connection
        $user->username = $_POST["username"];
        $user->email = $_POST["email"];
        $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT); // ## need to hash

        // validate user creation success
        if($user->create()) {
            echo "User registered successfully";
        } else {
            echo "Registration failed";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

    <div class="container">
        <a href="../index.php">Back to home</a>
        <h1 class="pageTitle">Admin Register</h1>
        <form method="POST">
            <div>
                <label for="username">Username:</label>
                <!-- name = key, value in input box = value -->
                <input id="username" type="text" placeholder="Enter your username" name="username" required> 
            </div>
            <div>
                <label for="email">Email:</label>
                <input id="email" type="email" placeholder="Enter your email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" placeholder="Enter your password" name="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm password:</label>
                <input id="confirm_password" type="password" placeholder="Confirm your password" name="confirm_password" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
    
</body>
</html>


