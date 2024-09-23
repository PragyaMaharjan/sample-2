<?php
define('TITLE', 'Manage Categories');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

// Check if admin is logged in
if (!isset($_SESSION['is_adminlogin'])) {
    header('Location: login.php');
    exit();
}

$msg = '';

// Handle adding a new category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCategory'])) {
    $categoryName = $conn->real_escape_string($_POST['category_name']);
    
    // Insert new category into the database
    $sql = "INSERT INTO categories (name) VALUES ('$categoryName')";
    if ($conn->query($sql) === TRUE) {
        $msg = '<div class="alert alert-success mt-2">Category added successfully.</div>';
    } else {
        $msg = '<div class="alert alert-danger mt-2">Failed to add category: ' . $conn->error . '</div>';
    }
}

// Handle category deletion
if (isset($_GET['delete'])) {
    $categoryId = $conn->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM categories WHERE id = '$categoryId'";
    if ($conn->query($sql) === TRUE) {
        $msg = '<div class="alert alert-success mt-2">Category deleted successfully.</div>';
    } else {
        $msg = '<div class="alert alert-danger mt-2">Unable to delete category: ' . $conn->error . '</div>';
    }
}

// Fetch all categories
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="text-center">Manage Categories</h2>

    <?php if ($msg): ?>
        <?php echo $msg; ?>
    <?php endif; ?>

    <!-- Add New Category Form -->
    <div class="mb-4">
        <h4>Add New Category</h4>
        <form action="" method="POST">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" name="category_name" id="category_name" required>
            </div>
            <button type="submit" class="btn btn-primary" name="addCategory">Add Category</button>
        </form>
    </div>

    <!-- Display Categories -->
    <div class="mb-4">
        <h4>Existing Categories</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td>
                                <a href="editcategory.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No categories found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('./includes/footer.php');
?>
