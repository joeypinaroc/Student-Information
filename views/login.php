<?php
    session_start();

    include "../config/db.php";
    include "../models/UserModel.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $database = new Database();
        $db = $database->connect();

        $user = new User($db);
        $user->email = $_POST["email"];
        $password = $_POST["password"];

        // **didnt work bec password wasnt hashed
        // if($user->login($password)) { // login($password) returns true or false from User model
        //     $_SESSION["user"] = $user->email; // store user session
        //     header("Location: dashboard.php"); // redirect to dashboard
        //     exit();
        // } else {
        //     echo "Invalid email or password!";
        // }

        $sql = "SELECT * FROM users WHERE email = '$user->email' LIMIT 1";
        $result = mysqli_query($db, $sql);

        if(mysqli_num_rows($result) === 1) {
            $fetchedUser = mysqli_fetch_assoc($result);
            if(password_verify($password, $fetchedUser["password"])) {
                $_SESSION["user"] = $user; // store user session
                header("Location: dashboard.php"); // redirect to dashboard
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "Invalid username!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

    <div class="container">
        <a href="../index.php">Back to home</a>
        <h1 class="pageTitle">Admin Login</h1>
        <form method="POST">
            <div>
                <label for="email">Email:</label>
                <input id="email" type="email" placeholder="Enter your email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" placeholder="Enter your password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    
</body>
</html>


