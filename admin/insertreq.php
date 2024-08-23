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
if(isset($_POST['reqsubmit'])){
    if(($_POST['r_name'] == "")
    ||($_POST['r_email'] == "") || ($_POST['r_password'] == "") ){
        $msg = '<div class="alert alert-primary mt-2"> FILL ALL FILEDS </div>';
} else{
    $name = $_POST['r_name'];
    $email = $_POST['r_email'];
    $password = $_POST['r_password'];
    $sql = "UPDATE registrationform_tb SET  r_name='$name', r_email='$email'";
    if ($conn->query($sql) == TRUE ){
        $msg = '<div class="alert alert-success mt-2"> Updated Succesfully </div>';
    } else{
        $msg = '<div class="alert alert-danger mt-2"> Unable to update </div>';
    }
    }
}
?>

<!-- start second column -->

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add new Requester Details</h3>
    <form action="" method="POST" >

    <div class="form-group">
        <label for="r_name">Name</label>
        <input type="text" class="form-control" name="r_name" id="r_name" >
    </div>

    <div class="form-group">
        <label for="r_email">Email</label>
        <input type="email" class="form-control" name="r_email" id="r_email" >
    </div>

    <div class="form-group">
        <label for="r_password">Password</label>
        <input type="password" class="form-control" name="r_password" id="r_password" >
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-danger" id="reqsubmit" name="reqsubmit">Submit</button>
        <a href="requester.php" class="btn btn-secondary">close</a>
    </div>

    <?php
    if(isset($msg)){echo $msg;}
    ?>

</div>

<?php
include('./includes/footer.php')
?>