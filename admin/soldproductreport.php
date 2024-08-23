<?php
define('TITLE', 'SoldProducts');
define('PAGE', 'sellreport');
include('./includes/header.php');
include('../requester/dbconnection.php');

session_start();
if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}
?>

<!-- start second column -->

<div class="col-sm-9 col-md-10 mt-5 text-center">
    <form action="" method="POST" class="d-print-none">
        <div class="form-row">
            <div class="form-group col-md-2">
                <input type="date" class="form-control" id="startdate" name="startdate">
            </div>
            <span>to</span>
            <div class="form-group col-md-2">
                <input type="date" class="form-control" id="enddate" name="enddate">
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

        // Check if the dates are valid
        if (!empty($startdate) && !empty($enddate)) {
            $sql = "SELECT * FROM customer_tb WHERE cpdate BETWEEN '$startdate' AND '$enddate'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<p class="bg-dark text-white p-2 mt-4">Details</p>';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Customer ID</th>';
                echo '<th scope="col">Customer Name</th>';
                echo '<th scope="col">Address</th>';
                echo '<th scope="col">Product Name</th>';
                echo '<th scope="col">Quantity</th>';
                echo '<th scope="col">Price Each</th>';
                echo '<th scope="col">Total</th>';
                echo '<th scope="col">Date</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['custid']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['custname']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['custadd']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['cpname']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['cpquantity']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['cpeach']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['cptotal']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['cpdate']) . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';

                echo '<div class="text-center mt-3">';
                echo '<input type="button" class="btn btn-danger" value="Print" onclick="window.print()">';
                echo '</div>';
            } else {
                echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'>No Record Found!</div>";
            }
        } else {
            echo "<div class='alert alert-danger col-sm-6 ml-5 mt-2' role='alert'>Please select both start and end dates.</div>";
        }
    }
    ?>
</div>

<?php
include('./includes/footer.php');
?>
