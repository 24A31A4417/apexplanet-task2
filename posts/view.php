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

$search = $_GET['search'] ?? '';

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

$countQuery = "
    SELECT COUNT(*) AS total
    FROM posts
    WHERE user_id = '$userId'
    AND (
        title LIKE '%$search%'
        OR content LIKE '%$search%'
    )
";

$countResult = mysqli_query($conn, $countQuery);

$totalPosts = mysqli_fetch_assoc($countResult)['total'];

$totalPages = ceil($totalPosts / $limit);

$query = "
    SELECT *
    FROM posts
    WHERE user_id = '$userId'
    AND (
        title LIKE '%$search%'
        OR content LIKE '%$search%'
    )
    ORDER BY created_at DESC
    LIMIT $limit OFFSET $offset
";

$result = mysqli_query($conn, $query);

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>My Posts</h2>

        <a href="create.php" class="btn btn-success">
            + Create New Post
        </a>

    </div>

    <form method="GET" class="mb-4">

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search posts..."
                value="<?= htmlspecialchars($search); ?>">

            <button class="btn btn-primary">
                Search
            </button>

        </div>

    </form>

    <?php if (mysqli_num_rows($result) > 0): ?>

        <?php while ($post = mysqli_fetch_assoc($result)): ?>

            <div class="card shadow-sm mb-3">

                <div class="card-body">

                    <h4 class="fw-bold">
                        <?= htmlspecialchars($post['title']); ?>
                    </h4>

                    <p>
                        <?= nl2br(htmlspecialchars($post['content'])); ?>
                    </p>

                    <small class="text-muted">
                        Created:
                        <?= $post['created_at']; ?>
                    </small>

                    <div class="mt-3">

                        <a
                            href="edit.php?id=<?= $post['id']; ?>"
                            class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <a
                            href="delete.php?id=<?= $post['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this post?')">

                            Delete

                        </a>

                    </div>

                </div>

            </div>

        <?php endwhile; ?>

        <?php if ($totalPages > 1): ?>

            <nav class="mt-4">

                <ul class="pagination justify-content-center">

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                        <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">

                            <a
                                class="page-link"
                                href="?page=<?= $i ?>&search=<?= urlencode($search) ?>">

                                <?= $i ?>

                            </a>

                        </li>

                    <?php endfor; ?>

                </ul>

            </nav>

        <?php endif; ?>

    <?php else: ?>

        <div class="alert alert-info">
            No posts found.
        </div>

    <?php endif; ?>

</div>

<?php require_once '../includes/footer.php'; ?>