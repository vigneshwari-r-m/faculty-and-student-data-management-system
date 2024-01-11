<?php require_once "controller.php"; ?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $_SESSION['email'];
$password = $_SESSION['password'];

if($email != false && $password != false){
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        $userid = $fetch_info['userid'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: index.php');
}



?>
<!DOCTYPE html>
<html lang="en">

<h>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $fetch_info['name']?> | Online Courses</title>

    <link href="../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-0D8QPwWJy0adpG6NYXU6fIu4ehE35ie2AYuBoOdInJ/k7Sug0S4wo7VUyyi6I4lnVU8fGTnE7fo/ciLP6APpw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="icon" href="../Assets/Images/favicon-16x16.png">
    <link href="../CSS/faculty.min.css" rel="stylesheet">

    <link href="../Assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../CSS/main.css" rel="stylesheet">
    <link href="../CSS/table.css" rel="stylesheet">
 



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
                <?php include'includes/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Online Courses - Form</h1>
                        <a href="online-course-add-new.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-add fa-sm text-white-500"></i> Add New</a>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Overall Summary</h6>

                                </div>
                            <main>
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
                                <div class="items-controller" style="padding-left:20px;  ">
                                 <h6>Show</h6>
                                  <select name="" id="itemperpage">
                                     <option value="15" selected>15</option>
                                     <option value="25" >25 </option>
                                     <option value="50">50</option>
                                     <option value="75">75</option>
                                     <option value="100">100</option>
                                     </select>
                                       <h6>Per Page</h6>
                             </div>
                             <form class="style="padding-left:1000px;">
                                <div class="input-group">
                              <input type="text" class="form-control bg-light border-0 small"  placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                               <button class="btn btn-primary" type="button">
                                  <i class="fas fa-search fa-sm"></i>
                                   </button>
                                      </div>
                               </div>
                                 </form>
</main>

                                <div class="card-body">
                                <div class="table-responsive">
                                <section class="field">
                                <table class="table table-bordered table-fixed" id="dataTable" width="100%" cellspacing="0">

                                <thead >
                             
   
                             <tr style="background-color:#f8f9fc; text-transform:uppercase; text-align:center; font-size:15px;">
                                 <th>S.No</th>
                                 <th>Course Name</th>
                                 <th>Academic Year</th>
                                 <th>Month/Year Course Started</th>
                                 <th>Duration (In Weeks)</th>
                                 <th>Platform </th>
                                 <th>Recognisation</th>
                                 <th>Approved as FDP</th>
                                 <th>Financial support</th>
                                 <th>Proof</th>
                                 <th>HOD Approval</th>
                                 <th>HOD Remarks</th>
                                 <th>IQAC Approval</th>
                                 <th>IQAC Remarks</th>
                             </tr>
                         </thead>
                         <tbody>
                         <?php 
                  function test_input($data) {
                      $data = trim($data);
                      $data = stripslashes($data);
                      $data = htmlspecialchars($data);
                      return $data;
                  }
                  
                  $query = "SELECT id, course_name, year, course_date, duration , platform, recognition, fdp_approved, financial_support, proof, hod_approval, hod_remarks, admin_approval, admin_remarks FROM online_course WHERE userid=?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'i', $userid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                  

                  $serial_no=1;
                  if(mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                      <td><?= $serial_no++; ?></td>
                      <td><?= htmlspecialchars($row['course_name']); ?></td>
                      <td><?= $row['year']; ?></td>
                      <td><?= htmlspecialchars($row['course_date']); ?></td>
                      <td><?= htmlspecialchars($row['duration']); ?></td>
                      <td><?= htmlspecialchars($row['platform']); ?></td>
                      <td><?= htmlspecialchars($row['recognition']); ?></td>
                      <td><?= htmlspecialchars($row['fdp_approved']); ?></td>
                      <td><?= htmlspecialchars($row['financial_support']); ?></td>
                      <td><?= htmlspecialchars($row['proof']); ?></td>
                      <td><?= htmlspecialchars($row['hod_approval']); ?></td>
                      <td><?= htmlspecialchars($row['hod_remarks']); ?></td>
                      <td><?= htmlspecialchars($row['admin_approval']); ?></td>
                      <td><?= htmlspecialchars($row['admin_remarks']); ?></td>
                      
                      
                  </tr>
                  <?php
                      }
                  } else {
                      echo "<tr><td colspan='14' class='text-center'>No Record Found</td></tr>";
                  }
              
                  ?> 
                          
                 
                  </tbody>
              </table>
                                </section>
                                <div class="bottom-field">
                <ul class="pagination">
                  <li class="prev"><a href="#" id="prev">&#139;</a></li>
                    <!-- page number here -->
                  <li class="next"><a href="#" id="next">&#155;</a></li>
                </ul>
            </div>
            </div>
                            </div>    
                                </div>
                                
                                
                           

                        
                    </div>

                </div>

                
               
          
           
        </section>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'includes/footer.php'; ?>
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
    // Get the file input element
    var inputFile = document.getElementById("edit_proof_file");

    // Add an event listener to the file input element
    inputFile.addEventListener("change", function() {
        // Get the selected file name
        var fileName = this.files[0].name;

        // Update the input box value with the selected file name
        var inputBox = document.getElementById("edit_proof");
        inputBox.value = fileName;
    });

    function removeFile() {
    document.getElementById('edit_proof').value = '';
    document.querySelector('.form-group .mb-2').classList.add('d-none');
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
    <script src="../JS/page.js"></script>
    <script src="https://kit.fontawesome.com/85d9b987b8.js" crossorigin="anonymous"></script>

</body>

</html>