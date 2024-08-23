<?php
define('TITLE','Dashboard');
define('PAGE','dashboard');
include('./includes/header.php');
include('../requester/dbconnection.php');

session_start();

if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}

// If the session is set, you can use it here
$aEmail = $_SESSION['aEmail'];

$sql = "SELECT max(request_id) FROM submitrequest_tb";
$result = $conn->query($sql);
$row = $result->fetch_row();
$submitrequest = $row[0];

$sql = "SELECT max(rno) FROM assignwork_tb";
$result = $conn->query($sql);
$row = $result->fetch_row();
$assignwork = $row[0];

$sql = "SELECT COUNT(*) FROM technician_tb";
$result = $conn->query($sql);
$row = $result->fetch_row();
$totaltech = $row[0] ?: 0; // Set default value if null
?>

        <!-- Start secomd column -->
<div class="col-sm-9 col-md-10">
<div class="row text-center mx-5">
    <div class="col-sm-12 col-md-4 mt-5">
        <div class="card text-white bg-info mb-3" style="max-width:18rem">
            <div class="card-header">
                Request Recieved
            </div>
            <div class="card-body">

                <h4 class="card-title"><?php echo $submitrequest ?> </h4>
                <a class="btn text-white" href="request.php">View</a>
            
                </div>
        </div>

    </div>

    <div class="col-sm-12 col-md-4 mt-5">
        <div class="card text-white bg-danger mb-3" style="max-width:18rem">
            <div class="card-header">
                Request Recieved
            </div>
            <div class="card-body">

                <h4 class="card-title"> <?php echo $assignwork ?> </h4>
                <a class="btn text-white" href="work.php">Assignwork</a>
            
                </div>
        </div>

    </div>

    <div class="col-sm-12 col-md-4 mt-5">
        <div class="card text-white bg-success mb-3" style="max-width:18rem">
            <div class="card-header">
                Request Recieved
            </div>
            <div class="card-body">

                <h4 class="card-title"> <?php echo $totaltech ?></h4>
                <a class="btn text-white" href="technician.php">No.of technician</a>
            
                </div>
        </div>

    </div>

</div>
<div class="mx-5 mt-5 text-center">
    <p class="bg-dark text-white p-2">List of requester</ p>
    <?php
$sql = "SELECT * FROM registrationform_tb";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Requester ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['r_login_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['r_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['r_email']) . '</td>';
        echo '</tr>';
    }

    echo ' </tbody>
    </table>';
}
else{
    echo '0 Results';
}
?>

</div>
</div>
<!-- end second column -->
<?php
include('./includes/footer.php')
?>
    
</body>
</html>