<?php require_once "controller.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM user WHERE email = '$email'";
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
    header('Location: login-user.php');
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

    <title><?php echo $fetch_info['name'] ?> - Dashboard</title>
    <link href="../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../CSS/faculty.min.css" rel="stylesheet">
    <link rel="icon" href="../Assets/Images/favicon-16x16.png">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

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
                <?php include "includes/navbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div>

                    <!-- Graph -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    Styling for the area chart can be found in the
                                    <code>/js/demo/chart-area-demo.js</code> file.
                                </div>
                            </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                FDP / STTP / PDP
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS fdp_count FROM fdp WHERE department = '$department' AND userid = '$userid'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['fdp_count'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-forms fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Seminar / Workshop
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS seminar_count FROM seminar WHERE department = '$department' AND userid = '$userid'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['seminar_count'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-forms fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pro Body Membership
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS pbm_count FROM pbm WHERE department = '$department' AND userid = '$userid'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['pbm_count'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-forms fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Resource Person
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS resource_count FROM resource_person WHERE department = '$department' AND userid = '$userid'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['resource_count'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-forms fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Online Courses
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS oc_count FROM online_course WHERE department = '$department' AND userid = '$userid'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['oc_count'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-forms fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Event Organized
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS event_count FROM event_organized WHERE department = '$department' AND userid = '$userid'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['event_count'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-forms fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Awards & Recognition
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS award_count FROM awards WHERE department = '$department' AND userid = '$userid'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['award_count'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-forms fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Extension & Outreach
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS ext_count FROM extension WHERE department = '$department' AND userid = '$userid'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['ext_count'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-forms fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Faculty Exchange
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS f_count FROM exchange WHERE department = '$department' AND userid = '$userid'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-forms fa-2x text-gray-300"></i>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "includes/footer.php"; ?>
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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../Assets/vendor/jquery/jquery.min.js"></script>
    <script src="../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../Assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../JS/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../Assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../JS/demo/chart-area-demo.js"></script>
    <script src="../JS/demo/chart-pie-demo.js"></script>

</body>

</html>