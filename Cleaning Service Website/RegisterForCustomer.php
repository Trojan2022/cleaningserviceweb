<?php session_start(); ?>
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
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-3">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Register Form For Customer</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="text"
                                                        placeholder="Enter your first name" name="fname" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputLastName" type="text"
                                                        placeholder="Enter your last name" name="lname" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputImage" type="file"
                                                       name="img" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputEmail" type="email"
                                                        placeholder="Enter your Email" name="email" />
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPassword" type="password"
                                                        placeholder="Create a password" name="password" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPhoneNumber" type="text"
                                                        placeholder="Phone Number" name="phone" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <textarea class="form-control" id="inputAddress"
                                                        placeholder="Enter Your Address" name="address" rows="2"
                                                        style="line-height: 22px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <input type="submit" class="btn btn-info" name="create" value="Register"
                                                class="form-control" style="width:100px;">
                                        </div>
                                    </form>
                                    <?php 
include ('db.php');
if(isset($_REQUEST['create']))
{
    $cusFirstName=$_REQUEST['fname'];
    $cusLastName=$_REQUEST['lname'];
    $cusEmail=$_REQUEST['email'];
    $cusPassword=$_REQUEST['password'];
    $cusPhone=$_REQUEST['phone'];
    $cusAddress=$_REQUEST['address'];
    $image=$_FILES['img']['name'];
    $tmp=$_FILES['img']['tmp_name'];
    $query="SELECT * FROM Customer
    WHERE cusEmail='$cusEmail'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_num_rows($result);
    if ($row>0) 
    {
        echo "<script>alert('Already Used this Email');</script>";
    }
    else
    { 	 	 	 	 	 
        $query="INSERT INTO customer(cusFirstName, cusLastName, cusImage, cusEmail,	cusPassword, cusPhone, cusAddress)
        VALUES('$cusFirstName','$cusLastName', '$image','".$cusEmail."','$cusPassword', '$cusPhone', '$cusAddress')";
        move_uploaded_file($tmp, 'img/'.$image);
        $flag=mysqli_query($conn,$query);
        if($flag==true)
        {
            echo "<script>alert('Register Successful!'); location.assign('LoginCustomer.php');</script>";
        } 
        else
        {
        echo mysqli_error($con);    
        }
        
    }
}
?>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a style="color:black;" href="LoginCustomer.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>
    </div>
    <script>
 // Global variable to store the error messages
var errorMessages = {};

// Validate the form before submission
function validateForm() {
    // Reset the error messages
    errorMessages = {};

    var firstName = document.getElementById('inputFirstName').value;
    var lastName = document.getElementById('inputLastName').value;
    var email = document.getElementById('inputEmail').value;
    var password = document.getElementById('inputPassword').value;
    var phoneNumber = document.getElementById('inputPhoneNumber').value;
    var address = document.getElementById('inputAddress').value;

    var isValid = true;

    // Validate first name
    if (firstName.trim() === '') {
        isValid = false;
        showError('inputFirstName', 'Please enter your first name.');
    } else {
        hideError('inputFirstName');
    }

    // Validate last name
    if (lastName.trim() === '') {
        isValid = false;
        showError('inputLastName', 'Please enter your last name.');
    } else {
        hideError('inputLastName');
    }

    // Validate email
    if (email.trim() === '') {
        isValid = false;
        showError('inputEmail', 'Please enter your email address.');
    } else if (!isValidEmail(email)) {
        isValid = false;
        showError('inputEmail', 'Please enter a valid email address.');
    } else {
        hideError('inputEmail');
    }

    // Validate password
    if (password.trim() === '') {
        isValid = false;
        showError('inputPassword', 'Please enter a password.');
    } else {
        hideError('inputPassword');
    }

    // Validate phone number
    if (phoneNumber.trim() === '') {
        isValid = false;
        showError('inputPhoneNumber', 'Please enter your phone number.');
    } else {
        hideError('inputPhoneNumber');
    }

    // Validate address
    if (address.trim() === '') {
        isValid = false;
        showError('inputAddress', 'Please enter your address.');
    } else {
        hideError('inputAddress');
    }

    return isValid;
}

// Display error message for a specific input field
function showError(inputId, message) {
    var inputField = document.getElementById(inputId);
    var errorContainer = inputField.parentNode.querySelector('.invalid-feedback');

    if (!errorContainer) {
        errorContainer = document.createElement('div');
        errorContainer.className = 'invalid-feedback';
        inputField.classList.add('is-invalid');
        inputField.parentNode.appendChild(errorContainer);
    }

    errorContainer.innerText = message;
    errorMessages[inputId] = true;
}

// Hide error message for a specific input field
function hideError(inputId) {
    var inputField = document.getElementById(inputId);
    var errorContainer = inputField.parentNode.querySelector('.invalid-feedback');

    if (errorContainer) {
        errorContainer.innerText = '';
        inputField.classList.remove('is-invalid');
        delete errorMessages[inputId];
    }
}

// Check if the email address is valid
function isValidEmail(email) {
    // Regular expression for email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

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
