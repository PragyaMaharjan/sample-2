<?php
define('TITLE','profile');
define('PAGE', 'requestprofile');
include('includes/header.php');
include('dbconnection.php');
session_start();
if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
}else{
    echo "<script> location.href='loginrequest.php' </script>";
}
$sql = "SELECT r_name, r_email FROM registrationform_tb WHERE r_email = '$rEmail'";
$result = $conn->query($sql);
if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $rName = $row['r_name'];

}

if(isset($_POST['nameupdate'])){
    if($_POST['rName'] == ""){
        $passmsg = '<div class="alert alert-info col-sm-6 ml-5 mt-2 role="alert">Fill the field</div>';
    }else{
        $rName = $_POST['rName'];
        $sql = "UPDATE registrationform_tb SET r_name = '$rName' WHERE r_email = '$rEmail'";
        if($conn->query($sql) == TRUE){
            $passmsg = '<div class="alert alert-sucess col-sm-6 ml-5 mt-2" role="alert"> Upadate Sucessfully </div>';
        }else{
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Upadate </div>'; 
        }
    }
}
?>


            <div class="col-sm-6 mt-5">
            <form action="" method="POST" class="mx-5">
                <div class="form-group">
                    <label for="rEmail">Email</label>
                    <input type="email" class="form-control" name="rEmail" id="rEmail" value="<?php echo $rEmail ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="rName">Name</label>
                    <input type="text" class="form-control" name="rName" id="rName" value="<?php echo $rName ?>" >
                </div>
                <button type="submit" class="btn btn-info" name="nameupdate"> Update</button>
                <?php if(isset($passmsg)) {echo $passmsg;}?>
            </form>
            <!-- profile area 2nd col -->

        </div> <!-- endprofile area 2nd col -->
    
</form>
<?php
include('includes/footer.php')
?>