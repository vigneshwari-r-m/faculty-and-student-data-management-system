<?php require_once "controller.php"; 
include "controller/approve.php";
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
                <?php include "includes/header.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Seminar Forms to be approved</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Waiting for Approval</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-fixed" id="dataTable" width="100%" cellspacing="0">
    
    
        <?php 
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $department= $fetch_info['department'];
        $query = "SELECT id,userid,name,title,days,program_type,start_date,end_date,venue,financial_support,proof,hod_approval,hod_remarks 
        FROM fdp 
        WHERE hod_approval='Pending Approval' and department=?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 's', $department);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);


        if(mysqli_num_rows($result) > 0) {
            ?>
            <thead>
        <tr style="background-color:#f8f9fc; text-align:center">
        
            <th>S.No</th>
            <th>Faculty ID</th>
            <th>Name</th>
            <th>Title of the Programme</th>
            <th>Total Days</th>
            <th>Programme Type</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Venue</th>
            <th>Financial support</th>
            <th>Proof</th>
            <th>HOD Approval</th>
            <th>HOD Remarks</th>
            
        </tr>
        <?php
            $serial_no = 1;
            while($row = mysqli_fetch_assoc($result)) {
        ?>

            <tr>
                <td><?= $serial_no++; ?></td>
                <td><?= htmlspecialchars($row['userid']); ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><?= $row['days']; ?></td>
                <td><?= htmlspecialchars($row['program_type']); ?></td>
                <td><?= htmlspecialchars($row['start_date']); ?></td>
                <td><?= htmlspecialchars($row['end_date']); ?></td>
                <td><?= htmlspecialchars($row['venue']); ?></td>
                <td><?= htmlspecialchars($row['financial_support']); ?></td>
                <td><a href="<?php echo htmlspecialchars($row['proof']); ?>" target="_blank"><?php echo htmlspecialchars($row['proof']); ?></a></td>

                
                <td>
                <a href="#" data-toggle="modal" data-target="#approveModal" onclick="if(confirm('Are you sure you want to approve?')) { location.href='update_approval.php?id=<?php echo $row['id']; ?>&type=hod'; }"><i class="fa fa-check" aria-hidden="true"></i></a>
                </td>

                <td>
                    <a href="#" data-toggle="modal" data-target="#remarksModal"><i class="fa fa-edit" aria-hidden="true"></i></a>
                </td>
                    <!-- Remarks Modal -->
                    <div class="modal fade" id="remarksModal" tabindex="-1" role="dialog" aria-labelledby="remarksModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="remarksModalLabel">Enter Remarks</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="update_remarks.php?id=<?php echo $row['id']; ?>&type=hod" method="POST">
                            <div class="form-group">
                                <label for="hod_remarks">HOD Remarks:</label>
                                <input type="text" class="form-control" id="hod_remarks" name="hod_remarks">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                
  


            </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='12' class='text-center'>No Record Found</td></tr>";
        }
        
        
  
        ?>
    </tbody>
</table>

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