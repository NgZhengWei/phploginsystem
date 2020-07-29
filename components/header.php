<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System Demo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <nav class="navbar">
        <a class="logo" href="index.php">Login System</a>

        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>

        <?php 
        if (isset($_SESSION['username'])) {
            echo '<a class="btn btn-accent mr-2" href="inc/logout.inc.php">Logout</a>';
        } else {
            echo '<div class="navbar-login mr-3">
                    <form action="inc/login.inc.php" method="POST">
                        <input name="username" type="text" placeholder="Username">
                        <input name="password" type="password" placeholder="Password">
                        <input name="submit-login" type="submit" value="Login" class="btn btn-primary">
                    </form>
                </div>';
        }
        ?>
        
    </nav>