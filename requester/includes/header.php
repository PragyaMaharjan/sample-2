<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- font Awesome Css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="../cssss/custom.css">
    <title>
    <?php echo TITLE?>
    </title>
</head>
<body>

<!-- navbar -->
<?php include('navbar.php')
?>
<!-- end of nav bar --> 

<!--start container  -->

 <div class="container-fuildd" style="margin-top:40px";>
    <div class="row">  
        <!-- start row -->
        <nav class="col-sm-2 bg-light sidebar py-5 d-print-none"><!-- side bar -->
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'requestprofile'){echo 'active';}?>" href="requestprofile.php">
                        <i class="fas fa-user"></i> Profile
                     </a></li>

                     <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'submitrequest'){echo 'active';}?>" href="submitrequest.php">
                        <i class="fab fa-accessible-icon"></i> Submit request
                     </a></li>

                     <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'checkstatus'){echo 'active';}?>" href="checkstatus.php">
                    <i class="fa-solid fa-align-center"></i>
                         service status</a></li>
                     
                        <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'requesterpasschange'){echo 'active';}?>" href="requesterpasschange.php">
                        <i class="fas fa-key">
                        </i> Change password</a></li>

                        <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt">
                        </i> Logout</a></li>
                        
            </ul>
            </div>
        </nav><!-- end side bar 1st col -->

        
    