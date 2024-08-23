<?php
define('TITLE', 'Update');
define('PAGE', 'technician');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

// Check if the user is an admin
if (!isset($_SESSION['is_adminlogin'])) {
    header('Location: login.php');
    exit();
}

$msg = ''; // Initialize message variable
$row = []; // Initialize row variable

// Check if the form was submitted to edit
if (isset($_POST['edit'])) {
    $empId = intval($_POST['id']); // Ensure empId is an integer

    // Debugging: Check if empId is set and valid
    if ($empId > 0) {
        // Use prepared statements for safer SQL queries
        $stmt = $conn->prepare("SELECT * FROM technician_tb WHERE empId = ?");
        $stmt->bind_param('i', $empId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        // Debugging: Output fetched data
        // echo "<pre>"; print_r($row); echo "</pre>";
    } else {
        $msg = '<div class="alert alert-warning mt-2">Invalid Employee ID</div>';
    }
}

// Check if the form was submitted to update
if (isset($_POST['empupdate'])) {
    // Check if required fields are not empty
    if (empty($_POST['empId']) || empty($_POST['empName']) || empty($_POST['r_email'])) {
        $msg = '<div class="alert alert-primary mt-2">FILL ALL FIELDS</div>';
    } else {
        $rid = $_POST['empid'];
        $name = $_POST['empName'];
        $email = $_POST['empEmail'];
        $mobile = $_POST['empMobile'];
        $city = $_POST['empCity'];

        // Use prepared statements for safer SQL queries
        $stmt = $conn->prepare("UPDATE technician_tb SET empName = ?, empEmail = ?, empMobile = ?, empCity = ? WHERE empid = ?");
        $stmt->bind_param('ssssi', $name, $email, $mobile, $city, $rid);

        if ($stmt->execute()) {
            $msg = '<div class="alert alert-success mt-2">Updated Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger mt-2">Unable to update</div>';
        }
        $stmt->close();
    }
}
?>

<!-- start 2nd column -->
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Requester Details</h3>
    <form action="" method="POST">
    <div class="form-group">
            <label for="empid">ID</label>
            <input type="text" class="form-control" name="empid" id="empid" value="<?php if (isset($row['empid'])) { echo htmlspecialchars($row['empid']); } ?>" readonly>
        </div>

        <div class="form-group">
            <label for="empName">Name</label>
            <input type="text" class="form-control" name="empName" id="empName" value="<?php if (isset($row['empName'])) { echo htmlspecialchars($row['empName']); } ?>">
        </div>

        <div class="form-group">
            <label for="empCity">City</label>
            <input type="text" class="form-control" name="empCity" id="empCity" value="<?php if (isset($row['empCity'])) { echo htmlspecialchars($row['empCity']); } ?>">
        </div>

        <div class="form-group">
            <label for="empMobile">Mobile</label>
            <input type="text" class="form-control" name="empMobile" id="empMobile" value="<?php if (isset($row['empMobile'])) { echo htmlspecialchars($row['empMobile']); } ?>" onkeypress="isInputNumber(event)">
        </div>

        <div class="form-group">
            <label for="empEmail">Email</label>
            <input type="email" class="form-control" name="empEmail" id="empEmail" value="<?php if (isset($row['empEmail'])) { echo htmlspecialchars($row['empEmail']); } ?>">
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="empupdate" name="empupdate">Update</button>
            <a href="requester.php" class="btn btn-secondary">Close</a>
        </div>
    </form>

    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>
</div>
<!-- end second column -->

<script>
function isInputNumber(evt) { 
    var ch = String.fromCharCode(evt.which); 
    if (!(/[0-9]/.test(ch))) { evt.preventDefault(); } 
}
</script>

<?php
include('./includes/footer.php');
$conn->close(); // Close the database connection
?>
