<?php
define('TITLE', 'Check Status');
define('PAGE', 'checkstatus');
include('includes/header.php');
include('dbconnection.php');

session_start();
if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='loginrequest.php'; </script>";
    exit();
}

$rEmail = $_SESSION['rEmail'];
?>

<!-- start second column -->

<div class="col-sm-6 mt-5 mx-3">
    <form action="" method="POST" class="form-inline">
        <div class="form-group mr-3">
            <label for="checkid">Enter Request ID:</label>
            <input type="text" class="form-control" name="checkid" id="checkid" onkeypress="isInputNumber(event)">
        </div>
        <button type="submit" class="btn btn-info" name="searchsubmit">Search</button>
    </form>

    <?php
    if (isset($_POST['searchsubmit'])) {
        $checkid = $_POST['checkid'];

        if (empty($checkid)) {
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">All fields are required</div>';
        } else {
            // Using prepared statements to prevent SQL injection
            $stmt = $conn->prepare("SELECT * FROM assignwork_tb WHERE request_id = ?");
            $stmt->bind_param("i", $checkid);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
    
                <h3 class="text-center mt-5">Assigned Work Details</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Request ID</td>
                            <td><?php echo htmlspecialchars($row['request_id']); ?></td>
                        </tr>
                        <tr>
                            <td>Request Info</td>
                            <td><?php echo htmlspecialchars($row['request_info']); ?></td>
                        </tr>
                        <tr>
                            <td>Request Description</td>
                            <td><?php echo htmlspecialchars($row['request_desc']); ?></td>
                        </tr>
                        <tr>
                            <td>Requester Name</td>
                            <td><?php echo htmlspecialchars($row['requester_name']); ?></td>
                        </tr>
                        <tr>
                            <td>Requester Address 1</td>
                            <td><?php echo htmlspecialchars($row['requester_add1']); ?></td>
                        </tr>
                        <tr>
                            <td>Requester Address 2</td>
                            <td><?php echo htmlspecialchars($row['requester_add2']); ?></td>
                        </tr>
                        <tr>
                            <td>Requester City</td>
                            <td><?php echo htmlspecialchars($row['requester_city']); ?></td>
                        </tr>
                        <tr>
                            <td>Requester State</td>
                            <td><?php echo htmlspecialchars($row['requester_state']); ?></td>
                        </tr>
                        <tr>
                            <td>Requester Email</td>
                            <td><?php echo htmlspecialchars($row['requester_email']); ?></td>
                        </tr>
                        <tr>
                            <td>Requester Mobile</td>
                            <td><?php echo htmlspecialchars($row['requester_mobile']); ?></td>
                        </tr>
                        <tr>
                            <td>Requester Technician</td>
                            <td><?php echo htmlspecialchars($row['requester_tech']); ?></td>
                        </tr>
                        <tr>
                            <td>Assign Date</td>
                            <td><?php echo htmlspecialchars($row['assign_date']); ?></td>
                        </tr>
                        <tr>
                            <td>Customer Sign</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Technician Sign</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="text-center">
                    <form>
                        <input class="btn btn-info" type="button" value="Print" onclick="window.print()">
                        <a href="checkstatus.php" class="btn btn-secondary">Close</a>
                    </form>
                </div>
                
                <?php
            } else {
                echo '<div class="alert alert-warning mt-4">Your Request is Still Pending</div>';
            }
            
            $stmt->close();
        }
    }

    if (isset($msg)) {
        echo $msg;
    }
    ?>
</div>
<!-- end second column -->

<script>
function isInputNumber(evt) { 
    var ch = String.fromCharCode(evt.which); 
    if (!(/[0-9]/.test(ch))) { evt.preventDefault(); } 
}
</script>

<?php
include('includes/footer.php');
?>
