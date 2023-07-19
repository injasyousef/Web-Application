<?php
include "db.inc";
session_start();

$teamID = $_GET['teamID'];


    $query = "DELETE FROM `team` WHERE team_id = :teamID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':teamID', $teamID);

    if ($stmt->execute()) {
        echo "Team deleted successfully.";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error deleting team.";
    }

?>
