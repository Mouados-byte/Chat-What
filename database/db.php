<?php

$servername = "localhost";
$username = "root";
$passwd = "mouad123";
$dbname = "chat_app";

// Create connection
$conn = new mysqli($servername, $username, $passwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}