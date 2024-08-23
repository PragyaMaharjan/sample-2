<?php
define('TITLE','Sell Product');
define('PAGE','assets');
include('./includes/header.php');
include('../requester/dbconnection.php');

session_start();
if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}

if (isset($_POST['psubmit'])) {
    // Check if all fields are filled
    if (($_POST['cname'] == "") || ($_POST['cadd'] == "") || ($_POST['pname']  == "") ||  
    ($_POST['pquantity']  == "") || ($_POST['psellingcost']  == "") || ($_POST['totalcost']  == "") || ($_POST['selldate'] =="")) {
        
        $msg = '<div class="alert alert-primary mt-2">FILL ALL FIELDS</div>';
    } else {
        // Your existing PHP logic
        $pid = $_POST['pid'];
        $pava = $_POST['pava'] - $_POST['pquantity'];

        $custname = $_POST['cname'];
        $custadd = $_POST['cadd'];
        $cpname = $_POST['pname'];
        $cpquantity = $_POST['pquantity'];
        $cpeach = $_POST['psellingcost'];
        $cptotal = $_POST['totalcost'];
        $cpdate = $_POST['selldate'];
        
        $sql = "INSERT INTO customer_tb(custname, custadd, cpname, cpquantity, cpeach, cptotal, cpdate)
            VALUES('$custname', '$custadd','$cpname','$cpquantity','$cpeach','$cptotal','$cpdate')";
        
        if ($conn->query($sql) === TRUE) {
            $genid = mysqli_insert_id($conn);
            $_SESSION['myid'] = $genid;
            echo "<script> location.href='sellsucessed.php'</script>";
        }

        $sqlup = "UPDATE assets_tb SET pava ='$pava' WHERE pid= '$pid'";
        $conn->query($sqlup);
    }
}
?>

<div class="col-sm-5 mt-5 mx-5 jumbotron">
    <h3 class="text-center">Customer bill</h3>
    <?php
    if(isset($_POST['issue'])){
        $sql = "SELECT * FROM assets_tb WHERE pid = {$_POST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc(); 
    }
    ?>

    <form action=""  method="POST">

    <div class="form-group">
        <label for="pid">Product ID </label>
        <input type="text" class="form-control" name="pid" id="pid" value="<?php if (isset($row['pid'])) { echo htmlspecialchars($row['pid']); } ?>" readonly>
    </div>

    <div class="form-group">
        <label for="cname">Customer Name </label>
        <input type="text" class="form-control" name="cname" id="cname">
    </div>

    <div class="form-group">
        <label for="cadd">Customer Address </label>
        <input type="text" class="form-control" name="cadd" id="cadd" >
    </div>

    <div class="form-group">
        <label for="pname">Product Name </label>
        <input type="text" class="form-control" name="pname" id="pname" value="<?php if (isset($row['pname'])) { echo htmlspecialchars($row['pname']); }?>">
    </div>

    <div class="form-group">
        <label for="pava">Available </label>
        <input type="text" class="form-control" name="pava" id="pava" onkeypress="isInputNumber(event)"  value="<?php if (isset($row['pava'])) { echo htmlspecialchars($row['pava']); } ?>" readonly>
    </div>

    <div class="form-group">
        <label for="pquantity">Quantity </label>
        <input type="text" class="form-control" name="pquantity" id="pquantity" onkeypress="isInputNumber(event)" >
    </div>

    <div class="form-group">
        <label for="psellingcost">Price Each </label>
        <input type="text" class="form-control" name="psellingcost" id="psellingcost" onkeypress="isInputNumber(event)" value="<?php if (isset($row['psellingcost'])) { echo htmlspecialchars($row['psellingcost']); } ?>" >
    </div>

    <div class="form-group">
        <label for="totalcost">Total Price </label>
        <input type="text" class="form-control" name="totalcost" id="totalcost" onkeypress="isInputNumber(event)">
    </div>

    <div class="form-group">
        <label for="inputDate">Date </label>
        <input type="date" class="form-control" name="selldate" id="inputDate" value="<?php if (isset($row['cpdate'])) { echo htmlspecialchars($row['cpdate']); } ?>">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-danger" id="psubmit" name="psubmit">Submit</button>
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