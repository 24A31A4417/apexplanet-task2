<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../config/database.php';

$userId = $_SESSION['user_id'];

if (isset($_GET['id'])) {

    $postId = (int) $_GET['id'];

    $query = "
        DELETE FROM posts
        WHERE id = $postId
        AND user_id = $userId
    ";

    mysqli_query($conn, $query);
}

header("Location: view.php");
exit();