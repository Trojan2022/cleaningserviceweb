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
<style>
  .card {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease-in-out;
  }

  .card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .checkbox-label {
    font-weight: bold;
    font-size: 16px;
  }

  .p-3 {
    margin-top: 10px;
  }

  /* Customize radio button appearance */
  .form-check-input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid #ccc;
    outline: none;
    transition:background-color .5s ease-in-out;
  }

  .form-check-input[type="radio"]:checked {
    border-color: #0066cc;
    background-color: green;
  }

  .form-check-input[type="radio"]:hover {
    border-color: #66a3ff;
  }
</style>

<body style="background-image: url(img/project/h3.jpg);">
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
  ?>
  <?php
  // ...

  if (isset($_REQUEST['book'])) {
    // Collect form data
    $cusID = $_SESSION['cusID'];
    $bdate = date('Y-m-d');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $bStatus = 'Pending';
    $services = $_POST['service'];
    $q = mysqli_fetch_assoc(mysqli_query($conn, "select * from cleaningservice where csName='$services'"));
    $csID = $q['csID'];

    // Check if the user has already made a booking within the past 24 hours
    $existingBooking = mysqli_query($conn, "SELECT b.bookingID FROM booking b, bookingservice bs WHERE b.bookingID=bs.bookingID and cusID = $cusID AND bs.csID=$csID  AND bookingDate >= DATE_SUB(NOW(), INTERVAL 1 DAY)");
    if (mysqli_num_rows($existingBooking) > 0) {
      echo "<script> alert('You have already made a booking within the past 24 hours. Please try again later.'); location.assign('BookingHistory');</script>";
    } else {
      // Insert the booking record
      $br = mysqli_query($conn, "INSERT INTO booking (bookingDate, bookingAddress, bookingStatus, cusID) VALUES ('$bdate', '$address', '$bStatus', $cusID)");
      $bookingID = mysqli_insert_id($conn);

      // Insert the selected services
      if (!empty($services)) {
        $q = mysqli_query($conn, "SELECT * FROM cleaningservice WHERE csName='$services'");
        while ($row = mysqli_fetch_assoc($q)) {
          $id = $row['csID'];
          $qqq = mysqli_query($conn, "INSERT INTO bookingservice (csID, bookingID) VALUES ($id, $bookingID)");
        }
      }

      echo "<script> alert('Success!');</script>";
    }
  }

  // ...

  if (isset($_REQUEST['book1'])) {
    echo "<script> alert('You Need to Login First'); location.assign('LoginCustomer.php');</script>";
  }
  ?>
  <?php
  if (!isset($_SESSION['cusID'])) { ?>
    <form method="post">
      <div class="container-fluid" style="background-color: rgba(0,0,0,0.3);">
        <div class="container py-5">
          <div class="row">
            <?php
            include 'db.php';
            $qr = mysqli_query($conn, "select * from cleaningservice");
            while ($qrow = mysqli_fetch_assoc($qr)) {
              $clName = $qrow['csName'];
              $clInfo = $qrow['csInfo'];
              $scID = $qrow['scID'];
              $price = $qrow['price'];
              $scrow = mysqli_fetch_assoc(mysqli_query($conn, "select * from servicecategory where scID=$scID"));
              $serviceName = $scrow['scName'];
            ?>
              <div class="col-lg-3 col-md-3 mb-2">
                <div class="card">
                  <div class="card-body position-relative">
                    <input class="form-check-input" type="radio" name="service" value="<?php echo $clName; ?>" class="position-absolute" style="top:0; right:0; width:30px;height:30px; border-radius:0;" required>
                  </div>
                  <label style="color:green;" for="serviceCheckbox_<?php echo $clName; ?>" class="checkbox-label"><b><?php echo $clName; ?></b></label>
                  <hr>
                  <div class="p-1">
                    <p><?php echo $clInfo; ?></p>
                  </div>
                  <hr>
                  <div>
                    <p><b><?php echo $price; ?> MMK</b></p>
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
                    <input type="text" class="form-control p-4" id="name" name="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="col-sm-6 control-group">
                    <input type="email" class="form-control p-4" id="email" name="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="control-group">
                  <input type="text" class="form-control p-4" id="phone" name="phone" placeholder="Phone Number" required="required" data-validation-required-message="Please enter a phone number" />
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <textarea class="form-control p-4" rows="3" id="address" name="address" placeholder="Enter Your Address" required="required" data-validation-required-address="Please enter your address"></textarea>
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
  <?php } else { ?>
    <form method="post">
      <div class="container-fluid" style="background-color: rgba(0,0,0,0.3);">
        <div class="container py-5">
          <div class="row">
            <?php
            include 'db.php';
            $qr = mysqli_query($conn, "select * from cleaningservice");
            while ($qrow = mysqli_fetch_assoc($qr)) {
              $clName = $qrow['csName'];
              $clInfo = $qrow['csInfo'];
              $scID = $qrow['scID'];
              $price = $qrow['price'];
              $scrow = mysqli_fetch_assoc(mysqli_query($conn, "select * from servicecategory where scID=$scID"));
              $serviceName = $scrow['scName'];
            ?>
              <div class="col-lg-3 col-md-3 mb-2">
                <div class="card">
                  <div class="card-body position-relative">
                    <input class="form-check-input" type="radio" name="service" value="<?php echo $clName; ?>" class="position-absolute" style="top:0; right:0; width:30px;height:30px; border-radius:0;" required>
                  </div>
                  <label style="color:green;" for="serviceCheckbox_<?php echo $clName; ?>" class="checkbox-label"><b><?php echo $clName; ?></b></label>
                  <hr>
                  <div class="p-1">
                    <p><?php echo $clInfo; ?></p>
                  </div>
                  <hr>
                  <div>
                    <p><b><?php echo $price; ?> MMK</b></p>
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
                $cusID = $_SESSION['cusID'];
                $qr = mysqli_fetch_assoc(mysqli_query($conn, "select * from customer where cusID=$cusID"))
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
  <?php } ?>

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