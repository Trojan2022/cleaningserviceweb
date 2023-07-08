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
      font-size: 16px;
      color: #3f4b5a;
    }

    .about-avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      object-position: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>

<body>
  <section id="about" class="section gray-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="about-avatar">
            <?php
              $profileImage = $qr['cusImage'];
              if (!empty($profileImage)) {
                echo '<img src="img/' . $profileImage . '" alt="Profile Image" class="profile-image">';
              } else {
                echo '<img src="img/default-profile-image.png" alt="Default Profile Image" class="profile-image">';
              }
            ?>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="section-title">
            <h2>About Me</h2>
          </div>
          <div class="about-text">
            <h3><?php echo $qr['cusName']; ?></h3>
            <h6>Customer ID: <?php echo $cusID; ?></h6>
            <p>I am a valued customer at this cleaning service company. I have been availing their services for <?php echo $qr['numOfMonths']; ?> months. I am satisfied with their professional and efficient cleaning services. They always provide excellent customer support and ensure a clean and tidy environment in my home.</p>
          </div>
          <div class="about-list">
            <ul class="list-unstyled">
              <li class="media">
                <label>Email:</label>
                <p><?php echo $qr['cusEmail']; ?></p>
              </li>
              <li class="media">
                <label>Phone:</label>
                <p><?php echo $qr['cusPhone']; ?></p>
              </li>
              <li class="media">
                <label>Address:</label>
                <p><?php echo $qr['cusAddress']; ?></p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Add your scripts here -->

</body>

</html>
