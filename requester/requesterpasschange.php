<?php
define('TITLE','Change Password');
define('PAGE','requesterpasschange');

include('includes/header.php');
include('dbconnection.php');

session_start();
if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
}else{
    echo "<script> location.href='loginrequest.php' </script>";
}

$rEmail = $_SESSION['rEmail'];

if(isset($_POST['passupdate'])){
    if($_POST['rPassword']== ""){
        $passmsg = '<div class="alert alert-info col-sm-6 ml-5 mt-2">
        fill all fields
        </div>';
    }
    else{

        $rPass = $_POST['rPassword'];
        $sql = "UPDATE registrationform_tb SET r_password = '$rPass' WHERE r_email = '$rEmail' ";
        
        if($conn->query($sql)== TRUE){
            $passmsg = '<div class="alert alert-sucess col-sm-6 ml-5 mt-2">
            Updated Sucessfully
            </div>';
        }else{
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">
               unnable to upadate
                </div>';
        }
    }
   
}



?>
<div class="col-sm-8 col-m-10"><!-- user form 2nd col -->
<form action="" method="POST">
<div class="" class="form-group">
          <label for="inputEmail">Email</label>
            <input type="email" class="form-control"  id="inputEmail" value="<?php echo $rEmail;?>" readonly>      
              </div>

            <div class="form-group">
            <label for="inputnewpassword">New Password</label>
                <input type="password" class="form-control" name="rPassword" id="inputnewpassword" placeholder="input new password" >
                </div>
                <button type="submit" class="btn btn-info" name="passupdate"> Update</button>
                <button type="reset" class="btn btn-secondary" > Reset</button>
                <?php
                if(isset($passmsg))
                {
                    echo $passmsg;
                }
                ?>
                
</form>
</div> <!-- end user -->

<?php
include('includes/footer.php')
?>