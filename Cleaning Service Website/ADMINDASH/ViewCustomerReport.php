<?php

include '../db.php';
$selectedy = date('Y');
if (isset($_REQUEST['find'])) {
  $y = $_REQUEST['y'];
  $selectedy = $y;
  $month = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);

  $pSQL = "SELECT count(cusID) as custotal, Month(cusJoinDate) as cusmonth FROM customer WHERE YEAR(cusJoinDate) = '$y' group by cusMonth";
  $pCON = mysqli_query($conn, $pSQL);
  while ($pROW = mysqli_fetch_assoc($pCON)) {
    foreach ($month as $key => $val) {
      $cdate = $pROW['cusmonth'];
      if ($cdate == $key) {
        $month[$key] += $pROW['custotal'];
      }
    }
  }
  foreach ($month as $key => $val) {
    $dataPoints[] = array("y" => $val, 'label' => date("M", mktime(0, 0, 0, $key)));
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>View Customer Report</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed" style="background-color: rgba(0,0,0,0.7);">
  <?php
  include 'nav.php';
  include '../db.php';
  ?>
  <div id="layoutSidenav">
    <?php
    include 'sidebar.php';
    ?>
    <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header d-flex justify-content-between row">
                  <div class="header-title col-sm-4">
                    <h4 class="card-title">Yearly Number of Customer Report</h4>
                  </div>

                  <div class="col-sm-6">
                    <form method="post">
                      <select class="form-control" name="y">
                        <?php
                        // Generate select options for the past 10 ys
                        $cury = date('Y');
                        for ($i = $cury; $i >= $cury - 10; $i--) {
                          $selected = ($selectedy == $i) ? 'selected' : '';
                          echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                      </select>
                  </div>
                  <div class="col-sm-2">
                    <button type="submit" name="find" style="width:100px; font-weight:bolder; float:right;" class="btn btn-info">Find</button>
                  </div>
                  </form>
                </div>


              </div>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div class="row justify-content-between">
                  <div class="col-sm-12 col-md-12">

                    <div class="form-group mb-0">
                      <div id="chartContainer" style="height: 370px; width: 100%;"></div>

                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </main>
  <!-- End manage Subjects -->

  <!-- footer start -->
  <?php include 'footer.php'; ?>
  <!-- footer end -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

  <!-- Income Report Line Chart -->
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

  <script>
    window.onload = function() {

      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
          text: "Yearly Number of Customer"
        },
        axisY: {
          title: "Number of Customer",
          //valueFormatString: "#0,,.",
          //suffix: "mn",
          //prefix: "$"
        },
        axisX: {
          title: "Month",
          //valueFormatString: "#0,,.",
          //suffix: "mn",
          //prefix: "$"
        },
        data: [{
          type: "spline",
          //markerSize: 5,
          //xValueFormatString: "YYYY",
          //yValueFormatString: "$#,##0.##",
          //xValueType: "dateTime",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });

      chart.render();

    }
  </script>
</body>

</html>