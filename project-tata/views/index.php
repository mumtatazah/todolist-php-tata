<?php
session_start();
include('../includes/db.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $user_id = $_SESSION['user_id'];
        
        $sql = "INSERT INTO tasks (title, description, status, user_id) VALUES ('$title', '$description', '$status', '$user_id')";
        $conn->query($sql);
    }
    
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        
        $sql = "UPDATE tasks SET title='$title', description='$description', status='$status' WHERE id='$id'";
        $conn->query($sql);
    }
    
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM tasks WHERE id='$id'";
        $conn->query($sql);
    }
}

$sql = "SELECT * FROM tasks WHERE user_id = " . $_SESSION['user_id'];
$result = $conn->query($sql);
?>

<?php include('../includes/header.php'); ?>
<div class="container">
    <h2 class="mt-5 text-center text-primary">Manage Your Tasks</h2>
    <button class="btn btn-outline-dark rounded-0" data-bs-toggle="modal" data-bs-target="#createModal">+ Create Task</button>
    <div class="row mt-5">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="task-card shadow-lg p-3 mb-4 rounded-4" style="background: #f4f4f9; transition: transform 0.3s ease;">
                    <h5 class="task-title text-dark"><?php echo $row['title']; ?></h5>
                    <p class="task-description"><?php echo $row['description']; ?></p>
                    <p class="task-status">
                        <span class="badge <?php echo $row['status'] === 'completed' ? 'bg-success' : 'bg-warning'; ?>"><?php echo ucfirst($row['status']); ?></span>
                    </p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <!-- Edit Button -->
                        <button class="btn btn-outline-primary rounded-3" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">Edit</button>
                        <!-- Delete Button -->
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-outline-danger rounded-3" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" required><?php echo $row['description']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                        <option value="completed" <?php if ($row['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="create" class="btn btn-outline-primary">Create</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>

