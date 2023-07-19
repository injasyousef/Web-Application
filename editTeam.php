
<?php
    include "db.inc";
    session_start();

    $teamID = $_GET['teamID'];

    $query = "SELECT * FROM `team` WHERE team_id = :teamID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':teamID', $teamID);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editTeam.css">
    <title>Edit Team</title>
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
        <h1>Edit Team</h1>
        <a href="dashboard.php">Dashboard</a>
        <br>
        <br>
        <form action="" method="post">
            <label><strong>Team Name:</strong></label><br>
            <input type="text" name="teamName" required value="<?php if ($result) { echo $result['team_name']; } ?>">
            <br>
            <br>
            <label><strong>Skill Level (1-5): </strong></label><br>
            <input type="number" name="level" min="1" max="5" required value="<?php if ($result) { echo $result['skill_level']; } ?>">
            <br>
            <br>
            <label><strong>Game Day: </strong></label><br>
            <input type="text" name="game" required value="<?php if ($result) { echo $result['gameday']; } ?>">
            <br>
            <br>
            <input type="submit" name="submit">
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
if(isset($_POST["submit"])){
    $teamName = $_POST['teamName'];
    $skillLevel = $_POST['level'];
    $gameDay = $_POST['game'];
    
    $query = "UPDATE `team` SET team_name = :teamName, skill_level = :skillLevel, gameday = :gameDay WHERE team_id = :teamID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':teamName', $teamName);
    $stmt->bindParam(':skillLevel', $skillLevel);
    $stmt->bindParam(':gameDay', $gameDay);
    $stmt->bindParam(':teamID', $teamID);
    
    if ($stmt->execute()) {
        echo "<label class='successMsg'>Team information updated successfully.</label>";
    } else {
        echo "<label class='errorMsg'>Error updating team information.</label>";
        }
}

?>