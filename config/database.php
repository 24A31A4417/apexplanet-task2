<?php

declare(strict_types=1);

$host = "localhost";
$username = "root";
$password = "";
$database = "blog";

$conn = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}