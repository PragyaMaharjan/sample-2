<?php
if(session_id() == ''){
    session_start();
}
if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}
if(isset($_POST['view'])){
    $sql = "SELECT * FROM submitrequest_tb WHERE 
    request_id={$_POST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if(isset($_POST['close'])){
    $sql = "DELETE FROM submitrequest_tb WHERE 
    request_id={$_POST['id']}";
    if($conn->query($sql) == TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?closed"/>';

    } else{
        echo "unable to delete";
    }
}

if (isset($_POST['assign'])) {
    $requiredFields = ['request_id', 'requestinfo', 'requestdesc', 'requestername', 'requesteradd1', 'requesteradd2', 'requestercity', 'requesterstate', 'requesteremail', 'requestermobile', 'assigntech', 'inputdate'];
    $allFilled = true;
    
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $allFilled = false;
            break;
        }
    }
    
    if (!$allFilled) {
        $msg = '<div class="alert-warning col-sm-6 ml-5 mt-2">All fields are required</div>';
    } else {
        $rid = $conn->real_escape_string($_POST['request_id']);
        $rinfo = $conn->real_escape_string($_POST['requestinfo']);
        $rdesc = $conn->real_escape_string($_POST['requestdesc']);
        $rname = $conn->real_escape_string($_POST['requestername']);
        $radd1 = $conn->real_escape_string($_POST['requesteradd1']);
        $radd2 = $conn->real_escape_string($_POST['requesteradd2']);
        $rcity = $conn->real_escape_string($_POST['requestercity']);
        $rstate = $conn->real_escape_string($_POST['requesterstate']);
     
        $remail = $conn->real_escape_string($_POST['requesteremail']);
        $rmobile = $conn->real_escape_string($_POST['requestermobile']);
        $rassigntech = $conn->real_escape_string($_POST['assigntech']);
        $rdate = $conn->real_escape_string($_POST['inputdate']);

        $sql = "INSERT INTO assignwork_tb (request_id, request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state,  requester_email, requester_mobile, requester_tech, assign_date)
                VALUES ('$rid', '$rinfo', '$rdesc', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$remail', '$rmobile', '$rassigntech', '$rdate')";
        
        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert-success col-sm-6 ml-5 mt-2">Work assigned successfully</div>';
        } else {
            $msg = '<div class="alert-danger col-sm-6 ml-5 mt-2">Unable to assign work</div>';
        }
    }
}

?>

<div class="col-sm-5 mt-5 jumbotron">
    <form action="" method="POST">
        <h5 class="text-center">Assign Work Order Request</h5>

        <div class="form-group">
            <label for="request_id">Request ID</label>
            <input type="text" class="form-control" id="request_id"  name="request_id" value="<?php if(isset($row['request_id']))echo $row['request_id'];?>" readonly>
        </div>
        
       
        <div class="form-group">
            <label for="inputRequestInfo">Request Info</label>
            <input type="text" class="form-control" id="inputRequestInfo" placeholder="Request Info" name="requestinfo"  value="<?php if(isset($row['request_info']))echo $row['request_info'];?>">
        </div>
        
        <div class="form-group">
            <label for="inputRequestDescription">Description</label>
            <input type="text" class="form-control" id="inputRequestDescription" placeholder="Write Description" name="requestdesc"  value="<?php if(isset($row['request_desc']))echo $row['request_desc'];?>">
        </div>

        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="inputName" placeholder="Your Name" name="requestername"  value="<?php if(isset($row['requester_name']))echo $row['requester_name'];?>">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress1">Address Line 1</label>
                <input type="text" class="form-control" id="inputAddress1" placeholder="House no. 123" name="requesteradd1"  value="<?php if(isset($row['requester_add1']))echo $row['requester_add1'];?>">
            </div>

            <div class="form-group col-md-6">
                <label for="inputAddress2">Address Line 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apt. 456" name="requesteradd2" value="<?php if(isset($row['requester_add1']))echo $row['requester_add2'];?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="requestercity" value="<?php if(isset($row['requester_city']))echo $row['requester_city'];?>">
            </div>

            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <input type="text" class="form-control" id="inputState" name="requesterstate" value="<?php if(isset($row['requester_state']))echo $row['requester_state'];?>">
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="requesteremail" value="<?php if(isset($row['requester_email']))echo $row['requester_email'];?>">
            </div>

            <div class="form-group col-md-6">
                <label for="inputMobile">Mobile</label>
                <input type="text" class="form-control" id="inputMobile" name="requestermobile" value="<?php if(isset($row['requester_mobile']))echo $row['requester_mobile'];?>" onkeypress="isInputNumber(event)">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="assigntech">Assign to Technician</label>
                <input type="text" class="form-control" id="assigntech" name="assigntech">
            </div>

            <div class="form-group col-md-4">
                <label for="inputDate">Date</label>
                <input type="date" class="form-control" id="inputDate" name="inputdate" >
            </div>
        </div>

        <div class="float-right mt-5">
            <button type="submit" class="btn btn-info  mr-3" name="assign">Assign</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
 
        </div>
    </form>

    <?php
if (isset($msg)) {
    echo $msg;
}
?>
</div>

<script>

function isInputNumber(evt) { 
    var ch = String.fromCharCode(evt.which); 
    if (!(/[0-9]/.test(ch))) { evt.preventDefault(); } }

</script>
