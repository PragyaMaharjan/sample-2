<?php
include('dbconnection.php');
$regmsg = "";

if (isset($_POST['rSignup'])) {

  $rName = $_POST['rName'];
  $rEmail = $_POST['rEmail'];
  $rPassword = $_POST['rPassword'];

  if (empty($rName) || empty($rEmail) || empty($rPassword)) {
    $regmsg = '<div class="alert alert-info mt-2" role="alert">All Fields are Required</div>';
  } else {
    if (!filter_var($rEmail, FILTER_VALIDATE_EMAIL)) {
      $regmsg = '<div class="alert alert-info mt-2" role="alert">Invalid Email Address</div>';
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $rEmail)) {
      $regmsg = '<div class="alert alert-info mt-2" role="alert">Invalid Email address</div>';
    } else {
      // Check if email is already registered
      $sql = "SELECT r_email FROM registrationform_tb WHERE r_email=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $rEmail);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows != 1) {
        // Insert new user into the database
        $sql = "INSERT INTO registrationform_tb (r_name, r_email, r_password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $rName, $rEmail, $rPassword);

        if ($stmt->execute()) {
          $regmsg = '<div class="alert alert-success mt-2" role="alert">Account Successfully Created</div>';
        } else {
          $regmsg = '<div class="alert alert-danger mt-2" role="alert">Unable to Create Account</div>';
        }
      } else {
        $regmsg = '<div class="alert alert-info mt-2" role="alert">Email ID Already Registered</div>';
      }
    }
  }
}
?>



<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- bootstrap Css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- font Awesome Css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="../cssss/custom.css">
  <title>User registration</title>
</head>

<body></body>
<div class="container pt-5" id="signup">
  <h2 class="text-center"> Create an Account</h2>
  <div class="row mt-4 mb-4">
    <div class="col-md-6 offset-md-3">

      <form action="" class="shadow-lg p-4" method="POST">
        <div class="form-group">
          <i class="fas fa-user"></i>
          <label for="name" class="font-weight-bold pl-2">Name</label>
          <input type="text" class="form-control" placeholder="Enter your name" name="rName">
        </div>

        <div class="form-group">
          <i class="fas fa-user"></i>
          <label for="email" class="font-weight-bold pl-2">Email</label>
          <input type="email" class="form-control" placeholder="Enter your email" name="rEmail">
          <small> Your email we will secured </small>
        </div>


        <div class="form-group">
          <i class="fas fa-key"></i>
          <label for="pass" class="font-weight-bold pl-2">New Password</label>
          <input type="password" class="form-control" placeholder="Enter your name" name="rPassword">
        </div>

        <button type="submit" class="btn btn-info mt-5 btn-block shadow-sm font-weight-bold" name="rSignup"> Sign Up
        </button>

        <em style="font-size:10px;"> By clicking signup you agree to our Terms and Data policy </em>
      </form>
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

      <!-- Popper JS -->
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
      </body>

      </html>

      <?php
      if (isset($regmsg)) {
        echo $regmsg;
      }

      ?>
      </form>

    </div>
  </div>

</div> <!-- end of registration form -->