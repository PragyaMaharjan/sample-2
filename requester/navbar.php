
<script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

  <nav class="navbar navbar-expand-lg navbar-dark bg-info  ">
    <div class="content-right">
      <img src="../images/logo.jpg" alt="" width="60px" height="auto">
      <a href="loginrequest.php" class="font-weight-bold ml-4 mr-4"> Login</a>
      <a href="#signup" class="btn btn-info mr-4"> Sign Up</a>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#services">Services</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#aboutus">About Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#contactus">Contact us</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="post">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search.." aria-label="Search">
        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="searchBtn"
          class="navbar-brand">Search</button>
      </form>
    </div>
  </nav>
  <?php
  include("dbconnection.php");

  if (isset($_POST['searchBtn'])) {

    $search = $conn->real_escape_string($_POST['search']);

    $select_query = "SELECT * FROM categories WHERE name=? OR description= ? OR id= ?";
    $stmt = $conn->prepare($select_query);

    if ($stmt) {

      $stmt->bind_param("ssi", $search, $search, $search);

      $stmt->execute();

      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          ?>

          <div class="card" style="width:300px; margin-top:10px">

            <?php if ($row['image'] && file_exists($row['image'])): ?>
              <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>"
                width="100" height="100">
            <?php else: ?>
              <img src="../images/ac.jpg" alt="Default Image" width="100%" height="200">
            <?php endif; ?>


            <div class="card-body">
              <h4 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h4>
              <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
              <p class="card-text">Rate: <?php echo htmlspecialchars($row['rate']); ?></p>
              <a href="submitrequest.php" class="btn btn-primary">Request Service</a>
            </div>
          </div>
          <?php
        }
      } else {
        echo "No results found.";
      }

      // Close the statement
      $stmt->close();
    } else {
      echo "Failed to prepare the SQL statement.";
    }
  }

  // Close the database connection
  $conn->close();
  ?>
