<?php

$DBservername = 'localhost';
$DBuser = 'root';
$DBpassword = 'admin';
$DBdatabase = 'loginsystem';

$conn = new mysqli($DBservername, $DBuser, $DBpassword, $DBdatabase);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }