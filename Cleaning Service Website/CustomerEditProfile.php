<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Profile Edit</title>
  <style>
    /* CSS Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      display: grid;
      gap: 10px;
    }

    label {
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="file"] {
      border: none;
      padding: 0;
      background-color: transparent;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .error-message {
      color: red;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Profile Edit</h1>
    <form method="post" enctype="multipart/form-data">
      <?php 
        include 'db.php';
        $cusID=$_SESSION['cusID'];
        $q=mysqli_fetch_assoc(mysqli_query($conn, "select * from customer where cusID=$cusID"));
      ?>
      <label for="firstName">First Name</label>
      <input type="text" id="firstName" name="firstName" value="<?php echo $q['cusFirstName']; ?>" required>

      <label for="lastName">Last Name</label>
      <input type="text" id="lastName" name="lastName" value="<?php echo $q['cusLastName']; ?>" required>

      <label for="image">Image</label>
      <input type="file" id="image" name="img" required>

      <label for="password">New Password</label>
      <input type="password" id="password" name="password" required>

      <label for="cpassword">Confirm Password</label>
      <input type="password" id="cpassword" name="cpassword" required>

      <label for="phone">Phone</label>
      <input type="text" id="phone" name="phone" value="<?php echo $q['cusPhone'];?>" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?php echo $q['cusEmail']; ?>" required>

      <label for="address">Address</label>
      <textarea id="address" name="address" rows="4" required><?php echo $q['cusAddress']; ?></textarea>

      <input type="submit" name='save' value="Save">
    </form>
    <?php  
      include 'db.php';
      if(isset($_POST['save'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $phone=$_POST['phone'];
        $img=$_FILES['img']['name'];
        $tmp=$_FILES['img']['tmp_name'];

        if($password==$cpassword){
          if($tmp==NULL){
            $q1=mysqli_query($conn, "update customer set cusFirstName='$firstName', cusLastName='$lastName', cusEmail='$email', cusPhone='$phone', cusAddress='$address', cusPassword='$password'");
            echo "<script> alert('Updated Successfully'); </script>";
          } else {
            $q1=mysqli_query($conn, "update customer set cusFirstName='$firstName', cusLastName='$lastName', cusEmail='$email', cusImage='$img', cusPhone='$phone', cusAddress='$address', cusPassword='$password'");
            move_uploaded_file($tmp, 'img/'.$img);
            echo "<script> alert('Updated Successfully'); location.assign('CustomerProfile.php'); </script>";
          }
        } else {
          echo "<script> alert('Password Not Match!'); </script>";
        }
      }
    ?>
  </div>
</body>
</html>
