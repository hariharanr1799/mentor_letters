<?php

$servername = 'localhost';
$sqlusername = 'username';
$sqlpassword = 'password';

$database = 'mentorletters';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $sqlusername, $sqlpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    die("Connection failed");
    }

?>