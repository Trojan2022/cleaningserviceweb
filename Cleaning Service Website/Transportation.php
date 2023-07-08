<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>KMC HOME PAGE</title>
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

<body class="bg-dark"  style="background-image: url(img/project/h1.jpg);">
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


  <!-- Page Header Start -->
  <?php
  include 'db.php';
  $qr = mysqli_query($conn, "SELECT * FROM transportationservice");
  ?>
  <?php
  if (isset($_POST['book'])) {
    // Collect form data
    $cusID = $_SESSION['cusID'];
    $bdate = date('Y-m-d');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $services = $_POST['service'];
    $bStatus = 'Pending';
    $q=mysqli_fetch_assoc(mysqli_query($conn, "select * from transportationservice where tpName='$services'"));
    $tpID=$q['tpID'];
    // Check if the user has already made a booking within the past 24 hours
    $existingBooking = mysqli_query($conn, "SELECT b.bookingID FROM booking b, bookingservice bs WHERE b.bookingID=bs.bookingID and cusID = $cusID AND bs.tpID=$tpID  AND bookingDate >= DATE_SUB(NOW(), INTERVAL 1 DAY)");
    if (mysqli_num_rows($existingBooking) > 0) {
      echo "<script> alert('You have already made a booking within the past 24 hours. Please try again later.'); location.assign('BookingHistory.php');</script>";
    } else {
    $br = mysqli_query($conn, "insert into booking (bookingDate, bookingAddress, bookingStatus, cusID) values ('$bdate', '$address', '$bStatus', $cusID)");
    $br1 = mysqli_query($conn, "select LAST_INSERT_ID() INTO @bid");
    if (!empty($services)) {
        $q = mysqli_query($conn, "select * from transportationservice where tpName='$services'");
        while ($row = mysqli_fetch_assoc($q)) {
          $id = $row['tpID'];
          $qqq = mysqli_query($conn, "Insert into bookingservice (tpID, bookingID) values ($id, @bid);");
        }
      }
    echo "<script> alert('Success!'); location.assign('BookingHistory.php');</script>";
  }
}
  if (isset($_REQUEST['book1'])) {
    echo "<script> alert('You Need to Login First'); location.assign('LoginCustomer.php');</script>";
  }
  ?>
  <?php
  if (!isset($_SESSION['cusID'])) { ?>
    <form method="post">
      <div class="container-fluid" style="padding-top:30px;">
       
          <h3 style="text-align:center;">Transportation Service</h3>
        </div>
        <div class="container py-5">
          <div class="row">
            <?php
            while ($qrow = mysqli_fetch_assoc($qr)) {
              $tpName = $qrow['tpName'];
              $tpInfo = $qrow['tpDescription'];
              $tpPrice= $qrow['tpPrice'];
              $scID = $qrow['scID'];
              $scrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM servicecategory where scID=$scID"));
              $serviceName = $scrow['scName'];
            ?>
              <div class="col-lg-4 col-md-6 mb-4" >
                <div class="card" style="background-color: deepskyblue;">
                  <div class="card-body position-relative">
                    <input class="form-check-input" type="radio" name="service" value="<?php echo $tpName; ?>" class="position-absolute checkbox-input" style="top:0; right:0; width:40px;height:40px; font-weight:bolder;">
                    <p style="font-weight:bolder; color:white;"><?php echo $serviceName; ?></p>
                    <label for="serviceCheckbox_<?php echo $tpName; ?>" class="checkbox-label" style="font-weight:bolder; color:white;"><?php echo $tpName; ?></label>

                    <p style="font-weight:bolder; color:white;"><?php echo $tpInfo; ?></p>
                    <p style="font-weight:bolder; color:white;"><?php echo $tpPrice; ?></p>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div class="container-fluid py-5">
        <div class="container">
          <div class="row align-items-end mb-4">
          </div>
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 mb-5 mb-lg-0">
              <div class="contact-form">
                <div id="success"></div>
                <div class="form-row">
                  <div class="col-sm-6 control-group">
                    <input type="text" class="form-control p-4" id="name" name="name1" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="col-sm-6 control-group">
                    <input type="email" class="form-control p-4" id="email" name="email1" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="control-group">
                  <input type="text" class="form-control p-4" id="phone" name="phone1" placeholder="Phone Number" required="required" data-validation-required-message="Please enter a phone number" />
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <textarea class="form-control p-4" rows="3" id="address" name="address1" placeholder="Enter Your Address" required="required" data-validation-required-address="Please enter your address"></textarea>
                  <p class="help-block text-danger"></p>
                </div>
                <div>
                  <button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendMessageButton" name="book1">Booking</button>
                </div>
              </div>
            </div>
            <div class="col-lg-2"></div>
          </div>
        </div>
      </div>
    </form>
  <?php   } else { ?>
    <form method="post">
    <div class="container-fluid" style="padding-top:30px;">
       
       <h3 style="text-align:center;">Transportation Service</h3>
     </div>
        <div class="container py-5">
          <div class="row">
            <?php
            while ($qrow = mysqli_fetch_assoc($qr)) {
              $tpName = $qrow['tpName'];
              $tpInfo = $qrow['tpDescription'];
              $scID = $qrow['scID'];
              $scrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM servicecategory where scID=$scID"));
              $serviceName = $scrow['scName'];
            ?>
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                  <div class="card-body position-relative">
                    <input class="form-check-input" type="radio" name="service" value="<?php echo $tpName; ?>" class="position-absolute checkbox-input" style="top:0; right:0; width:40px;height:40px;">
                    <p><?php echo $serviceName; ?></p>
                    <label for="serviceCheckbox_<?php echo $tpName; ?>" class="checkbox-label"><?php echo $tpName; ?></label>

                    <p><?php echo $tpInfo; ?></p>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div class="container-fluid py-5">
        <div class="container">
          <div class="row align-items-end mb-4">
          </div>
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 mb-5 mb-lg-0">
              <div class="contact-form">
                <div id="success"></div>
                <?php
                $qr = mysqli_fetch_assoc(mysqli_query($conn, "select * from customer where cusID=1"))
                ?>
                <div class="form-row">
                  <div class="col-sm-6 control-group">
                    <input type="text" class="form-control p-4" id="name" name="name" placeholder="Your Name" required="required" value="<?php echo $qr['cusFirstName'] . $qr['cusLastName']; ?>" data-validation-required-message="Please enter your name" />
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="col-sm-6 control-group">
                    <input type="email" class="form-control p-4" id="email" name="email" placeholder="Your Email" required="required" value="<?php echo $qr['cusEmail']; ?>" data-validation-required-message="Please enter your email" />
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="control-group">
                  <input type="text" class="form-control p-4" id="phone" name="phone" placeholder="Phone Number" required="required" value="<?php echo $qr['cusPhone']; ?>" data-validation-required-message="Please enter a phone number" />
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <textarea class="form-control p-4" rows="3" id="address" name="address" placeholder="Enter Your Address" required="required" data-validation-required-address="Please enter your address"><?php echo $qr['cusAddress']; ?></textarea>
                  <p class="help-block text-danger"></p>
                </div>
                <div>
                  <button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendMessageButton" name="book">Booking</button>
                </div>
              </div>
            </div>
            <div class="col-lg-2"></div>
          </div>
        </div>
      </div>
    </form>
  <?php  } ?>

  <!-- Contact End -->


  <!-- Footer Start -->
  <?php
  include 'footer.php';
  ?>
  <!-- Footer End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-primary px-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


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

</html>