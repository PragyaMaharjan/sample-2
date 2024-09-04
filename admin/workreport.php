<?php
define('TITLE', 'WorkReport');
define('PAGE', 'workreport');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}
?>
<style>
    @media print {
        .sidebar, .d-print-none {
            display: none !important;
        }
        .col-sm-9.col-md-10 {
            width: 100%;
        }
    }
</style>
<!-- start second column -->

<div class="col-sm-9 col-md-10 mt-5 text-center">
    <form action="" method="POST" class="d-print-none">
        <div class="form-row">
            <div class="form-group col-md-2">
                <input type="date" class="form-control" id="startdate" name="startdate" required>
            </div><span>to</span>

            <div class="form-group col-md-2">
                <input type="date" class="form-control" id="enddate" name="enddate" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-secondary" name="searchsubmit" value="Search">
            </div>
        </div>
    </form>
    
    <?php
    if (isset($_POST['searchsubmit'])) {
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];

        // Sanitize input to prevent SQL Injection
        $startdate = $conn->real_escape_string($startdate);
        $enddate = $conn->real_escape_string($enddate);

        // Correct SQL query
        $sql = "SELECT * FROM assignwork_tb WHERE assign_date BETWEEN '$startdate' AND '$enddate'";
        $result = $conn->query($sql);

        if ($result === false) {
            // Handle SQL errors
            echo '<div class="alert alert-danger">Query Error: ' . $conn->error . '</div>';
        } elseif ($result->num_rows > 0) {
            echo '<p class="bg-dark text-white p-2 mt-4">Details</p>';
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Req ID</th>';
            echo '<th scope="col">Request Name</th>';
            echo '<th scope="col">Name</th>';
            echo '<th scope="col">Address1</th>';
            echo '<th scope="col">Address2</th>';
            echo '<th scope="col">City</th>';
            echo '<th scope="col">Mobile</th>';
            echo '<th scope="col">Technician</th>';
            echo '<th scope="col">Assigned Date</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['request_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['request_info']) . '</td>';
                echo '<td>' . htmlspecialchars($row['requester_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['requester_add1']) . '</td>';
                echo '<td>' . htmlspecialchars($row['requester_add2']) . '</td>';
                echo '<td>' . htmlspecialchars($row['requester_city']) . '</td>';
                echo '<td>' . htmlspecialchars($row['requester_mobile']) . '</td>';
                echo '<td>' . htmlspecialchars($row['requester_tech']) . '</td>';
                echo '<td>' . htmlspecialchars($row['assign_date']) . '</td>';
                echo '</tr>';
            }

            echo '<tr>';
            echo '<td colspan="9" class="text-center">';
            echo '<input type="button" class="btn btn-danger" value="Print" onclick="window.print()"> ';
            echo '</td>';
            echo '</tr>';

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-warning col-sm-6 ml-5 mt-2">No Record Found!</div>';
        }
    }
    ?>
</div>

<?php
include('./includes/footer.php');
?>
