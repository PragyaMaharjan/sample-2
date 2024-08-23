<?php
define('TITLE','Update Product');
define('PAGE','assets');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}
if (isset($_POST['pupdate'])) {
    // Check if all fields are filled
    if (empty($_POST['pname']) || empty($_POST['pdop']) || empty($_POST['pava']) || 
        empty($_POST['ptotal']) || empty($_POST['poriginalcost']) || empty($_POST['psellingcost'])) {
        $msg = '<div class="alert alert-primary mt-2"> FILL ALL FIELDS </div>';
    } else {
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pdop = $_POST['pdop'];
        $pava = $_POST['pava'];
        $ptotal = $_POST['ptotal'];
        $poriginalcost = $_POST['poriginalcost'];
        $psellingcost = $_POST['psellingcost'];
        
        $sql = "UPDATE assets_tb SET pname='$pname', pdop='$pdop', pava='$pava', ptotal='$ptotal', poriginalcost='$poriginalcost', psellingcost='$psellingcost' 
        WHERE pid='$pid'";

if ($conn->query($sql) === TRUE) {
    $msg = '<div class="alert alert-success mt-2"> Added Successfully </div>';
} else {
    $msg = '<div class="alert alert-danger mt-2"> Unable to Add </div>';
}
}
}
?>


<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update products</h3>
<?php
if(isset($_POST['edit'])){
    $sql = "SELECT * FROM assets_tb WHERE pid = {$_POST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); 
  
    }
?>

    <form action=""  method="POST">

    <div class="form-group">
            <label for="pid">Product ID </label>
            <input type="text" class="form-control" name="pid" id="pid" value="<?php  if (isset($row['pid'])) { echo htmlspecialchars($row['pid']); }  ?>" readonly>
        </div>

    <div class="form-group">
            <label for="pname">Product Name </label>
            <input type="text" class="form-control" name="pname" id="pname" value="<?php if (isset($row['pname'])) { echo htmlspecialchars($row['pname']); }?>">
        </div>

        <div class="form-group">
            <label for="pdop">Date of Purchase </label>
            <input type="date" class="form-control" name="pdop" id="pdop" value="<?php if (isset($row['pdop'])) { echo htmlspecialchars($row['pdop']); } ?>" >
        </div>

        <div class="form-group">
            <label for="pava">Available </label>
            <input type="text" class="form-control" name="pava" id="pava" onkeypress="isInputNumber(event)"  value="<?php if (isset($row['pava'])) { echo htmlspecialchars($row['pava']); } ?>">
        </div>

        <div class="form-group">
            <label for="ptotal">Total </label>
            <input type="text" class="form-control" name="ptotal" id="ptotal" onkeypress="isInputNumber(event)"  value="<?php if (isset($row['ptotal'])) { echo htmlspecialchars($row['ptotal']); } ?>"  >
        </div>

        <div class="form-group">
            <label for="poriginalcost">Original Cost Each </label>
            <input type="text" class="form-control" name="poriginalcost" id="poriginalcost" onkeypress="isInputNumber(event)"  value="<?php if (isset($row['poriginalcost'])) { echo htmlspecialchars($row['poriginalcost']); } ?>" >
        </div>

        <div class="form-group">
            <label for="psellingcost">Selling Cost Each </label>
            <input type="text" class="form-control" name="psellingcost" id="psellingcost" onkeypress="isInputNumber(event)" value="<?php if (isset($row['psellingcost'])) { echo htmlspecialchars($row['psellingcost']); } ?>" >
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="pupdate" name="pupdate">Update</button>
            <a href="assets.php" class="btn btn-secondary">Close</a>
        </div>

    </form>

    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>
</div>

<script>
function isInputNumber(evt) { 
    var ch = String.fromCharCode(evt.which); 
    if (!(/[0-9]/.test(ch))) { evt.preventDefault(); } 
}
</script>



<?php
include('./includes/footer.php')
?>