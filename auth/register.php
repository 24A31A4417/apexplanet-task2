<?php

require_once '../config/database.php';

$message = '';
$messageType = '';

if (isset($_POST['register'])) {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {

        $message = "All fields are required.";
        $messageType = "danger";

    } elseif ($password !== $confirmPassword) {

        $message = "Passwords do not match.";
        $messageType = "danger";

    } else {

        // Check if email already exists
        $checkQuery = "SELECT * FROM users WHERE email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {

            $message = "Email already registered.";
            $messageType = "warning";

        } else {

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $insertQuery = "
                INSERT INTO users (
                    username,
                    email,
                    password
                )
                VALUES (
                    '$username',
                    '$email',
                    '$hashedPassword'
                )
            ";

            if (mysqli_query($conn, $insertQuery)) {

                $message = "Registration Successful!";
                $messageType = "success";

            } else {

                $message = "Registration Failed!";
                $messageType = "danger";
            }
        }
    }
}

require_once '../includes/header.php';
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Create Account</h3>
                </div>

                <div class="card-body">

                    <?php if (!empty($message)) : ?>

                        <div class="alert alert-<?php echo $messageType; ?>">

                            <?php echo $message; ?>

                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            type="submit"
                            name="register"
                            class="btn btn-primary w-100">

                            Register

                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <a href="login.php">
                            Already have an account? Login
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>