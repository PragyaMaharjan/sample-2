<?php
include('../requester/dbconnection.php');
session_start();

// Check if admin is logged in
if (!isset($_SESSION['is_adminlogin'])) {
    header('Location: login.php');
    exit();
}

$msg = '';

if (isset($_GET['id'])) {
    $categoryId = $conn->real_escape_string($_GET['id']);
    
    // Fetch category details
    $sql = "SELECT * FROM categories WHERE id = '$categoryId'";
    $result = $conn->query($sql);
    $category = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateCategory'])) {
    $categoryId = $conn->real_escape_string($_POST['category_id']);
    $categoryName = $conn->real_escape_string($_POST['category_name']);
    
    // Update category in the database
    $sql = "UPDATE categories SET name = '$categoryName' WHERE id = '$categoryId'";
    if ($conn->query($sql) === TRUE) {
        $msg = '<div class="alert alert-success mt-2">Category updated successfully.</div>';
    } else {
        $msg = '<div class="alert alert-danger mt-2">Failed to update category: ' . $conn->error . '</div>';
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">Edit Category</h2>

    <?php if ($msg): ?>
        <?php echo $msg; ?>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" name="category_name" id="category_name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="updateCategory">Update Category</button>
    </form>
</div>

<?php
include('./includes/footer.php');
?>
