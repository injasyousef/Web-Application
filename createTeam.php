<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="createTeam.css">
    <title>Creat Team</title>
</head>
<body>
    <header>
        <div class="header-left">
        <img src="imges/soccer-player.png" alt="App Logo" class="logo">
        <label class="header-text"><strong>Injass Web App</strong></label>
        </div>
        <div class="header-right">
        <nav class="nav-links">
            <a href="about.html" class="nav-link">About Us</a>
            <a href="logout.php" class="nav-link">Log Out</a>
        </nav>
        <img src="imges/me.jpg" alt="Photo" class="photo">
        </div>
    </header>
    <h1>Creat New Team</h1>
    <a href="dashboard.php">Dashboard</a>
    <br>
    <br>
    <form action="" method="post">
        <label><strong>Team Name:</strong></label><br>
        <input type="text" name="teamName" required>
        <br>
        <br>
        <label><strong>Skill Level (1-5): </strong></label><br>
        <input type="number" name="level" min="1" max="5" required>
        <br>
        <br>
        <label><strong>Game Day: </strong></label><br>
        <input type="text" name="game" required>
        <br>
        <br>
        <input type="submit" name="submit" value="Add">
    </form>
    <footer>
    <div class="logoDiv">
        <img src="imges/soccer-player.png" class="logo" alt="Logo">
        <p>&copy;</p>
    </div>
    
    <div class="address">
        <p>Ramallah Kharbath-Bani-Hareth</p>
    </div>
    
    <div class="links">
        <a href="about.html">About Us</a>
    </div>
    </footer>
</body>
</html>

<?php
include "db.inc";
session_start();
if (isset($_POST["submit"])){
    $teamName=$_POST["teamName"];
    $teamLevel=$_POST["level"];
    $gmaday=$_POST["game"];
    $userID=$_SESSION['id'];
    $sql = "INSERT INTO `team` (`user_id`,`team_name`, `skill_level`, `gameday`) VALUES (?,?,?,?);";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $userID);
    $stmt->bindValue(2, $teamName);
    $stmt->bindValue(3, $teamLevel);
    $stmt->bindValue(4, $gmaday);
    if ($stmt->execute()) {
        echo "<label class='successMsg'>Added Succefully</label>";
    }
}
?>