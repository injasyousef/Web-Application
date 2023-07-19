<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teamDetail.css">
    <title>Team Detail</title>
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
    <?php
    include "db.inc";
    session_start();

    $teamID = $_GET['id'];

    $query = "SELECT * FROM `team` WHERE team_id = :teamID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':teamID', $teamID);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "<div class=details>";
        echo "<h1>" . $result['team_name'] . "</h1>";
        echo '<a href="dashboard.php">Dashboard</a>';
        echo "<br>";
        echo "<br>";

        echo "<label>Team Name: " . $result['team_name'] . "</label><br>";
        echo "<label>Skill Level: " . $result['skill_level'] . "</label><br>";
        echo "<label>Game Day: " . $result['gameday'] . "</label><br>";
        echo "<p><strong>Players: </strong></p>";
        echo "<br>";

        $query2 = "SELECT * FROM `player` WHERE team_id = :teamID;";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(':teamID', $teamID);
        $stmt2->execute();

        $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        echo "<ul>";
        if ($result2) {
            foreach ($result2 as $player) {
                echo "<li>" . $player['player_name'] . "</li><br>";
            }
        } else {
            echo "<label class='errorP'>No players found.</label>";
        }

        echo "</ul>";
        echo "</div>";
        echo "<br>";

    } else {
        echo "<label class='errorT'>Team not found.</label>";
    }
    ?>

    <?php
    if ($result && isset($_SESSION['id']) && $result['user_id'] == $_SESSION['id']) {
        ?>

        <?php
        $query3 = "SELECT COUNT(*) FROM `player` WHERE team_id = :teamID;";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->bindParam(':teamID', $teamID);
        $stmt3->execute();
        $playerCount = $stmt3->fetchColumn();
        
        if ($playerCount >= 9) {
            echo "<p class='full'>The Team is full, you cannot add more players</p>";
        } else {
            ?>
            <div class="addPlayer">
            <label>Add Player</label> <br> <br>
            <form action="" method="post">
                <label>Player Name: </label>
                <input type="text" name="playerName" required>
                <br>
                <br>
                <input type="submit" name="submit" value="Add">
            </form>
            </div>
            <?php
            if (isset($_POST["submit"])) {
                $pName = $_POST["playerName"];
                $sql = "INSERT INTO `player` (`player_name`, `team_id`) VALUES (?, ?);";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $pName);
                $stmt->bindValue(2, $teamID);
                if ($stmt->execute()) {
                    echo "<label class='message'>Insertion successful.</label>";
                } else {
                    echo "<label class='errorT'>Error inserting data.</label>";
                }
            }
        }
        ?>

    <?php
    }
    ?>

    <?php
    if ($result && isset($_SESSION['id']) && $result['user_id'] == $_SESSION['id']) {
    ?>

    <br>
    <a href="editTeam.php?teamID=<?php echo $teamID;?>">Edit Team</a>
    <br>
    <a href="deleteTeam.php?teamID=<?php echo $teamID;?>">Delete Team</a>
    <?php
    }
    ?>
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