<?php
session_start();
$cusID = $_SESSION['cusID'];
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
  <style>
    body {
      color: #6F8BA4;
      margin-top: 20px;
    }

    .section {
      padding: 100px 0;
      position: relative;
    }

    .gray-bg {
      background-color: #f5f5f5;
    }

    img {
      max-width: 100%;
    }

    img {
      vertical-align: middle;
      border-style: none;
    }

    /* About Me 
---------------------*/
    .about-text h3 {
      font-size: 45px;
      font-weight: 700;
      margin: 0 0 6px;
    }

    @media (max-width: 767px) {
      .about-text h3 {
        font-size: 35px;
      }
    }

    .about-text h6 {
      font-weight: 600;
      margin-bottom: 15px;
    }

    @media (max-width: 767px) {
      .about-text h6 {
        font-size: 18px;
      }
    }

    .about-text p {
      font-size: 18px;
      max-width: 450px;
    }

    .about-text p mark {
      font-weight: 600;
      color: #20247b;
    }

    .about-list {
      padding-top: 10px;
    }

    .about-list .media {
      padding: 5px 0;
    }

    .about-list label {
      color: #20247b;
      font-weight: 600;
      width: 88px;
      margin: 0;
      position: relative;
    }

    .about-list label:after {
      content: "";
      position: absolute;
      top: 0;
      bottom: 0;
      right: 11px;
      width: 1px;
      height: 12px;
      background: #20247b;
      -moz-transform: rotate(15deg);
      -o-transform: rotate(15deg);
      -ms-transform: rotate(15deg);
      -webkit-transform: rotate(15deg);
      transform: rotate(15deg);
      margin: auto;
      opacity: 0.5;
    }

    .about-list p {
      margin: 0;
      font-size: 15px;
    }

    @media (max-width: 991px) {
      .about-avatar {
        margin-top: 30px;
      }
    }

    .about-section .counter {
      padding: 22px 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
    }

    .about-section .counter .count-data {
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .about-section .counter .count {
      font-weight: 700;
      color: #20247b;
      margin: 0 0 5px;
    }

    .about-section .counter p {
      font-weight: 600;
      margin: 0;
    }

    mark {
      background-image: linear-gradient(rgba(252, 83, 86, 0.6), rgba(252, 83, 86, 0.6));
      background-size: 100% 3px;
      background-repeat: no-repeat;
      background-position: 0 bottom;
      background-color: transparent;
      padding: 0;
      color: currentColor;
    }

    .theme-color {
      color: #fc5356;
    }

    .dark-color {
      color: #20247b;
    }
  </style>
</head>

<body>
 <!-- Header Start -->
 <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 d-none d-lg-block" style="background-color: white; text-shadow: 2px 2px 4px #000000;">
        <a href="" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
          <h1 class="m-0 display-3 text-info">KMC</h1>
        </a>
      </div>
      <div class="col-lg-9">
        
        <?php include 'nav.php'; ?>
      </div>
    </div>
  </div>
  <!-- Header End -->


  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <section class="section about-section gray-bg" id="about">
          <div class="container">
            <div class="row align-items-center flex-row-reverse">

              <div class="col-lg-10">
                <div class="about-text go-to">
                  <div class="row">

                    <div class="col-sm-8">
                      <h3 class="dark-color">Personal Information</h3>
                    </div>
                    <div class="col-sm-4"></div>
                  </div>

                  <div class="row about-list">
                    <div class="col-md-6">
                      <?php
                      include 'db.php';
                      $qr = mysqli_fetch_assoc(mysqli_query($conn, "select * from customer where cusID=$cusID"));
                      ?>
                      <div class="media row">
                        <label class="col-sm-4">First Name</label>
                        <p class="col-sm-4"><?php echo $qr['cusFirstName']; ?></p>
                      </div>
                      <div class="media row">
                        <label class="col-sm-4">Email</label>
                        <p class="col-sm-4"><?php echo $qr['cusEmail']; ?></p>
                      </div>
                      <div class="media row">
                        <label class="col-sm-4">Address</label>
                        <p class="col-sm-4"><?php echo $qr['cusAddress']; ?></p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="media row">
                        <label class="col-sm-4">Last Name</label>
                        <p class="col-sm-4"><?php echo $qr['cusLastName']; ?></p>
                      </div>
                      <div class="media row">
                        <label class="col-sm-4">Phone</label>
                        <p class="col-sm-4"><?php echo $qr['cusPhone']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2"><img style="width: 200px;
    height: 200px;
    border-radius: 20%;
    object-fit: cover;
    object-position: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" src="img/<?php echo $qr['cusImage']; ?>" alt=""></div>
            </div>
            <div style="position:relative;" class="row" >
              <a style="position:absolute; bottom:-100px; right:800px;" class="btn btn-info" href="CustomerEditProfile.php">Edit</a>
              <a style="position:absolute; bottom:-100px; right:500px;" class="btn btn-info" href="Logout.php">Logout</a>
              <a style="position:absolute; bottom:-100px; right:100px;" href="BookingHistory.php" class="btn btn-info">Booking History</a>
            </div>
            <
          </div>
        </section>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>

  </script>
  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>

  <!-- Contact Javascript File -->
  <script src="mail/jqBootstrapValidation.min.js"></script>
  <script src="mail/contact.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
</body>
<div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important; position:fixed; bottom:0;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">House Cleaning And Transportation Service</a>. All Rights Reserved. Designed by Khaing Min Thura </a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</html>