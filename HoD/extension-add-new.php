
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

    <title><?php echo $fetch_info['name']?> | Extension & Outreach</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Extension & Outreach - Form</h1>                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->

                        <div class="col-xl-auto">

                            <!-- Illustrations -->
                            <div class="card shadow mb-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Details of Extension & Outreach 
                                        <a href="extension-form.php" onclick="hideForm()" style="margin-left:650px; align-items: flex-end;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" >
                                        <i class="fi fi-rr-cross-small text-white-500"></i></a> </h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                    <?php include('message.php'); ?>
                                     <form method="POST" action="extension-add-new.php" enctype='multipart/form-data'>
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
                                                <label for="title">Activity Name</label>
                                                <input type="text" name="activity_name" class="form-control" id="title" required placeholder="Enter the Name of the Activity">
                                                </div>
                                                <div class="form-group col-md-6 text-left">
                                                    <label for="type">Conducted By</label>
                                                    <select class="form-control" name="organizer" id="type" >
                                                        <option selected value="hidden">Choose a Organizing Type</option>
                                                        <option>Organizing Unit</option>
                                                        <option>Agency</option>
                                                        <option>Collaborating Agency</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                            <div class="form-group col-md-6 text-left">
                                                <label for="title">Name of the Scheme</label>
                                                <input type="text" name="scheme" class="form-control" id="title" required placeholder="Enter the Name of the Scheme">
                                                </div>   
                                            
                                                <div class="form-group col-md-6 text-left">
                                                    <label for="coordinator">Date of the Activity</label>
                                                    <input type="date" name="activity_date" class="form-control" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="form-group col-md-6 text-left">
                                                <label for="title">Venue</label>
                                                <input type="text" name="venue" class="form-control" id="title" required placeholder="Enter the Venue">
                                                </div>
                                                <div class="form-group col-md-6 text-left">
                                                <label for="title">Students Participation</label>
                                                <input type="text" name="student_count" class="form-control" id="title" required placeholder="Enter the No. of Students Participated">
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
                                                </div>
                                            
                                                
                                                
                                                   
                                                 <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" name="extension-submit" class="btn btn-primary btn-block">Submit</button>
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
                                                                        <li><span style="font-size: 16px; ">Outcomes of extension activities in the neighbourhood community in terms of impact and sensitizing the students to social issues and holistic development, and awards received</span></li>
                                                                        <li><span style="font-size: 16px; ">Extension and outreach programs conducted by the institution through organized forums including NSS/NCC with involvement of community</span></span></li>
                                                                        <li><span style="font-size: 16px; ">Detailed report for each extension and outreach program to be made available, with specific mention of number of students participated and the details of the collaborating agency </span></span></li>
                                                                        <li><span style="font-size: 16px; ">Photographs and any other supporting document of relevance should have proper captions and dates.</span></span></li>
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