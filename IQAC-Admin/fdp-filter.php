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

    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#ajaxdata").load("report/allrecords.php");
        $("#price_dropdown").change(function(){
            var selected=$(this).val();
            $("#ajaxdata").load("report/search.php",{selected_price: selected});
        });
        $("#refresh").click(function(){
            $("#ajaxdata").load("report/allrecords.php");
        });
    });
</script>
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
<div class="row col-lg-16">
        
        <form method="post" class="form-horizontal" id="filterForm">
            <div class="form-row">
                
                <div class="form-group col-md-3">
                <label for="department" class="control-label">Department:</label>
                <select name="department" class="form-control" id="department">
                    <option style="display:none" value="">---Select Department---</option>
                    <option value="Automobile Engineering">Automobile Engineering</option>
                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                    <option value="Civil Engineering">Civil Engineering</option>
                    <option value="Computer Application">Computer Application</option>
                    <option value="dept5">Department 5</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="approval" class="control-label">Approval:</label>
                <select name="approval" class="form-control" id="approval">
                    <option value="">---Select Approval---</option>
                    <option value="approved">Approved</option>
                    <option value="pending approval">Pending Approval</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="fromDate" class="control-label">From Date:</label>
                <input type="date" name="fromDate" id="fromDate" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="toDate" class="control-label">To Date:</label>
                <input type="date" name="toDate" id="toDate" class="form-control">
            </div>

            <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
</div>

        </form>
        
    </div>
    <br><br>
    <div id="ajaxdata"></div>


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