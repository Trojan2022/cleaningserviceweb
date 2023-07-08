<?php session_start();
if(!isset($_SESSION['adID'])){
  echo "<script> location.assign('LoginAdmin.php'); </script>";
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Service Category Service Page</title>
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
        <?php
        require('../db.php');
        if (isset($_POST['submit'])) {
          $adID = $_SESSION['adID'];
          $scName = $_POST['scName'];
      
          $query = "INSERT INTO ServiceCategory (scName) VALUES ('$scName')";
          $result = mysqli_query($conn, $query);
      
          if ($result) {
              $cidQuery = "SELECT LAST_INSERT_ID()";
              $cidResult = mysqli_query($conn, $cidQuery);
              $row = mysqli_fetch_array($cidResult);
              $cid = $row[0];
      
              $assignQuery = "INSERT INTO assign (scID, adID) VALUES ('$cid', '$adID')";
              $assignResult = mysqli_query($conn, $assignQuery);
      
              if ($assignResult) {
                  echo "<script>alert('Successfully Added!');location.assign('ServiceCategory.php');</script>";
              } else {
                  echo "<script>alert('Added Fail! Try Again');location.assign('ServiceCategory.php');</script>";
              }
          } else {
              echo "<script>alert('Added Fail! Try Again');location.assign('ServiceCategory.php');</script>";
          }
      }
      
        if (isset($_GET['scID'])) {
          $scID=$_GET['scID'];
          $scName = $_GET['scName'];
        ?>
          <div class="container-fluid mt-5">
            <form method="post">
              <div class="row mb-3">
                <div class="col-md-6">
                  <input type="text" name="scName" placeholder="Service Category Name" class="form-control" value="<?php echo $scName; ?>" required>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-1">
                  <button type="submit" name="Update" class="btn btn-success">Update</button>
                </div>
                <div class="col-md-1">
                  <button type="reset" class="btn btn-primary">Cancel</button>
                </div>
              </div>
            </form>
          </div>
          <?php 
if(isset($_POST['Update'])){
  $scID=$_REQUEST['scID'];
  $scName=$_REQUEST['scName'];
  $qq=mysqli_query($conn, "update ServiceCategory set scName='$scName' where scID=$scID");
  if($qq){
  echo "<script> alert('Updated Successfully!'); location.assign('ServiceCategory.php');</script>";
  }
}
    ?>
        <?php } else {
        ?>
          <div class="container-fluid mt-5">
            <form method="post">
              <div class="row mb-3">
                <div class="col-md-6">
                  <input type="text" name="scName" placeholder="Service Category Name" class="form-control" required>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-1">
                  <button type="submit" name="submit" class="btn btn-success">Add</button>
                </div>
                <div class="col-md-1">
                  <button type="button" class="btn btn-primary">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        <?php } ?>
        <div class="container mt-5">
          <table class="table table-dark">
            <thead>
              <tr>
                <th>NO</th>
                <th>Service Category Name</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 1;
              $select = mysqli_query($conn, "SELECT * FROM servicecategory");
              while ($data = mysqli_fetch_assoc($select)) {
                $scName = $data['scName'];
                $scID = $data['scID'];
              ?>
                <tr>
                  <td><?php echo $count; ?></td>
                  <td><?php echo $data['scName']; ?></td>
                  <td><a class="btn btn-primary"  href="?scID=<?php echo $data['scID']; ?>&scName=<?php echo $data['scName']; ?>">Edit</a></td>
                  <td>
                    <a class="btn btn-danger"  href="?scdelID=<?php echo $data['scID'];?>">Delete</a>
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
      <?php include 'footer.php'; ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>
<?php
if(isset($_REQUEST['scdelID'])){
  $scID=$_REQUEST['scdelID'];
  $qdel=mysqli_query($conn, "Delete from ServiceCategory where scID=$scID");
  echo "<script> alert ('Deleted Successfully'); location.assign('ServiceCategory.php'); </script>";
}
?>

