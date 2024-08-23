<?php
define('TITLE','Assets');
define('PAGE','assets');
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
    <p class="bg-dark text-white p-2">Product Details</p>
<?php
$sql = "SELECT * FROM assets_tb";
$result = $conn->query($sql);
if($result->num_rows > 0){
    echo '<table class="table">';
    echo'<thead>';
    echo'<tr>';
    echo'<th scope="col">Product ID</th>';
    echo'<th scope="col">Name</th>';
    echo'<th scope="col">DOP</th>';
    echo'<th scope="col">Available</th>';
    echo'<th scope="col">Total</th>';
    echo'<th scope="col">Orginal Cost Each</th>';
    echo'<th scope="col">Selling Cost Each</th>';
    echo'<th scope="col">Action</th>';
    
    echo'</tr>';
    echo'</thead>';
    echo'<tbody>';
        while($row = $result->fetch_assoc()){
            echo'<tr>';
            echo'<td>' .$row['pid'].'</td>';
            echo'<td>' .$row['pname'].'</td>';
            echo'<td>' .$row['pdop'].'</td>';
            echo'<td>' .$row['pava'].'</td>';
            echo'<td>' .$row['ptotal'].'</td>';
            echo'<td>' .$row['poriginalcost'].'</td>';
            echo'<td>' .$row['psellingcost'].'</td>';
             echo'<td>';
             echo'<form action="editproduct.php" method="POST" class="d-inline">';
             echo '<input type="hidden" name="id" value='.$row['pid'].'><button type="submit" class ="btn btn-info mr-3" name="edit" value="Edit">
             <i class="fas fa-pen"></i></button>';
             echo'</form>';
              
              echo'<form action="" method="POST" class="d-inline">';
              echo '<input type="hidden" name="id" value='.$row['pid'].'><button type="submit" class ="btn btn-info mr-3" name="delete" value="delete">
              <i class="fas fa-trash-alt"></i></button>';

              echo'</form>';

              echo'<form action="sellproduct.php" method="POST" class="d-inline">';
             echo '<input type="hidden" name="id" value='.$row['pid'].'><button type="submit" class ="btn btn-warning mr-3" name="issue" value="Issue">
             <i class="fas fa-handshake"></i></button>';
             echo'</form>';
               echo'</td>';

            echo'</tr>';
        }
            echo '</tbody>';
            echo'</table>';
    } else{
        echo '0 results';
    }

?>

</div>

<?php
if(isset($_POST['delete'])){
    $sql = "DELETE FROM assets_tb WHERE pid = {$_POST['id']} ";
    if($conn->query($sql) == TRUE){
    echo '<meta http-equiv="refresh" content="0;URL=?delete"/>';
    }else{
        echo 'unable to delete';
    }
}
?>





        </div> <!-- end row -->
        <div class="float-right mr-3"> <a href="addproduct.php" class="btn btn-danger ml-2"><i class="fas fa-plus fa-2x "></i>
        </a></div>

        </div> <!-- conatiner end -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


