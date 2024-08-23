<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- bootstrap Css -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
      <!-- font Awesome Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="../cssss/custom.css">
    <title>kirtipur service provider</title>

</head>
<!-- navbar -->
<?php include('navbar.php')
?>
<!-- end of nav bar -->
 
<header class="jumbotron back-image"  style="background-image:url(../images/Final\ Project.jpg)";>
</header>

<div class="container" id="aboutus">
  <div class="jumbotron" style="background-color:#ACCAD7" >
  <h3 class="text-center">SHORT INFO..</h3>
  <p>
  Home Services means services for
                   home projects, such as maintenance,
                    remodeling, construction, inspection, 
                    cleaning, and gardening. A home service is any
                     task or day-to-day activity that you are usually
                      unable to perform yourself due to your schedule,
                   limitations in your ability, health reasons etc. Home services also helps to make our daily work easilier.
                   It is also very effective. Observing these benefits we have also started provide differnt kinds of home service in kirtipur.
                   We provide differnt home services according to the customers need. Our services also provides small home projects, such as maintenance, remodeling,
                   computer service, etc. To contact us you contact on variour social media which are mentioned below.
  </p>
</div>
</div>

<!-- Services section -->

<?php include('service.php')
?>


      
<!-- service section end  -->

<!-- start of registration form -->
<?php include('UserRegistration.php')
?>
 <!-- end of registration form -->


       <!-- customer review -->
       

      <div class="jumbotron bg-info">
  <div class="container">
    <h2 class="text-center text-white mb-4">Happy Customer</h2>
    <div class="row justify-content-center">
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <img src="../images/facebook.png" class="img-fluid w-50 mb-3" style="border-radius: 50%;" alt="avt1">
            <h4 class="card-title">Lia</h4>
            <p class="card-text">gacywgygyigcyisGgyusvgyusGygxjhahscuhuhcahsjh</p>
          </div>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <img src="../images/facebook.png" class="img-fluid w-50 mb-3" style="border-radius: 50%;" alt="avt1">
            <h4 class="card-title">Lia</h4>
            <p class="card-text">gacywgygyigcyisGgyusvgyusGygxjhahscuhuhcahsjhjbccccccccy</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card shadow-lg">
          <div class="card-body text-center">
            <img src="../images/facebook.png" class="img-fluid w-50 mb-3" style="border-radius: 50%;" alt="avt1">
            <h4 class="card-title">Lia</h4>
            <p class="card-text">gacywgygyigcyisGgyusvgyusGygxjhahscuhuhcahsjhjbccccccccy</p>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>

<!-- end of customer review -->
<?php include('contactform.php')
?>

      <!-- contact us -->

      <div class="container" id="contactus" >
        <h2 class="text-center mb-4"> Contact Us</h2>
        <div class="rows">
       
          <!-- end of 1st column -->
          <div class="col-md-4 text center">  <!-- start send column -->
            <strong>Headquater:</strong>
            Sachi Computers<br>
            Kirtipur,Nayabazar<br>
            phone no:99888555<br>
            <a href="" target="black"> www.kirtipur.com </a><br>
            
        </div>
      </div>
      </div>
      
      <footer class="container-fluid bg-info mt-5 text-white">
        <div class="container">
          <div class="row py-3">
            <div class="col-md-6">
              <span class="pr-2"> Follow As</span>
              <a href="" target="_blank" class="pr-4 fi-color">
                <i class="fab fa-facebook-f"></i>
              </a>

              <a href="" target="_blank" class="pr-2 fi-color">
                <i class="fab fa-google-plus-g"></i>
              </a>
          </div>
          
          </div>

        </div>

      </footer>

 <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>