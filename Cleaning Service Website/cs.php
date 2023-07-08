<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Home Cleaning Services</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <!-- Header Start -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 bg-secondary d-none d-lg-block">
        <a href="" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
          <h1 class="m-0 display-3 text-primary">Klean</h1>
        </a>
      </div>
      <div class="col-lg-9">
        <div class="row bg-dark d-none d-lg-flex">
          <div class="col-lg-7 text-left text-white">
            <div class="h-100 d-inline-flex align-items-center border-right border-primary py-2 px-3">
              <i class="fa fa-envelope text-primary mr-2"></i>
              <small>info@example.com</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-2 px-2">
              <i class="fa fa-phone-alt text-primary mr-2"></i>
              <small>+012 345 6789</small>
            </div>
          </div>
          <div class="col-lg-5 text-right">
            <div class="d-inline-flex align-items-center pr-2">
              <a class="text-primary p-2" href="">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a class="text-primary p-2" href="">
                <i class="fab fa-twitter"></i>
              </a>
              <a class="text-primary p-2" href="">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a class="text-primary p-2" href="">
                <i class="fab fa-instagram"></i>
              </a>
              <a class="text-primary p-2" href="">
                <i class="fab fa-youtube"></i>
              </a>
            </div>
          </div>
        </div>
        <?php include 'nav.php'; ?>
      </div>
    </div>
  </div>
  <!-- Header End -->


  <!-- Page Header Start -->
  <?php
  include 'db.php';
  
  if (isset($_POST['book'])) {
    // Collect form data
    $selectedService = $_POST['service'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    // Check if user has made a booking within the past 24 hours
    $previousBookingQuery = "SELECT * FROM bookings WHERE email = '$email' AND date > DATE_SUB(NOW(), INTERVAL 24 HOUR)";
    $previousBookingResult = mysqli_query($conn, $previousBookingQuery);
    
    if (mysqli_num_rows($previousBookingResult) > 0) {
      echo '<script>alert("You have already made a booking within the past 24 hours. Please try again later.");</script>';
    } else {
      // Insert booking record into the database
      $insertQuery = "INSERT INTO bookings (service, name, email, phone, address) VALUES ('$selectedService', '$name', '$email', '$phone', '$address')";
      if (mysqli_query($conn, $insertQuery)) {
        echo '<script>alert("Booking successful!");</script>';
      } else {
        echo '<script>alert("Error occurred while booking. Please try again.");</script>';
      }
    }
  }
  ?>

  <div class="page-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-content">
            <h2 class="breadcrumb-title">Book Cleaning Services</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Page Header End -->

<!-- Booking Section Start -->
  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <div class="section-title text-center">
            <h2 class="title">Select a Service</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form method="POST">
            <?php
            $servicesQuery = "SELECT * FROM services";
            $servicesResult = mysqli_query($conn, $servicesQuery);

            while ($row = mysqli_fetch_assoc($servicesResult)) {
              $serviceId = $row['id'];
              $serviceName = $row['name'];
              $serviceDescription = $row['description'];
              $servicePrice = $row['price'];

              echo '<div class="card mb-3">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">' . $serviceName . '</h5>';
              echo '<p class="card-text">' . $serviceDescription . '</p>';
              echo '<p class="card-text">Price: $' . $servicePrice . '</p>';
              echo '<div class="form-check">';
              echo '<input class="form-check-input" type="radio" name="service" id="service' . $serviceId . '" value="' . $serviceId . '" required>';
              echo '<label class="form-check-label" for="service' . $serviceId . '">Select</label>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
            ?>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" required <?php if (isset($_SESSION['cusID'])) echo 'value="' . $_SESSION['cusName'] . '"'; ?>>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required <?php if (isset($_SESSION['cusID'])) echo 'value="' . $_SESSION['cusEmail'] . '"'; ?>>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="tel" class="form-control" id="phone" name="phone" required <?php if (isset($_SESSION['cusID'])) echo 'value="' . $_SESSION['cusPhone'] . '"'; ?>>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" required <?php if (isset($_SESSION['cusID'])) echo 'value="' . $_SESSION['cusAddress'] . '"'; ?>>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button class="btn btn-primary" type="submit" name="book">Book Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Booking Section End -->


  <!-- Footer Start -->
  <?php include 'footer.php'; ?>
  <!-- Footer End -->

  <!-- Scroll Top Button -->
  <button class="scroll-top">
    <i class="fa fa-angle-up"></i>
  </button>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <script src="js/script.js"></script>

</body>

</html>
