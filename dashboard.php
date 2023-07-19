<?php
include "db.inc";
$query="SELECT * FROM `team`;";
$d=$pdo->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>Dashboard</title>
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
    <h1>Dashboard</h1>
    <?php
        session_start();
        echo "<h2>Welcome ".$_SESSION['name']." !</h2>";
    ?>
    <br>
    <br>
    <div class="all">
    <div class="links">
        <nav>
            <a href="createTeam.php">Add Team</a>
            <a href="">Edit Team</a>
            <a href="">Delete Team</a>
        </nav>
    </div>
    <table border=1>
        <tr>
            <th>Team Name</th>
            <th>Skil Level</th>
            <th>Gameday</th>
            <th>Number Of Players</th>
        </tr>
        <?php
            foreach($d as $data)
            {
                $teamID=$data['team_id'];
        ?>
        <tr>
            <td><a href='teamDetail.php?id=<?php echo $teamID;?>'><?php echo $data['team_name'];?></a></td>
       
            <td><?php echo $data['skill_level'];?></td>
            <td><?php echo $data['gameday'];?></td>
            <?php
                $conditionValue=$data['team_id'];
                $stmt = $pdo->prepare("SELECT * FROM player WHERE team_id = :value");
                $stmt->bindParam(':value', $conditionValue);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $rowCount = $stmt->rowCount();
            ?>
            <td><?php echo $rowCount;?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    </div>

    <br><br>
    <form action="" method="post">
    <input type="submit" name="newTeam" value="Add New Team">
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
if (isset($_POST["newTeam"])){
    header("Location: createTeam.php");
}
?>
