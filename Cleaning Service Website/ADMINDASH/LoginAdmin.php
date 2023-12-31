<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Admin Login Page</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Admin Login</h3>
                </div>
                <div class="card-body">
                  <?php
                  include '../db.php';
                  if (isset($_POST['login'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $qry = "SELECT * FROM admin WHERE Email='" . $email . "' AND Password='" . $password . "'";
                    $res = mysqli_query($conn, $qry);
                    $row = mysqli_num_rows($res);
                    $retri = mysqli_fetch_assoc($res);
                    if ($row) {
                      $_SESSION['adID'] = $retri['AdID'];
                      echo "<script>alert('Successfully Login'); location.assign('AdminDashboard.php');</script>";
                      exit();
                    } else {
                      $error = "Login Failed. Please check your email and password.";
                      $emailValue = $email; // Store the submitted email value
                      $passwordValue = $password; // Store the submitted password value
                    }
                  }
                  ?>
                  <form method="post">
                    <div class="form-floating mb-3">
                      <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email" value="<?php echo isset($emailValue) ? $emailValue : ''; ?>" required />
                      <label for="inputEmail">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" value="<?php echo isset($passwordValue) ? $passwordValue : ''; ?>" required />
                      <label for="inputPassword">Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                      <input type="submit" name="login" class="btn btn-primary" value="Login">
                    </div>
                  </form>
                  <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                  <?php } ?>
                </div>
                <div class="card-footer text-center py-3">
                  <div class="small"><a href="RegisterForAdmin.php">Need an account? Sign up!</a></div>
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
</body>

</html>
