<?php
include('../requester/dbconnection.php');

session_start();
if(!isset($_SESSION['is_adminlogin'])){
if(isset($_REQUEST['aEmail']))
{
$aEmail = mysqli_real_escape_string($conn, trim ($_POST['aEmail']));
$aPassword =mysqli_real_escape_string($conn, trim( $_POST['aPassword']));
$sql = "SELECT a_email, a_password FROM adminlogin_tb 
WHERE a_email = '".$aEmail."' AND a_password='".$aPassword."' limit 1";
$result = $conn->query($sql);
if($result->num_rows == 1){
    $_SESSION['is_adminlogin']= true;
    $_SESSION['aEmail']=$aEmail;

    echo "<script>location.href='dashboard.php';</script>";
    exit;
} else{
$msg = '<div class="alert alert-primary mt-2"> Enter Valid Email and Password </div>';

}
}
}
else{
    echo "<script>location.href='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- bootstrap Css -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
      <!-- font Awesome Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="../cssss/custom.css">
    <title>kirtipur service provider</title>
    <title>Document</title>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info  ">
<div class="content-right">
            <img src="../images/logo.jpg" alt="" width="60px" height="auto">   
        </div>
</nav>

<div class="mt-11 pt-5 text-center" style="font-size:30px">

    <span>
        Kirtipur Online Services
    </span>
</div>

<div class="container-fuild border-0">
    <div class="row justify-content-center mt-5">
      <div class="col-sm-6 col-md-4">

      <form action=""class="shadow-lg p-4" method="POST">
        <div class="form-group">
            <i class="fas fa-user"></i>
            <label for="email" class="font-weight-bold">Email</label><input type="email" class="form-control"
            placeholder="enter your email" name="aEmail">
            <small> Your Email will be secured</small>
        
        <div class="form-group">
        <i class="fas fa-key"></i>
            <label for="password" class="font-weight-bold">Password</label><input type="password" class="form-control"
            placeholder="enter your password" name="aPassword">
        </div>

        <button type="submit" class="btn btn-info mt-5 btn-block shadow-sm font-weight-bold">
            Login
        </button>

        <?php
        if(isset($msg)) {
            echo $msg;
        }
        
        ?>
        </div>
      </form>
      </div>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>