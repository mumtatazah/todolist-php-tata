<?php
include('../includes/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
    } else {
        echo "<script>Swal.fire('Error', 'Username already exists', 'error');</script>";
    }
}
?>
<?php include('../includes/header.php'); ?>
<div class="container">
    <h2 class="mt-5">Register</h2>
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>
<?php include('../includes/footer.php'); ?>
