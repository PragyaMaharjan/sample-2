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

    <title><?php
    echo TITLE
    ?></title>

</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-dark bg-info  ">
<div class="content-right">
            <img src="../images/logo.jpg" alt="" width="60px" height="auto">   
        </div>
</nav>
<!--start container  -->

<div class="container-fuildd" style="margin-top:40px";>
    <div class="row">  
        <!-- start row -->
        <nav class="col-sm-2 bg-light sidebar py-5 d-print-none"><!-- side bar -->
          <div class="sidebar-sticky">
            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link 
                    <?php if(PAGE == 'dashboard'){echo 'active';}?>" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i> dashboard
                     </a></li>

                     <li class="nav-item">
                    <a class="nav-link 
                    <?php if(PAGE == 'service'){echo 'active';}?>" href="aservice.php">
                        <i class="fas fa-tachometer-alt"></i> Edit Service
                     </a></li>
                     <li class="nav-item">

                     <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'work'){echo 'active';}?>" href="work.php">
                        <i class="fa fa-tasks"></i> Work Order
                     </a></li>

                     <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'request'){echo 'active';}?>" href="request.php">
                    <i class="fa-solid fa-code-pull-request"></i>
                         Requests</a></li>


                         <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'requester'){echo 'active';}?>" href="requester.php">
                    <i class="fa-solid fa-code-pull-request"></i>
                         requester</a></li>


                         <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'assets'){echo 'active';}?>" href="assets.php">
                        <i class="fab fa-accessible-icon"></i> Assets
                     </a></li>

                     <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'technician'){echo 'active';}?>" href="technician.php">
                        <i class="fab fa-accessible-icon"></i> Technician
                     </a></li>

                     <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'sellreport'){echo 'active';}?>" href="soldproductreport.php">
                        <i class="fab fa-table"></i> Sell Report
                     </a></li>

                     <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'workreport'){echo 'active';}?>" href="workreport.php">
                        <i class="fab fa-table"></i> Work Report
                     </a></li>
                     
                        <li class="nav-item">
                    <a class="nav-link <?php if(PAGE == 'changepass'){echo 'active';}?>" href="changepass.php">
                        <i class="fas fa-key">
                        </i> Change password</a></li>

                        <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt">
                        </i> Logout</a></li>
                        
            </ul>
            </div>
        </nav><!-- end side bar 1st col --> 