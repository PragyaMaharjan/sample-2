<?php
define('TITLE','Service');
define('PAGE','service');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}
?>
<div class="col-sm-9 col-md-10 mt-5 text-center">
    <p class="bg-dark text-white p-2">List of Requester</p>
<?php
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

if ($result === false) {
    // Output SQL error if the query fails
    echo "Error: " . $conn->error;
} elseif ($result->num_rows > 0) {
    echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">ID</th>';
        echo '<th scope="col">Name</th>';
        echo '<th scope="col">Description</th>';
        echo '<th scope="col">Image</th>';
        echo '<th scope="col">Created_at</th>';
        echo '<th scope="col">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['description']) . '</td>';
            echo '<td>';
            if (!empty($row['image'])) {
                echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '" width="100" height="100">';
            } else {
                echo 'No image available';
            }
            echo '</td>';
            echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
            echo '<td>';
            echo '<form action="editservice.php" method="POST" class="d-inline">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
            echo '<button type="submit" class="btn btn-info mr-3" name="edit" value="Edit"><i class="fas fa-pen"></i></button>';
            echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '0 results';
}

?>

        </div> <!-- end row -->
        <div class="float-right mr-3"> <a href="insertreq.php" class="btn btn-danger ml-2"><i class="fas fa-plus fa-2x "></i>
        </a></div>

        </div> <!-- conatiner end -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
