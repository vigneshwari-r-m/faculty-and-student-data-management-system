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

    <title><?php echo $fetch_info['name']?> | Consultancy</title>

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
             <?php include "includes/sidenav.php";?>
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
                        <h1 class="h3 mb-0 text-gray-800">Consultancy</h1>
                        <a href="consultancy-add-new.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                                <thead>
                                                <tr style="background-color:#f8f9fc; text-align:center">
                                                <th>S.No</th>
                                                <th>Name of the consultancy project</th>
                                                    <th>Name of the Consulting /Sponsoring agency</th>
                                                    <th>Agency seeking training</th>
                                                    <th>Number of trainees</th>
                                                    <th>Start date</th>
                                                    <th>End date</th>
                                                    <th>Days</th>
                                                    <th>Revenue Generated in Lakhs</th>
                                                  
                                                    <th>Proof</th>
                                                    <th> HOD Approval</th>
                                                    <th>HOD Remarks</th>
                                                    <th>IQAC Approval</th>
                                                    <th>IQAC Remarks</th>
                                                    <th></th>
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
                                    
                                    $email = $fetch_info['email'];
                                    $query = "SELECT userid,name FROM user WHERE email=?";
                                    $stmt = mysqli_prepare($con, $query);
                                    mysqli_stmt_bind_param($stmt, 's', $email);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if (!$result) {
                                        die("Error in fetching user details: " . mysqli_error($con));
                                    }

                                    $row = mysqli_fetch_assoc($result);
                                    $userid = $row['userid'];
                                    $name = $row['name'];

                                    $query = "SELECT id,consultancy_pro,consultancy_name,agency_name,trainees,start_date,end_date,days,revenue,proof,hod_approval,hod_remarks,admin_approval,admin_remarks
                                    FROM consultancy
                                    WHERE userid=? and name=?
                                    ORDER BY id DESC";

                                    $stmt = mysqli_prepare($con, $query);
                                    mysqli_stmt_bind_param($stmt, 'is', $userid, $name);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if (!$result) {
                                        die("Error in fetching FDP details: " . mysqli_error($con));
                                    }

                                    $serial_no = 1;
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?= $serial_no++; ?></td>
                                       
                                        
                                        <td><?= htmlspecialchars($row['consultancy_pro']); ?></td>
                                        <td><?= htmlspecialchars($row['consultancy_name']); ?></td>
                                        <td><?= htmlspecialchars($row['agency_name']); ?></td>
                                        <td><?= htmlspecialchars($row['trainees']); ?></td>
                                        
                                        <td><?= htmlspecialchars($row['start_date']); ?></td>
                                        <td><?= htmlspecialchars($row['end_date']); ?></td>
                                        <td><?= htmlspecialchars($row['days']); ?></td>
                                        <td><?= htmlspecialchars($row['revenue']); ?></td>
                                        
                                     
                                        <td><?= htmlspecialchars($row['proof']); ?></td>
                                        <td><?= htmlspecialchars($row['hod_approval']); ?></td>
                                        <td><?= htmlspecialchars($row['hod_remarks']); ?></td>
                                        <td><?= htmlspecialchars($row['admin_approval']); ?></td>
                                        <td><?= htmlspecialchars($row['admin_remarks']); ?></td>
                                        

                                        
                                        <td class="ellipsis">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-primary ml-2" href="#" data-toggle="modal" data-target="#editModal<?= $row['id'] ?>">Edit</a>
                                            </div>
                                        </td>

                                        <!-- Edit FDP Modal -->
                                        <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Record <?= $row['id'] ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="" enctype="multipart/form-data">
                                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="edit_title">Title of the Programme</label>
                                                                        <input type="text" name="title" class="form-control" id="edit_title" value="<?= htmlspecialchars($row['title']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_days">Total Days</label>
                                                                        <input type="number" name="days" class="form-control" id="edit_days" value="<?= $row['days']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_program_type">Programme Type</label>
                                                                        <select name="program_type" class="form-control" id="edit_program_type">
                                                                            <option value="fdp" <?= ($row['program_type'] == 'fdp') ? 'selected' : '' ?>>FDP</option>
                                                                            <option value="pdp" <?= ($row['program_type'] == 'pdp') ? 'selected' : '' ?>>PDP</option>
                                                                            <option value="sttp" <?= ($row['program_type'] == 'sttp') ? 'selected' : '' ?>>STTP</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_start_date">Start date</label>
                                                                        <input type="date" name="start_date" class="form-control" id="edit_start_date" value="<?= htmlspecialchars($row['start_date']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_end_date">End date</label>
                                                                        <input type="date" name="end_date" class="form-control" id="edit_end_date" value="<?= htmlspecialchars($row['end_date']); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="edit_venue">Venue</label>
                                                                        <input type="text" name="venue" class="form-control" id="edit_venue" value="<?= htmlspecialchars($row['venue']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_financial_support">Financial support</label>
                                                                        <input type="text" name="financial_support" class="form-control" id="edit_financial_support" value="<?= htmlspecialchars($row['financial_support']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_proof">Proof</label>
                                                                        <?php if ($row['proof']) { ?>
                                                                        <div class="mb-2">
                                                                            <a href="uploads/<?= $row['proof'] ?>" target="_blank"><?= $row['proof'] ?></a>
                                                                            <button type="button" class="btn btn-sm btn-danger ml-2" onclick="
                                                                            if (confirm('Are you sure you want to delete this proof?')) {
                                                                                $.ajax({
                                                                                url: 'delete_proof.php',
                                                                                type: 'POST',
                                                                                data: { id: <?= $row['id'] ?> },
                                                                                success: function(response) {
                                                                                    location.reload();
                                                                                }
                                                                                });
                                                                            }
                                                                            ">Delete Proof</button>
                                                                        </div>
                                                                        <?php } ?>
                                                                        <input type="file" name="proof" class="form-control-file" id="edit_proof" accept="application/pdf">
                                                                        <?php if ($errors && $error['proof']) { ?>
                                                                            <small class="text-danger"><?= $error['proof'] ?></small>
                                                                        <?php } ?>
                                                                        </div>

                                                                    
                                                                    </form>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No Record Found</td></tr>";
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