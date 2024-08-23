<?php
define('TITLE','Requester');
define('PAGE','requester');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}
?>

<!-- start 2nd column -->
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Upadate Requester Details</h3>
    <?php 
    if(isset($_POST['edit'])){
        $sql = "SELECT * FROM registrationform_tb WHERE r_login_id = {$_POST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc(); 
      
        }
        if(isset($_POST['requpdate'])){
            if(($_POST['r_login_id'] == "") || ($_POST['r_name'] == "")
            ||($_POST['r_email'] == "") ){
                $msg = '<div class="alert alert-primary mt-2"> FILL ALL FILEDS </div>';
        } else{
            $rid = $_POST['r_login_id'];
            $name = $_POST['r_name'];
            $email = $_POST['r_email'];
            $sql = "UPDATE registrationform_tb SET r_login_id = '$rid', r_name='$name', r_email='$email'
            WHERE r_login_id = '$rid'";
            if ($conn->query($sql) == TRUE ){
                $msg = '<div class="alert alert-success mt-2"> Updated Succesfully </div>';
            } else{
                $msg = '<div class="alert alert-danger mt-2"> Unable to update </div>';
            }
            }
        }
        ?>
<form action="" method="POST" >
    <div class="form-group">
        <label for="r_login_id">Requester ID</label>
        <input type="text" class="form-control" name="r_login_id" id="r_login_id" value="<?php if(isset($row['r_login_id'])){echo $row['r_login_id'];}?>" readonly>
    </div>

    <div class="form-group">
        <label for="r_name">Name</label>
        <input type="text" class="form-control" name="r_name" id="r_name" value="<?php if(isset($row['r_name'])){echo $row['r_name'];}?>" >
    </div>

    <div class="form-group">
        <label for="r_email">Email</label>
        <input type="email" class="form-control" name="r_email" id="r_email" value="<?php if(isset($row['r_email'])){echo $row['r_email'];}?>">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-danger" id="requdate" name="requpdate">Update</button>
        <a href="requester.php" class="btn btn-secondary">close</a>
    </div>
    
            </form>

            <?php
            if(isset($msg))
            {
                echo $msg;
            }
            ?>
</div>
<!-- end second column -->


<?php
include('./includes/footer.php')
?>