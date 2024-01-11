<?php require_once "controller.php"; 
?>

<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $fetch_info['name'] ?> - Administrator Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,500,600,700&display=swap" rel="stylesheet">
    <link href="CSS/popup.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="../CSS/faculty.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="icon" href="../Assets/Images/favicon-32x32.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

</style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "includes/sidebar.php";?>
        <!-- End of Sidebar -->
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "includes/header.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">FDP / STTP / PDP - Dashboard</h1>
                        <a href="fdp-report.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

<!-- Content Row -->
                    <div class="row">
                        <!-- Faculty pursuing Ph.D -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Approved By HOD
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php 
                                                // Prepare the query with placeholders
                                                $query = "SELECT COUNT(*) as total FROM fdp WHERE hod_approval = ?";
                                                $stmt = $con->prepare($query);

                                                // Bind parameter and execute the query
                                                $hodApproval = "Approved";
                                                $stmt->bind_param("s", $hodApproval);
                                                $stmt->execute();

                                                // Get the result
                                                $result = $stmt->get_result();
                                                $row = $result->fetch_assoc();

                                                // Get the count
                                                $count = $row['total'];

                                                echo $count;

                                                // Close the prepared statement and the database connection
                                                $stmt->close();
                                            ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total no. of faculty-->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Approved By HOD and IQAC
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    // Prepare the query with placeholders
                                                    $query = "SELECT COUNT(*) as total FROM fdp WHERE hod_approval = ? AND admin_approval = ?";
                                                    $stmt = $con->prepare($query);

                                                    // Bind parameters and execute the query
                                                    $hodApproval = "Approved";
                                                    $adminApproval = "Approved";
                                                    $stmt->bind_param("ss", $hodApproval, $adminApproval);
                                                    $stmt->execute();

                                                    // Get the result
                                                    $result = $stmt->get_result();
                                                    $row = $result->fetch_assoc();

                                                    // Get the count
                                                    $count = $row['total'];

                                                    echo $count;
                                                    // Close the prepared statement and the database connection
                                                    $stmt->close();
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Faculty with PhD -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Pending Approval By HOD
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php 
                                                // Prepare the query with placeholders
                                                $query = "SELECT COUNT(*) as total FROM fdp WHERE hod_approval = ?";
                                                $stmt = $con->prepare($query);

                                                // Bind parameter and execute the query
                                                $hodApproval = "Pending Approval";
                                                $stmt->bind_param("s", $hodApproval);
                                                $stmt->execute();

                                                // Get the result
                                                $result = $stmt->get_result();
                                                $row = $result->fetch_assoc();

                                                // Get the count
                                                $count = $row['total'];

                                                echo $count;

                                                // Close the prepared statement and the database connection
                                                $stmt->close();
                                            ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Faculty pursuing Ph.D -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Pending Approval By IQAC
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php 
                                                // Prepare the query with placeholders
                                                $query = "SELECT COUNT(*) as total FROM fdp WHERE admin_approval = ?";
                                                $stmt = $con->prepare($query);

                                                // Bind parameter and execute the query
                                                $adminApproval = "Pending Approval";
                                                $stmt->bind_param("s", $adminApproval);
                                                $stmt->execute();

                                                // Get the result
                                                $result = $stmt->get_result();
                                                $row = $result->fetch_assoc();

                                                // Get the count
                                                $count = $row['total'];

                                                echo $count;

                                                // Close the prepared statement and the database connection
                                                $stmt->close();
                                            ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    <!-- Content Row -->
                </div>

                <!-- Bar Chart -->
                                        
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">FDP Data Analytics</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                        <canvas id="myBarChart"></canvas>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="category">Category:</label>
                            <select class="form-control" id="category" name="category">
                                <option value="fdp">FDP</option>
                                <option value="seminar">Seminar</option>
                                <option value="pbm">PBM</option>
                                <!-- add options for other categories here -->
                            </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="year">Academic Year:</label>
                            <select class="form-control" id="year" name="year">
                                <?php
                                $current_year = date('Y');
                                $start_year = $current_year - 1;
                                for ($i = $start_year; $i <= $current_year; $i++) {
                                $year_label = $i . '-' . ($i + 1);
                                echo '<option value="' . $year_label . '">' . $year_label . '</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "../HOD/includes/footer.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure You want to Leave?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="log-out.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script>
       
    </script>

<script>
document.getElementById("filterButton").addEventListener("click", function() {
  var popup = document.getElementById("popup");
  popup.style.display = "block";

  var closeButton = popup.getElementsByClassName("close")[0];
  closeButton.addEventListener("click", function() {
    popup.style.display = "none";
  });
});
</script>
    <!-- Bootstrap core JavaScript-->
    <script src="../Assets/vendor/jquery/jquery.min.js"></script>
    <script src="../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../Assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../JS/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../Assets/vendor/chart.js/Chart.min.js"></script>
    <script src="https://kit.fontawesome.com/85d9b987b8.js" crossorigin="anonymous"></script>
    <!-- Page level custom scripts -->
    <script src="../JS/demo/chart-fdp-bar-demo.js"></script>
    <script src="../JS/demo/chart-area-demo.js"></script>
    <script src="../JS/demo/chart-pie-demo.js"></script>

</body>

</html>