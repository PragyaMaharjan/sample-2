<?php
define('TITLE','Work');
define('PAGE','work');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}
?>
<!-- second start -->

<div class="col-sm-6 mt-5 mx-3 ">
    <h3 class="text-center">Assigned Work Details</h3>
    <?php
    if(isset($_POST['view'])){
        $sql = "SELECT * FROM assignwork_tb WHERE request_id = {$_POST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc(); }?>
         <table class="table table-bordered">
                    <tbody>
                        <tr><td>Request ID</td><td><?php echo htmlspecialchars($row['request_id']); ?></td></tr>
                        <tr><td>Request Info</td><td><?php echo htmlspecialchars($row['request_info']); ?></td></tr>
                        <tr><td>Request Description</td><td><?php echo htmlspecialchars($row['request_desc']); ?></td></tr>
                        <tr><td>Requester Name</td><td><?php echo htmlspecialchars($row['requester_name']); ?></td></tr>
                        <tr><td>Requester Address1</td><td><?php echo htmlspecialchars($row['requester_add1']); ?></td></tr>
                        <tr><td>Requester Address2</td><td><?php echo htmlspecialchars($row['requester_add2']); ?></td></tr>
                        <tr><td>Requester City</td><td><?php echo htmlspecialchars($row['requester_city']); ?></td></tr>
                        <tr><td>Requester State</td><td><?php echo htmlspecialchars($row['requester_state']); ?></td></tr>
                        <tr><td>Requester Email</td><td><?php echo htmlspecialchars($row['requester_email']); ?></td></tr>
                        <tr><td>Requester Mobile</td><td><?php echo htmlspecialchars($row['requester_mobile']); ?></td></tr>
                        <tr><td>Requester Technician</td><td><?php echo htmlspecialchars($row['requester_tech']); ?></td></tr>
                        <tr><td>Assign Date</td><td><?php echo htmlspecialchars($row['assign_date']); ?></td></tr>
                        <tr><td>Customer Sign</td><td></td></tr>
                        <tr><td>Technician Sign</td><td></td></tr>
                    </tbody>
                </table>
                <div class="text-center">
                <form action="">
                <input class="btn btn-info d-print-none" type="button" value="Print"  onclick="window.print();">
                <input class="btn btn-secondary d-print-none" type="button" value="Close"  onclick="window.history.back();">
                </form>
                </div>
    

<!-- end second -->
<?php
include('./includes/footer.php')
?>