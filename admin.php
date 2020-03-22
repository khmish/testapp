<?php require_once 'startSession.php' ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <?php include_once 'style.php' ?>
    
</head>
<body>
<?php include_once 'navbar.php'; ?>
    
    <?php require 'index.php'; ?>
    <p>
        <a href="resetPassword.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>