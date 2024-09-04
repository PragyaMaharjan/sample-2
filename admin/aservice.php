<?php
define('TITLE', 'Admin Services');
define('PAGE', 'service');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

// Check if user is admin
if (!isset($_SESSION['is_adminlogin'])) {
    header('Location: login.php');
    exit();
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    // Retrieve and sanitize form input
    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
    $description = isset($_POST['description']) ? $conn->real_escape_string($_POST['description']) : '';
    $rate = isset($_POST['rate']) ? $_POST['rate'] : '';

    // Validate rate (ensure it's a number)
    if (!is_numeric($rate) || $rate <= 0) {
        $error[] = 'Rate must be a positive number.';
    }

    $folder = 'uploads/';
    $imageFile = $_FILES['image']['name'];
    $file = $_FILES['image']['tmp_name'];
    $target_file = $folder . basename($imageFile);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $error = [];

    // Check for file upload errors
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $error[] = 'File upload error: ' . $_FILES['image']['error'];
    }

    // Check if the file type is allowed
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
    }

    // Check if the file size is within the limit (1MB)
    if ($_FILES['image']['size'] > 1048576) {
        $error[] = 'Sorry, your image is too large. The maximum size is 1MB.';
    }

    // Check if the upload directory exists and is writable
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true); // Create the directory if it does not exist
    }
    if (!is_writable($folder)) {
        $error[] = 'Upload directory is not writable.';
    }

    // Proceed if there are no errors
    if (empty($error)) {
        if (move_uploaded_file($file, $target_file)) {
            // Prepare and execute the SQL query using a prepared statement
            $stmt = $conn->prepare("INSERT INTO categories (name, description, image, rate) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $description, $target_file, $rate);

            if ($stmt->execute()) {
                $msg = '<div class="alert alert-success mt-2">Service added successfully.</div>';
            } else {
                $msg = '<div class="alert alert-danger mt-2">Unable to add service: ' . $stmt->error . '</div>';
            }

            $stmt->close();
        } else {
            $msg = '<div class="alert alert-danger mt-2">Failed to move uploaded file.</div>';
        }
    } else {
        foreach ($error as $err) {
            $msg .= '<div class="alert alert-danger mt-2">' . htmlspecialchars($err) . '</div>';
        }
    }
}

// Handle record deletion
if (isset($_GET['delete'])) {
    $id = $conn->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM categories WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $msg = '<div class="alert alert-success mt-2">Record deleted successfully.</div>';
    } else {
        $msg = '<div class="alert alert-danger mt-2">Unable to delete record: ' . $conn->error . '</div>';
    }
}

// Fetch all records
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="text-center">Admin Services</h2>

    <?php if ($msg): ?>
        <?php echo $msg; ?>
    <?php endif; ?>

    <div class="mb-4">
        <h4>Add New Service</h4>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="text" class="form-control" name="rate" id="rate" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add">Add Service</button>
        </form>
    </div>

    <div class="mb-4">
        <h4>Existing Services</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td>
                                <?php if ($row['image']): ?>
                                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" width="100" height="100">
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['rate']); ?></td>
                            <td>
                                <a href="editservice.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?delete=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('./includes/footer.php');
?>
You sent
