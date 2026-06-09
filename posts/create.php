<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../config/database.php';

$message = '';

if (isset($_POST['create_post'])) {

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $userId = $_SESSION['user_id'];

    $query = "
        INSERT INTO posts (
            user_id,
            title,
            content
        )
        VALUES (
            '$userId',
            '$title',
            '$content'
        )
    ";

    if (mysqli_query($conn, $query)) {
        $message = "Post created successfully!";
    }
}

require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<div class="container mt-4">

    <?php if (!empty($message)) : ?>

        <div class="alert alert-success">
            <?= $message ?>
        </div>

    <?php endif; ?>

    <div class="card shadow">

        <div class="card-header">
            <h3>Create Post</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label>Title</label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label>Content</label>

                    <textarea
                        name="content"
                        rows="6"
                        class="form-control"
                        required></textarea>

                </div>

                <button
                    type="submit"
                    name="create_post"
                    class="btn btn-primary">

                    Publish Post

                </button>

            </form>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>