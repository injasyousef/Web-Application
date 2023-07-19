<?php
$dbhost = 'localhost';
$dbusername = 'root';
$dbuserpassword = '';
$default_dbname = 'project_db';

try{
    $pdo = new PDO("mysql:host=$dbhost;dbname=$default_dbname",$dbusername,$dbuserpassword);
}catch(PDOException $e){
    die($e->getMessage());
}

?>