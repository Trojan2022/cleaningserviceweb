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
  .feedback-form {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #f2f2f2;
  padding: 20px;
  width: 300px;
  border-radius: 5px;
  z-index: 9999;
}

.close-button {
  float: right;
  cursor: pointer;
}

button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

form {
  margin-top: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
textarea {
  width: 100%;
  padding: 5px;
  border-radius: 4px;
  border: 1px solid #ccc;
  resize: vertical;
}

input[type="submit"] {
  margin-top: 10px;
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

</style>

<body class="bg-dark">
  <!-- Header Start -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 d-none d-lg-block" style="background-color: white; text-shadow: 2px 2px 4px #000000;">
        <a href="" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
          <h1 class="m-0 display-3 text-info">KMC</h1>
        </a>
      </div>
      <div class="col-lg-9">
        <div class="row d-none d-lg-flex">
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
        <?php include 'nav.php'; include 'db.php'; ?>
      </div>
    </div>
  </div>
  <!-- Header End -->
  <!-- Page Header Start -->
      <main>
        <!-- Open Feedback Form Start -->
      <div id="feedbackForm" class="feedback-form">
    <h2>Feedback Form</h2>
    <span id="closeButton" class="close-button" onclick="closeForm()">&times;</span>
    <form  method="post">
      <?php 
      $cusID=$_SESSION['cusID'];
      $qrow=mysqli_fetch_assoc(mysqli_query($conn, "select * from customer where cusID=$cusID"));

      ?>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo $qrow['cusFirstName'].
      ' '.$qrow['cusLastName'];?>" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo $qrow['cusEmail'];?>" required>

      <label for="message">Message:</label>
      <textarea id="message" name="message" required></textarea>

      <input type="submit" value="Submit" name="fb">
    </form>
  </div>
  <?php
if(isset($_GET['fbID'])){ ?>
  <script>
    document.getElementById("feedbackForm").style.display = "block";
  </script>
  
<?php
if(isset($_POST['fb'])){
  $fbID=$_GET['fbID'];
$message=$_POST['message'];
$cusID=$_SESSION['cusID'];
$qq=mysqli_query($conn, "Insert Into feedback (fbMessage, cusID) values ('$message', $cusID)");
}
} ?>


  <!-- Open Feedback Form End -->
 

  
        <div class="container mt-5">
          <table class="table table-dark table-striped table-bordered">
            <thead>
              <tr style="color:yellow;" class="bg-info">
                <th>NO</th>
                <th>Customer Name</th>
                <th>Booking Address</th>
                <th>Booking Date</th>
                <th>Booking Status</th>
                <th>Transportation Service Name</th>
                <th>Cleaning Service Name</th>
                <th colspan="2" style="text-align: center;"><b>Action</b></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 1;
              $cusID=$_SESSION['cusID'];
              $select = mysqli_query($conn, "SELECT *, booking.BookingID as bd from booking, bookingservice where booking.bookingID=bookingservice.bookingID and cusID=$cusID");
              while ($data = mysqli_fetch_assoc($select)) {
                $bID=$data['bd'];
                $cusID = $data['cusID'];
                $tpID = $data['tpID'] ?? $tpID = 0;
                $csID = $data['csID'] ?? $csID = 0;
                $cc = mysqli_fetch_assoc(mysqli_query($conn, "select * from customer where cusID=$cusID"));
                $aa = mysqli_fetch_assoc(mysqli_query($conn, "select * from transportationservice where tpID=$tpID"));
                $bb = mysqli_fetch_assoc(mysqli_query($conn, "select * from cleaningservice where csID=$csID"));
              ?>
                <tr>
                  <td><?php echo $count; ?></td>
                  <td><?php echo $cc['cusFirstName'] . ' ' . $cc['cusLastName']; ?></td>
                  <td><?php echo $data['bookingAddress']; ?></td>
                  <td><?php echo $data['bookingDate']; ?></td>
                  <td><?php echo $data['bookingStatus']; ?></td>
                  <td style="text-align: center;"><?php echo $aa['tpName'] ?? '-----'; ?></td>
                  <td><?php echo $bb['csName'] ?? '-----'; ?></td>
                  <td>
                  <a class="btn btn-danger" href="?bdrID=<?php echo $bID; ?>">Reject</a>
                  </td>
                  <td>
                  <a class="btn btn-info" id="openFormButton"  href="?fbID=<?php echo $bID; ?>">Feedback</a>
                  </td>
                </tr>
              <?php
                $count += 1;
              }
              ?>
            </tbody>
          </table>
        </div>
      </main>
      <a href="#" class="btn btn-primary px-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>

<?php
if (isset($_GET['bdrID'])) {
   $bdrID = $_GET['bdrID'];
   $h = mysqli_query($conn, "Delete from booking where bookingID=$bdrID"); 
   $y=mysqli_query($conn, "delete from bookingservice where bookingID=$bdrID");
   echo "<script> alert('Booking Cancelled!'); location.assign('BookingHistory.php');</script>";
 }

 if(isset($_GET['fbID'])){
  $fbID=$_GET['fbID'];

 }
 ?>
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
  <!-- JavaScript -->
  <script src="js/feedback.js"></script>
  <script>
  function openForm() {
  document.getElementById("feedbackForm").style.display = "block";
}

function closeForm() {
  document.getElementById("feedbackForm").style.display = "none";
}
</script>
</body>

</html>
   