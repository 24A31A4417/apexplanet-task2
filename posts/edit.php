<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../config/database.php';

$userId = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    header("Location: view.php");
    exit();
}

$postId = (int) $_GET['id'];

$query = "
    SELECT *
    FROM posts
    WHERE id = $postId
    AND user_id = $userId
";

$result = mysqli_query($conn, $query);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    die("Post not found.");
}

$message = '';

if (isset($_POST['update_post'])) {

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $updateQuery = "
        UPDATE posts
        SET
            title = '$title',
            content = '$content'
        WHERE id = $postId
        AND user_id = $userId
    ";

    if (mysqli_query($conn, $updateQuery)) {

        header("Location: view.php");
        exit();
    }
}

require_once '../includes/header.php';
require_once '../includes/navbar.php';
?>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">
            <h3>Edit Post</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label>Title</label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?php echo htmlspecialchars($post['title']); ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label>Content</label>

                    <textarea
                        name="content"
                        rows="6"
                        class="form-control"
                        required><?php echo htmlspecialchars($post['content']); ?></textarea>

                </div>

                <button
                    type="submit"
                    name="update_post"
                    class="btn btn-success">

                    Update Post

                </button>

            </form>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>