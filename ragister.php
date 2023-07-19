<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Register</title>
</head>
<body>
    <h1>Register Page</h1>

    <br>
    <form action="" method="post">
        <label><strong>Username: </strong></label><br>
        <input type="text" name="username" required>

        <br>
        <br>

        <label><strong>Email: </strong></label><br>
        <input type="email" name="email" required>

        <br>
        <br>
        
        <label><strong>Password: </strong></label><br>
        <input type="password" name="password" required>

        <br>
        <br>

        <label><strong>Confirm Passwoed: </strong></label><br>
        <input type="password" name="confirmPass" required>

        <br>
        <br>
        
        <input type="submit" name="submit" value="Sign Up">
    </form>
    
</body>
</html>

<?php
include "db.inc";

if(isset($_POST["submit"])){
    if($_POST["password"]===$_POST["confirmPass"]){
        $username=$_POST["username"];
        $email=$_POST["email"];
        $pass=$_POST["password"];
        $sql = "INSERT INTO `user` (`username`, `email`, `password`) VALUES (?,?,?);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $pass);
        if ($stmt->execute()) {
        $lastIn=$pdo->lastInsertId();
        $sql2="INSERT INTO Login (user_id) VALUES (?)";
        $stmt_login = $pdo->prepare($sql2);
        $stmt_login->bindValue(1,$lastIn);
        if($stmt_login->execute()){     
            header("Location: login.php");
         }
        }
    }else{
        echo "<label class='error'>Passwords Does not match</label>";
    }
}

?>