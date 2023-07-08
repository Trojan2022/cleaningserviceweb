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

<body class="">
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
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header" style="background-color:gray">
                  <h3 class="text-center font-weight-light my-4" style="color:white">Login</h3>
                </div>
                <div class="card-body bg-dark">
                  <?php
                  include 'db.php';
                  $emailValue = isset($_POST['email']) ? $_POST['email'] : '';
                  $passwordValue = isset($_POST['password']) ? $_POST['password'] : '';

                  $errorMessage = '';

                  if (isset($_POST['login'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $qry = "SELECT * FROM customer WHERE cusEmail='" . $email . "' AND cusPassword='" . $password . "'";
                    $res = mysqli_query($conn, $qry);
                    $row = mysqli_num_rows($res);
                    $retri = mysqli_fetch_assoc($res);
                    if ($row) {
                      $_SESSION['cusID'] = $retri['cusID'];
                      echo "<script>alert('Successfully Login'); location.assign('CustomerProfile.php');</script>";
                      exit();
                    } else {
                      $errorMessage = 'Login Failed! Please check Email and Password';
                    }
                  }
                  ?>
                  <form method="post">
                    <?php if (!empty($errorMessage)) { ?>
                      <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                      </div>
                    <?php } ?>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="inputEmail" type="email" placeholder="Enter Your Email"  name="email" value="<?php echo $emailValue; ?>" required />
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="inputPassword" type="password" placeholder="Enter Your Password"  name="password" value="<?php echo $passwordValue; ?>" required />
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                      <input type="submit" name="login" class="btn btn-info" style="color:white" value="Login">
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center py-3">
                  <div class="small" ><a style="color:black;" href="RegisterForCustomer.php">Need an account? Sign up!</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
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

</html>
</body>
<div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important; position:fixed; bottom:0">
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
