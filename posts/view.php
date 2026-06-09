<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../config/database.php';
require_once '../includes/header.php';
require_once '../includes/navbar.php';

$userId = $_SESSION['user_id'];

$query = "
    SELECT *
    FROM posts
    WHERE user_id = '$userId'
    ORDER BY created_at DESC
";

$result = mysqli_query($conn, $query);

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Posts</h2>

        <a href="create.php" class="btn btn-primary">
            Create New Post
        </a>
    </div>

    <?php if (mysqli_num_rows($result) > 0): ?>

        <?php while ($post = mysqli_fetch_assoc($result)): ?>

            <div class="card shadow-sm mb-3">

                <div class="card-body">

                    <h4>
                        <?php echo htmlspecialchars($post['title']); ?>
                    </h4>

                    <p>
                        <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                    </p>

                    <small class="text-muted">
                        Created:
                        <?php echo $post['created_at']; ?>
                    </small>

                    <div class="mt-3">

                        <a
                            href="edit.php?id=<?php echo $post['id']; ?>"
                            class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a
                            href="delete.php?id=<?php echo $post['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this post?');">
                            Delete
                        </a>

                    </div>

                </div>

            </div>

        <?php endwhile; ?>

    <?php else: ?>

        <div class="alert alert-info">
            No posts found.
        </div>

    <?php endif; ?>

</div>

<?php require_once '../includes/footer.php'; ?>