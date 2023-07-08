<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Cleaning Service Page</title>
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
          $csName = $_POST['csName'];
          $csInfo = $_POST['csInfo'];
          $price = $_POST['price'];
          $scID = $_POST['scID'];
          $query = "INSERT INTO CleaningService(csName,csInfo,scID, price) VALUES ('$csName','$csInfo', $scID, $price);";
          $result = mysqli_query($conn, $query);
          if ($result) {
            echo "<script>alert('Successfully Added!');location.assign('CleaningService.php');</script>";
          } else {
            echo "<script>alert('Added Fail! Try Again');location.assign('CleaningService.php');</script>";
          }
        }
        if (isset($_GET['csID'])) {
          $csID = $_GET['csID'];
          $csName = $_GET['csName'];
          $csInfo = $_GET['csInfo'];
          $scID = $_GET['scID'];
          $price=$_GET['price'];
        ?>
          <div class="container-fluid mt-5">
            <form method="post">
              <div class="row mb-3">
                <div class="col-md-6">
                  <input type="text" name="csName" placeholder="Cleaning Service Name" class="form-control" value="<?php echo $csName; ?>" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="form-group col-sm-6">
                  <textarea class="form-control" placeholder="Cleaning Service Info" name="csInfo" rows="2" style="line-height: 22px;"><?php echo $csInfo; ?></textarea>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  <select name="scID" class="form-control" id="scID" required>
                    <?php
                    $q = mysqli_query($conn, "select * from servicecategory");
                    while ($r = mysqli_fetch_assoc($q)) {
                    ?>
                      <option value="<?php echo $r['scID']; ?>"><?php echo $r['scName']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  <input type="number" name="price" placeholder="price" class="form-control" value="<?php echo $price; ?>" required>
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
          if (isset($_POST['Update'])) {
            $csID = $_REQUEST['csID'];
            $csName = $_REQUEST['csName'];
            $csInfo = $_REQUEST['csInfo'];
            $scID = $_REQUEST['scID'];
            $price = $_REQUEST['price'];
            $qq = mysqli_query($conn, "update CleaningService set csName='$csName', csInfo='$csInfo', scID=$scID, price=$price where csID=$csID");
            if ($qq) {
              echo "<script> alert('Updated Successfully!'); location.assign('CleaningService.php');</script>";
            }
          }
          ?>
        <?php } else {
        ?>
          <div class="container-fluid mt-5">
            <form method="post">
              <div class="row mb-3">
                <div class="col-md-6">
                  <input type="text" name="csName" placeholder="Cleaning Service Name" class="form-control" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="form-group col-sm-6">
                  <textarea class="form-control" placeholder="Cleaning Service Info" name="csInfo" rows="2" style="line-height: 22px;"></textarea>
                </div>
              </div>
              <div class="row mt-3">

                <div class="col-md-6">

                  <select name="scID" class="form-control" id="scID" required>
                    <?php
                    $q = mysqli_query($conn, "select * from servicecategory");
                    while ($r = mysqli_fetch_assoc($q)) {
                    ?>
                      <option value="<?php echo $r['scID']; ?>"><?php echo $r['scName']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="row mt-3">
                <div class="col-md-6">
                  <input type="number" name="price" placeholder="Cleaning Service Price" class="form-control" required>
                </div>
              </div>

              </div>
              <div class="row mt-3">
                <div class="col-md-1">
                  <button type="submit" name="submit" class="btn btn-success">Add</button>
                </div>
                <div class="col-md-1">
                  <button type="reset" class="btn btn-primary">Cancel</button>
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
                <th>Cleaning Service Name</th>
                <th>Cleaning Service Info</th>
                <th>Service Category Name</th>
                <th>Price</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 1;
              $select = mysqli_query($conn, "SELECT *, sc.scName FROM CleaningService cs, ServiceCategory sc WHERE sc.scID=cs.scID");
              while ($data = mysqli_fetch_assoc($select)) {
                $scName = $data['scName'];
                $scID = $data['scID'];
              ?>
                <tr>
                  <td><?php echo $count; ?></td>
                  <td><?php echo $data['csName']; ?></td>
                  <td><?php echo $data['csInfo']; ?></td>
                  <td><?php echo $scName ?></td>
                  <td><?php echo $data['price'];?>MMK</td>
                  <td><a class="btn btn-primary" href="?csID=<?php echo $data['csID']; ?>&csName=<?php echo $data['csName']; ?>&scID=<?php echo $data['scID']; ?>&csInfo=<?php echo $data['csInfo']; ?>&price=<?php echo $data['price'];?>">Edit</a></td>
                  <td>
                    <a class="btn btn-danger" href="?csdelID=<?php echo $data['csID']; ?>">Delete</a>
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
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>
<?php
if (isset($_REQUEST['csdelID'])) {
  $csID = $_REQUEST['csdelID'];
  $qdel = mysqli_query($conn, "Delete from CleaningService where csID=$csID");
  echo "<script> alert('Deleted Successful!'); location.assign('CleaningService.php');</script>";
}
?>