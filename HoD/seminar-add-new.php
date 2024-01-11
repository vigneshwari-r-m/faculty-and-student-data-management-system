
<?php 
require_once "controller.php"; 
include "connection.php";
include "controller/form-controls.php";
?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM hod WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: resetcode.php');
            }
        }else{
            header('Location: hod-otp.php');
        }
    }
}else{
    header('Location: login-hod.php');
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

    <title><?php echo $fetch_info['name']?> | Seminar / Workshop</title>

    <!-- Custom fonts for this template-->
    <link href="../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="icon" href="../Assets/Images/favicon-16x16.png">
    <!-- Custom styles for this template-->
    <link href="../CSS/faculty.min.css" rel="stylesheet">
    <style>
            
    main li a:hover{
     background-color:rgba(0,0,0,0.09);
   transition:0.5s;
   letter-spacing:1px;
   text-transform:uppercase;
   border-radius:5px;
  
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
                <?php include'includes/header.php'; ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Seminar / Workshop - Form</h1>                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->

                        <div class="col-xl-auto">

                            <!-- Illustrations -->
                            <div class="card shadow mb-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Details of Seminar / Workshop Attended 
                                        <a href="seminar-form.php" onclick="hideForm()" style="margin-left:550px; align-items: flex-end;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" >
                                        <i class="fi fi-rr-cross-small text-white-500"></i></a> </h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                    <?php include('message.php'); ?>
                                     <form method="POST" action="seminar-add-new.php" enctype='multipart/form-data'>
                                     <div class="form-row">
                                                <div class="form-group col-md-6 text-left">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" value="<?php echo $fetch_info['name']?> " readonly>
                                                </div>
                                                <div class="form-group col-md-6 text-left">
                                                    <label for="department">Department</label>
                                                    <input type="text" name="department" class="form-control" value="<?php echo $fetch_info['department']?> " readonly>
                                                </div>
                                            </div>
                                       
                                     
                                     <div class="form-row">
                                                
                                                <div class="form-group col-md-6 text-left">
                                                <label for="title">Enter the Title</label>
                                                <input type="text" name="title" class="form-control" id="title" required placeholder="Programme Title">
                                                </div>
                                                <div class="form-group col-md-6 text-left">
                                                    <label for="type">Select Programme Type</label>
                                                    <select class="form-control" name="program_type" id="type" >
                                                        <option selected>Choose a Programme</option>
                                                        <option>Seminar</option>
                                                        <option>Workshop</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="form-group col-md-6 text-left">
                                                <label for="st_date">Start Date</label>
                                                <input type="date" name="start_date" class="form-control" id="start_date">
                                                </div>
                                                <div class="form-group col-md-6 text-left">
                                                    <label for="en_date">End Date</label>
                                                    <input type="date" name="end_date" class="form-control" id="end_date">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6 text-left">
                                                <label for="days">No. of Days</label>
                                                <input type="text" name="days" class="form-control" id="days"  readonly>
                                                <div id="error" class="text-danger"></div>
                                                </div>
                                                <div class="form-group col-md-6 text-left">
                                                    <label for="venue">Venue</label>
                                                    <input type="text" name="venue" placeholder="Enter the Venue" class="form-control" id="venue">
                                                </div>

                                                <div class="form-group col-md-6 text-left">
                                                    <label for="proof">Upload Proof</label><br>
                                                    <div class="custom-file">
                                                        <input type="file" name="proof" accept=".pdf" class="custom-file-input form-control-file" id="file-input" required>
                                                        <label class="custom-file-label" for="file-input" id="file-label">Choose file</label>
                                                    </div>
                                                    <small class="form-text text-muted">
                                                        <span id="file-size"></span>
                                                        <span style="color: red" id="file-error">* Please upload a file with a maximum size of 5 MB.</span>
                                                    </small>
                                                </div>
                                                
                                                <script type="text/javascript">
                                                function ShowHideDiv(chkP) {
                                                    var dvP = document.getElementById("dvP");
                                                    dvP.style.display = chkP.checked ? "block" : "none";
                                                }
                                                </script>
                                                <div class="form-group col-md-6 text-left">
                                                
                                                
                                                    <div class="form-check mb-2 mr-sm-2 text-left">
                                                        <input class="form-check-input" type="checkbox" id="chkP" onclick="ShowHideDiv(this)">
                                                        <label class="form-check-label" for="chkP">
                                                        Any financial support provided by institution?
                                                        </label>
                                                    </div>
                                                    <div id="dvP" style="display: none">
                                                        <input type="text" name="financial_support" id="amount" placeholder="Enter the Amount Provided" class="form-control" />
                                                    </div>
                                                    </div>
                                                    
                                                 </div>
                                                 <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" name="seminar-submit" class="btn btn-primary btn-block">Submit</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="form-group text-left col-md-12">
                                                            <div class="card p-3" style="background-color:#f1f1f1;">
                                                                <h5 class="font-weight-bold mb-3 text-center">Documents to be Uploaded as per the following details</h5>
                                                                    <ul>
                                                                        <li><span style="font-size: 16px; ">Upload only Refresher course/Faculty Orientation or other programmes as per UGC/AICTE stipulated periods,<br> as participated by teachers year-wise.</span></li>
                                                                        <li><span style="font-size: 16px; ">Copy of the certificates of the program attended by teachers.</span></li>
                                                                        <li><span style="font-size: 16px; ">Copy of permission letter indicating financial assistance to teachers receiving financial support.</span></li>
                                                           
                                                                    </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 </div>
                                            
                                        </form>
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
    <script>
        // Date validation
        var startDate = document.getElementById("start_date");
        var endDate = document.getElementById("end_date");
        var daysField = document.getElementById("days");
        var errorField = document.getElementById("error");

        startDate.addEventListener("change", calculateDays);
        endDate.addEventListener("change", calculateDays);

        function calculateDays() {
        var start = new Date(startDate.value);
        var end = new Date(endDate.value);
        var diff = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;

        if (diff < 3) {
            errorField.innerHTML = "Oops! Program duration must be at least 3 days";
            daysField.value = "";
        } else {
            errorField.innerHTML = "";
            daysField.value = diff;
        }
        }


        const fileInput = document.getElementById('file-input');
    const fileLabel = document.getElementById('file-label');
    const fileSize = document.getElementById('file-size');
    const fileError = document.getElementById('file-error');
    const maxFileSize = 5 * 1024 * 1024; // 5 MB in bytes

    fileInput.addEventListener('change', validateFileSize);
    fileInput.addEventListener('blur', validateFileSize);

    // Function to validate file size
    function validateFileSize() {
        const file = this.files[0];
        if (file) {
            fileLabel.textContent = file.name;
            fileSize.textContent = `File size: ${formatFileSize(file.size)}`;

            if (file.size > maxFileSize) {
                fileError.style.display = 'block';
            } else {
                fileError.style.display = 'none';
            }
        } else {
            fileLabel.textContent = 'Choose file';
            fileSize.textContent = '';
            fileError.style.display = 'none';
        }
    }

    // Function to format file size in human-readable format
    function formatFileSize(size) {
        const units = ['B', 'KB', 'MB', 'GB', 'TB'];
        let unitIndex = 0;

        while (size >= 1024 && unitIndex < units.length - 1) {
            size /= 1024;
            unitIndex++;
        }

        return `${size.toFixed(2)} ${units[unitIndex]}`;
    }

            function showForm() {
            document.querySelector(".form-container").style.display = "block";
            }

            function hideForm() {
            document.querySelector(".form-container").style.display = "";
            }

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

    <!-- Page level custom scripts -->
    <script src="../JS/demo/chart-area-demo.js"></script>
    <script src="../JS/demo/chart-pie-demo.js"></script>

</body>

</html>