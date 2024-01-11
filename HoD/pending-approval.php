<?php require_once "controller.php"; 
?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM hod WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        
    }
}else{
    header('Location: hod-login.php');
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

    <title><?php echo $fetch_info['name'] ?> - Pending Approval</title>

    <!-- Custom fonts for this template-->
    <link href="../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../CSS/faculty.min.css" rel="stylesheet">
    <link href="../CSS/table.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
.notification {
    background-color: crimson;
    color: white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 14px;
    text-align: center;
    line-height: 30px;
    position: absolute;
    top: 10px; /* Adjust the positioning as needed */
    right: 10px; /* Adjust the positioning as needed */
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
}
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
                        <h1 class="h3 mb-0 text-gray-800">Forms to be Approved</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                FDP / STTP / PDP
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT COUNT(*) AS f_count FROM fdp WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h6"><a href="fdp-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Seminar / Workshop
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS seminar_count FROM seminar WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['seminar_count'];
                                            ?>
                                            <div class="h6"><a href="seminar-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Pro Body Membership
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS pbm_count FROM pbm WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['pbm_count'];
                                            ?>
                                            <div class="h6"><a href="pbm-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Resource Person
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS resource_count FROM resource_person WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['resource_count'];
                                            ?>
                                            <div class="h6"><a href="resource_person-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Online Courses
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS oc_count FROM online_course WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['oc_count'];
                                            ?>
                                            <div class="h6"><a href="online-course-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Event Organized
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS event_count FROM event_organized WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['event_count'];
                                            ?>
                                            <div class="h6"><a href="event-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Awards & Recognition
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS award_count FROM awards WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['award_count'];
                                            ?>
                                            <div class="h6"><a href="award-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Extension & Outreach
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS ext_count FROM extension WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['ext_count'];
                                            ?>
                                            <div class="h6"><a href="extension-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Faculty Exchange
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT IFNULL(COUNT(*), 0) AS f_count FROM exchange WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h6"><a href="exchange-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Conferences
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT COUNT(*) AS f_count FROM conference WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h6"><a href="conference-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Journals Published
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT COUNT(*) AS f_count FROM journal WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h6"><a href="journal-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Book Publications
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT COUNT(*) AS f_count FROM book WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h6"><a href="book-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Patent
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT COUNT(*) AS f_count FROM patent WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h6"><a href="patent-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Consultancy
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT COUNT(*) AS f_count FROM consultancy WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h6"><a href="consultancy-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Research Projects
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT COUNT(*) AS f_count FROM fdp WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h6"><a href="research-projects-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Research Article View
                                            </div>
                                            <?php 
                                                $department = $fetch_info['department'];
                                                $userid = $fetch_info['userid'];
                                                $query = "SELECT COUNT(*) AS f_count FROM fdp WHERE department = '$department' AND hod_approval = 'Pending Approval'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $count = $row['f_count'];
                                            ?>
                                            <div class="h6"><a href="article-pending.php">Approve Now!</a></div>
                                            <div class="h5 notification mb-0 font-weight-bold text-white-400"><?php echo $count; ?></div>
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
                
                    
                    

                    <!-- Content Row -->
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