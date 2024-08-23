<?php
define('TITLE','Techinician');
define('PAGE','technician');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}
if(isset($_POST['empsubmit'])){
    if(($_POST['empName'] == "")||($_POST['empCity'] == "") || ($_POST['empMobile']== "") || ($_POST['empEmail'] == "") ){
        $msg = '<div class="alert alert-primary mt-2"> FILL ALL FILEDS </div>';
} else{
    $eName = $_POST['empName'];
    $eCity = $_POST['empCity'];
    $eMobile = $_POST['empMobile'];
    $eEmail = $_POST['empEmail'];
    
    $sql = "INSERT INTO  technician_tb SET  empName='$eName', empCity='$eCity', empMobile='$eMobile', empEmail='$eEmail'
    ";
    if ($conn->query($sql) == TRUE ){
        $msg = '<div class="alert alert-success mt-2"> Added Succesfully </div>';
    } else{
        $msg = '<div class="alert alert-danger mt-2"> Unable to Add </div>';
    }
    }
}
?>

<!-- start second column -->

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add new Technician</h3>
    <form action="" method="POST" >

    <div class="form-group">
        <label for="empName">Name</label>
        <input type="text" class="form-control" name="empName" id="empName" >
    </div>

    <div class="form-group">
        <label for="empCity">City</label>
        <input type="text" class="form-control" name="empCity" id="empCity" >
    </div>

    <div class="form-group">
        <label for="empMobile">Mobile</label>
        <input type="text" class="form-control" name="empMobile" id="empMobile" onkeypress="isInputNumber(event)" >
    </div>

    <div class="form-group">
        <label for="empCity">Email</label>
        <input type="email" class="form-control" name="empEmail" id="empEmail" >
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-danger" id="empsubmit" name="empsubmit">Submit</button>
        <a href="technician.php" class="btn btn-secondary">close</a>
    </div>

    <?php
    if(isset($msg)){echo $msg;}
    ?>
    </form>
</div>

<script>

function isInputNumber(evt) { 
    var ch = String.fromCharCode(evt.which); 
    if (!(/[0-9]/.test(ch))) { evt.preventDefault(); } }

</script>

<?php
include('./includes/footer.php')
?>