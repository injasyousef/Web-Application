<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
    <h1>Login Page</h1>

    <form action="" method="post">
    <label><strong>Email: </strong></label><br>

        <input type="email" name="email" required>

        <br>
        <br>
        
        <label><strong>Password: </strong></label><br>
        <input type="password" name="password" required>

        <br>
        <br>

        <input type="submit" name="submit" value="Log in">

    </form>
</body>
</html>

<?php
include "db.inc";

if(isset($_POST["submit"])){
    session_start();
    
    $sqlQuery = $pdo->prepare("SELECT user_id,email,username, password FROM user WHERE user.email = :email");
    $sqlQuery->bindValue(":email", $_POST["email"]);
    $sqlQuery->execute();
    $userInfo = $sqlQuery->fetch(PDO::FETCH_ASSOC);

    if ($sqlQuery->rowCount() != 0) {
        $sUsername = $userInfo["email"];
        $sPassword = $userInfo["password"];
        $_SESSION['name'] =$userInfo["username"];

        if ($sPassword == $_POST["password"]) {
            $sqlIdProfile = $pdo->prepare("SELECT * from user as u JOIN login as l where u.user_id = l.user_id");
            $sqlIdProfile->execute();
            if ($sqlIdProfile->rowCount() != 0) {
                $_SESSION['id']=$userInfo["user_id"];
                header("Location: dashboard.php");
            }
        }else{
            echo "<label class='error'>Wrong password</label>";
        }
    }else{
        echo "<label class='error'>Wrong email</label>";
    }
}
?>