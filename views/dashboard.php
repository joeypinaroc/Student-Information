<?php
    // start session again because sessions are not persistent by default
    // calling session_start() retrieves existing session 
    session_start(); 

    // user must be logged in, else redirect to login .php
    if(!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

    <div class="container">
        <h1 class="pageTitle">Dashboard</h1>
        <div class="button">
            <a href="studentInfo.php">View Student Information</a>
        </div>
        <div class="button">
            <a href="logout.php">Logout</a>
        </div>
    </div>
    
</body>
</html>

