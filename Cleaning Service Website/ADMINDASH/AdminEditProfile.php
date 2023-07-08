<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <!-- CSS Stylesheets -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">
  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <!-- Libraries Stylesheet -->

 

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  
</head>

<body>
  <?php
  include 'nav.php';
  ?>
  <div id="layoutSidenav">
    <?php
    include 'sidebar.php';
    ?>
    <div id="layoutSidenav_content">
      <main>
        <section class="section about-section gray-bg" id="about">
          <div class="container">
            <div class="row align-items-center flex-row-reverse">
              <div class="col-lg-10">
                <div class="about-text go-to">
                  <div class="row">
                    <div class="col-sm-8">
                      <h3 class="dark-color">Edit Profile</h3>
                    </div>
                  </div>
                  <div class="row about-list">
                    <div class="col-md-6">
                      <?php
                      include '../db.php';
                      $adID=$_SESSION['adID'];
                      $qr = mysqli_fetch_assoc(mysqli_query($conn, "select * from admin where AdID=$adID"));
                      ?>
                      <form  method="post" enctype="multipart/form-data">
                        <div class="form-group row">  
                          <label for="firstName" class="col-sm-4 col-form-label">First Name</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" required id="firstName" name="firstName" value="<?php echo $qr['adFirstName']; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">Last Name</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" required id="lastName" name="lastName" value="<?php echo $qr['adLastName']; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-4 col-form-label">Email</label>
                          <div class="col-sm-8">
                            <input type="email" class="form-control" required id="email" name="email" value="<?php echo $qr['Email']; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="image" class="col-sm-4 col-form-label">Image</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control"  id="img" name="img" value="<?php echo $qr['adImage']; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="password" class="col-sm-4 col-form-label">Current Password</label>
                          <div class="col-sm-8">
                            <input type="password" class="form-control" required id="password" name="cpassword" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="npassword" class="col-sm-4 col-form-label">New Password</label>
                          <div class="col-sm-8">
                            <input type="password" class="form-control" required id="npassword" name="npassword">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4"></div>
                          <div class="col-sm-8">
                            <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-6">
                      <img style="width: 200px;
                        height: 200px;
                        border-radius: 20%;
                        object-fit: cover;
                        object-position: center;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" src="assets/img/<?php echo $qr['adImage']; ?>" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>
    <?php include 'footer.php'; ?>
  
  <?php
  if(isset($_POST['save'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $adID=$_SESSION['adID'];
        $email = $_POST['email'];
        $qr=mysqli_fetch_assoc(mysqli_query($conn, "select * from admin where adID=$adID"));
        $pss=$qr['Password'];
        $npassword=$_POST['npassword'];
        $cpassword=$_POST['cpassword'];
        $img=$_FILES['img']['name'];
        $tmp=$_FILES['img']['tmp_name'];

        if($pss==$cpassword){
          if($tmp==NULL){
            $q1=mysqli_query($conn, "update admin set adFirstName='$firstName', adLastName='$lastName', Email='$email', Password='$npassword' where adID=$adID");
            echo "<script> alert('Updated Successfully'); location.assign('AdminProfile.php'); </script>";
          } else {
            $q1=mysqli_query($conn, "update admin set adFirstName='$firstName', adLastName='$lastName', Email='$email', adImage='$img', Password='$npassword' where adID=$adID");
            move_uploaded_file($tmp, 'assets/img/'.$img);
            echo "<script> alert('Updated Successfully'); location.assign('AdminProfile.php'); </script>";
          }
        } else {
          echo "<script> alert('Password Incorrect!'); </script>";
        }
      }
      ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>

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
