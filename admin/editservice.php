<?php
define('TITLE', 'Edit Service');
define('PAGE', 'service');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

if (!isset($_SESSION['is_adminlogin'])) {
    header('Location: login.php');
    exit();
}
?>

<!-- start 2nd column -->
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Service</h3>
    <?php 
    if (isset($_POST['edit'])) {
        $sql = "SELECT * FROM categories_tb WHERE id = {$_POST['id']}";
        $result = $conn->query($sql);
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
        } else {
            echo '<div class="alert alert-danger mt-2">Service not found or multiple records found.</div>';
        }
    }

    if (isset($_POST['requpdate'])) {
        if (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['description']) || empty($_POST['created_at'])) {
            $msg = '<div class="alert alert-primary mt-2">Fill All Fields</div>';
        } else {
            $rid = $_POST['id'];
            $name = $conn->real_escape_string($_POST['name']);
            $description = $conn->real_escape_string($_POST['description']);
            $created_at = $conn->real_escape_string($_POST['created_at']);
            
            // Handle the image upload
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $imageName = $_FILES['image']['name'];
                $imageTmpName = $_FILES['image']['tmp_name'];
                $imageFolder = '../uploads/' . $imageName;
                
                // Move uploaded image to the folder
                move_uploaded_file($imageTmpName, $imageFolder);
            } else {
                $imageFolder = $row['image']; // If no new image is uploaded, use the old image path
            }

            $sql = "UPDATE categories_tb SET name='$name', description='$description', image='$imageFolder', created_at='$created_at' WHERE id='$rid'";
            if ($conn->query($sql) === TRUE) {
                $msg = '<div class="alert alert-success mt-2">Updated Successfully</div>';
            } else {
                $msg = '<div class="alert alert-danger mt-2">Unable to Update</div>';
            }
        }
    }
    ?>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id">Service ID</label>
            <input type="text" class="form-control" name="id" id="id" value="<?php if (isset($row['id'])) { echo $row['id']; } ?>" >
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php if (isset($row['name'])) { echo $row['name']; } ?>">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description"><?php if (isset($row['description'])) { echo $row['description']; } ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" name="image" id="image">
            <?php if (isset($row['image']) && $row['image'] != ""): ?>
                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100" height="100">
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="created_at">Created At</label>
            <input type="date" class="form-control" name="created_at" id="created_at" value="<?php if (isset($row['created_at'])) { echo $row['created_at']; } ?>">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requdate" name="requpdate">Update</button>
            <a href="service.php" class="btn btn-secondary">Close</a>
        </div>
    </form>

    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
</div>
<!-- end 2nd column -->

<?php
include('./includes/footer.php');
?>
