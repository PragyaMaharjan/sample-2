<?php
include('dbconnection.php');
session_start();

// Fetch all services from the database
$sql = "SELECT * FROM categories";



$result = $conn->query($sql);
?>
<div class="container mt-5">
    <h2 class="text-center">Our Services</h2>

    <?php if (isset($_SESSION['is_adminlogin']) && $_SESSION['is_adminlogin'] === true): ?>
        <!-- Link to admin service management page -->

    <?php endif; ?>

    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">

                    <img src="../admin/<?php echo $row['image']; ?>" alt="no image found" width="100%" height="200">

                        <div class="card-body">
                            <h4 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h4>
                            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="card-text">Rate: <?php echo htmlspecialchars($row['rate']); ?></p>
                            <a href="submitrequest.php" class="btn btn-primary">Request Service</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No services available.</p>
        <?php endif; ?>
    </div>
</div>