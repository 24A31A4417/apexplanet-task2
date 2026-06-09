<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body text-center">

            <h1>
                Welcome,
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </h1>

            <p class="lead">
                PHP CRUD Blog Application
            </p>

            <a
                href="posts/create.php"
                class="btn btn-primary">

                Create New Post

            </a>

            <a
                href="posts/view.php"
                class="btn btn-success">

                View Posts

            </a>

        </div>

    </div>

</div>

<?php require_once 'includes/footer.php'; ?>