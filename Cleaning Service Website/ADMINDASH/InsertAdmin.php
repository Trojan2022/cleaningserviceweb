<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Transportation Service Page</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed" style="background-color: rgba(0,0,0,0.7);">
  <?php
  include 'nav.php';
  ?>
  <div id="layoutSidenav">
    <?php
    include 'sidebar.php';
    ?>
    <div id="layoutSidenav_content">
      <main>
      <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Add New Employee</h3>
                                </div>
                                <div class="card-body" style="background-color: #100404;">
                                    <form method="post" onsubmit="return validateForm()">
                                        <?php
                                        if (!empty($errors)) {
                                            echo '<div class="alert alert-danger">';
                                            foreach ($errors as $error) {
                                                echo '<p>' . $error . '</p>';
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" name="fname" value="<?php echo isset($fName) ? $fName : ''; ?>" />
                                                    <label for="inputFirstName">First name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" name="lname" value="<?php echo isset($lName) ? $lName : ''; ?>" />
                                                    <label for="inputLastName">Last name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" value="<?php echo isset($email) ? $email : ''; ?>" />
                                                    <label for="inputEmail">Email address</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" name="password" />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <input type="submit" class="btn btn-primary" name="create" value="ADD" class="form-control" style="width:100px;">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="LoginAdmin.php">Login As Another Admin Account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
<?php
include '../db.php';
    if (isset($_REQUEST['create'])) {
        // Collect form data
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
      $qr=mysqli_query($conn, "insert into admin (adFirstName, adLastName, Email, Password) values ('$fname', '$lname', '$email', '$password')");
      echo "<script> alert('Success'); location.assign('ViewAdmin.php'); </script>";
}
?>