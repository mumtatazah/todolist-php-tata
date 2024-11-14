<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand text-white" href="index.php">To-Do List</a>
        <ul class="navbar-nav ml-auto">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link text-white" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="register.php">Register</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link text-white" href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
