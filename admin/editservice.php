<?php
define('TITLE', 'Edit Service');
define('PAGE', 'service');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

// Check if user is admin
if (!isset($_SESSION['is_adminlogin'])) {
    header('Location: login.php');
    exit();
}

// Check if ID is provided and is valid
$id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '';
if (!$id) {
    header('Location: admin_services.php');
    exit();
}

$msg = '';

// Handle form submission for updates
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $rate = $conn->real_escape_string($_POST['rate']);
    
    $folder = 'uploads/';
    $imageFile = $_FILES['image']['name'];
    $file = $_FILES['image']['tmp_name'];
    $target_file = $folder . basename($imageFile);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $error = [];

    // Check for file upload errors
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
        $error[] = 'File upload error: ' . $_FILES['image']['error'];
    }

    // Check if the file type is allowed
    if ($imageFile && !in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
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

    // If there are no errors, proceed with the update
    if (empty($error)) {
        // Handle file upload
        if ($imageFile) {
            if (move_uploaded_file($file, $target_file)) {
                $imagePath = $target_file;
            } else {
                $msg = '<div class="alert alert-danger mt-2">Failed to move uploaded file.</div>';
            }
        } else {
            // Use existing image if no new file was uploaded
            $imagePath = isset($_POST['existing_image']) ? $_POST['existing_image'] : '';
        }

        // Update the record in the database
        $sql = "UPDATE categories SET name='$name', description='$description', image='$imagePath', rate='$rate' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success mt-2">Record updated successfully.</div>';
        } else {
            $msg = '<div class="alert alert-danger mt-2">Unable to update record: ' . $conn->error . '</div>';
        }
    } else {
        foreach ($error as $err) {
            $msg .= '<div class="alert alert-danger mt-2">' . htmlspecialchars($err) . '</div>';
        }
    }
}

// Fetch the current record details
$sql = "SELECT * FROM categories WHERE id='$id'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header('Location: admin_services.php');
    exit();
}
$row = $result->fetch_assoc();
?>

<div class="container mt-5">
    <h2 class="text-center">Edit Service</h2>
    
    <?php if ($msg): ?>
        <?php echo $msg; ?>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($row['image']); ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" name="image" id="image">
            <?php if ($row['image']): ?>
                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" width="100" height="100">
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="rate">Rate</label>
            <input type="text" class="form-control" name="rate" id="rate" value="<?php echo htmlspecialchars($row['rate']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <a href="service.php" class="btn btn-secondary">Close</a>

      
    </form>
</div>

<?php
include('./includes/footer.php');
?>