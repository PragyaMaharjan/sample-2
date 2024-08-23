<?php
define('TITLE','ChangePassword');
define('PAGE','changepass');
include('./includes/header.php');
include('../requester/dbconnection.php');

session_start();
if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}

$aEmail = $_SESSION['aEmail'];

if(isset($_POST['passupdate'])){
    if($_POST['apassword']== ""){
        $passmsg = '<div class="alert alert-info col-sm-6 ml-5 mt-2">
        fill all fields
        </div>';
    }
    else{

        $aPass = $_POST['apassword'];
        $sql = "UPDATE adminlogin_tb SET a_password = '$aPass' WHERE a_email = '$aEmail' ";
        
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
            <input type="email" class="form-control"  id="inputEmail" value="<?php echo $aEmail;?>" readonly>      
              </div>

            <div class="form-group">
            <label for="inputnewpassword">New Password</label>
                <input type="password" class="form-control" name="apassword" id="inputnewpassword" placeholder="input new password" >
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
include('./includes/footer.php')
?>