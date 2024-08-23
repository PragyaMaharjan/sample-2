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

<!-- start second column -->

<div class="col-sm-9 col-md-9 mt-5">
    <?php
    $sql = "SELECT * FROM assignwork_tb";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
      echo '<table class="table">';
        echo'<thead>';
        echo'<tr>';
        echo'<th scope="col">Req ID</th>';
        echo'<th scope="col">Req Info</th>';
        echo'<th scope="col">Name</th>';
        echo'<th scope="col">Address</th>';
        echo'<th scope="col">City</th>';
        echo'<th scope="col">Mobile</th>';
        echo'<th scope="col">Technician</th>';
        echo'<th scope="col">Assign Date</th>';
        echo'<th scope="col">Action</th>';
        echo'</tr>';
        echo'</thead>';

        echo'<tbody>';
        while($row = $result->fetch_assoc()){
            echo'<tr>';
            echo'<td>' .$row['request_id'].'</td>';
            echo'<td>' .$row['request_info'].'</td>';
            echo'<td>' .$row['requester_name'].'</td>';
            echo'<td>' .$row['requester_add2'].'</td>';
            echo'<td>' .$row['requester_city'].'</td>';
            echo'<td>' .$row['requester_mobile'].'</td>';
            echo'<td>' .$row['requester_tech'].'</td>';
            echo'<td>' .$row['assign_date'].'</td>';
            echo '<td>';
            echo '<form action="viewassignwork.php" method="POST" class="d-inline">';
            echo '<input type="hidden" name="id" value='.$row['request_id'].'> <button class ="btn btn-warning" name="view" value="view" type="submit">
            <i class="fas fa-eye"></i>
            </button>';
            echo '</form>';

            echo '<form action="" method="POST" class="d-inline">';
            echo '<input type="hidden" name="id" value='.$row['request_id'].'> <button class ="btn btn-secondary" name="delete" value="delete" type="submit"><i class="fas fa-trash-alt"></i>
            </button>';
            echo '</form>';
            echo '</td>';

            
            echo'</tr>';
        }
        echo'</tbody>';

      echo '</table>';
    }else{
        echo ' 0 Result';
    }
    if(isset($_POST['delete'])){
        $sql= "DELETE FROM assignwork_tb WHERE request_id ={$_POST['id'] }";
        if($conn->query($sql) == TRUE){
            echo '<meta http-equiv="refresh" content="0;URL=?delete"/>';
        
        }else{
            echo "unable to delete";
        }
    }
    ?>

</div>
 
<!-- end second column -->

<?php
include('./includes/footer.php')
?>