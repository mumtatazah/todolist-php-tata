<?php
session_start();
include('../includes/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php');
        } else {
            echo "<script>Swal.fire('Error', 'Incorrect password', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Error', 'User not found', 'error');</script>";
    }
}
?>
<?php include('../includes/header.php'); ?>
<div class="container">
    <h2 class="mt-5">Login</h2>
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
</div>
<?php include('../includes/footer.php'); ?>
