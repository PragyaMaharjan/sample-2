<?php
define('TITLE','Submit Request');
define('PAGE','submitrequest');
include('includes/header.php');
include('dbconnection.php');

session_start();
if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
}else{
    echo "<script> location.href='loginrequest.php' </script>";
}

if(isset($_POST['submitrequest'])){
    //checking for empty fields
    if(($_POST['requestinfo']== "") || ($_POST['requestdesc'] == "") || ($_POST['requestername'] == "") || 
    ($_POST['requesteradd1'] == "") 
 || ($_POST['requesteradd2'] == "") || ($_POST['requestercity'] == "")
||  ($_POST['requesterstate'] == "")
||  ($_POST['requesteremail'] == "") ||  ($_POST['requestermobile'] == "") ||  ($_POST['requestermobile'] == "") 
||  ($_POST['requestdate'] == "")   ){
        $msg = "<div class='alert alert-info col-sm-6 ml-5 mt-2'>Fill All Feilds</div>";
    }
    else{
 
      $rinfo = $_POST['requestinfo'];
      $rdesc = $_POST['requestdesc'];
      $rname = $_POST['requestername'];
      $radd1 = $_POST['requesteradd1'];
      $radd2 = $_POST['requesteradd2'];
      $rcity = $_POST['requestercity'];
      $rstate = $_POST['requesterstate'];
     
      $remail = $_POST['requesteremail'];
      $rmobile = $_POST['requestermobile'];
      $rdate = $_POST['requestdate'];

      $sql = "INSERT INTO submitrequest_tb(request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_email, requester_mobile, request_date )
      VALUES('$rinfo','$rdesc','$rname','$radd1','$radd2','$rcity','$rstate','$remail','$rmobile','$rdate')";

      if($conn->query($sql) == TRUE){

        $genid = mysqli_insert_id($conn);

        $msg ="<div class='alert alert-success col-sm-6 ml-5 mt-2'>Request Submit Sucessfully</div>";
      
        $_SESSION['myid'] = $genid;
        echo "<script> location.href='submitrequestsucess.php' </script>";
  
    }else{
        $msg ="<div class='alert alert-danger col-sm-6 ml-5 mt-2'>Unable to Submit</div>";
      }
    }
}
?>
<!-- start service request form 2nd column -->
<div class="col-sm-9 col-md-10 mt-5">
    <form class="mx-5" action="" method="POST">
        <div class="form-group">
            <label for="inputRequestInfo">Request Info</label>
            <input type="text" class="form-control" id="inputRequestInfo" placeholder="Request Info" name="requestinfo">
        </div>
        
        <div class="form-group">
            <label for="inputRequestDescription">Description</label>
            <input type="text" class="form-control" id="inputRequestDescription" placeholder="Write Description" name="requestdesc">
        </div>

        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="inputName" placeholder="Your Name" name="requestername">
        </div>

        
        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputAddress">Address Line 1</label>
            <input type="text" class="form-control" id="inputAddress1" placeholder="House no. 123" name="requesteradd1">
        </div>

        <div class="form-group col-md-6">
            <label for="inputAddress2">Address Line 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="House no. 123" name="requesteradd2">
        </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" id="inputCity"  name="requestercity">
        </div>

        <div class="form-group col-md-4">
            <label for="inputState">State</label>
            <input type="text" class="form-control" id="inputState"  name="requesterstate">
        </div>

        
     </div>



     <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail"  name="requesteremail">
        </div>

        <div class="form-group col-md-2">
            <label for="inputMobile">Mobile</label>
            <input type="text" class="form-control" id="inputMobile"  name="requestermobile" onkeypress="isInputNumber(event)">
        </div>

        <div class="form-group col-md-2">
            <label for="inputDate">Date</label>
            <input type="date" class="form-control" id="inputDate" name="requestdate" >
        </div>
     </div>
     
     <button type="submit" class="btn btn-info  " name="submitrequest">Submit</button>
     <button type="reset" class="btn btn-secondary" >Reset</button>

    </form>

    <?php
    if(isset($msg)){
        echo $msg;
    }
    ?>

</div> 

<!-- end service request form 2nd column -->
 
<!-- only number for infut flieds -->

<script>

function isInputNumber(evt) { 
    var ch = String.fromCharCode(evt.which); 
    if (!(/[0-9]/.test(ch))) { evt.preventDefault(); } }

</script>

</form>
<?php
include('includes/footer.php')
?>