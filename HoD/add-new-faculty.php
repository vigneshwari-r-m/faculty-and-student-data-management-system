<?php require_once "controller.php"; 
include "save-faculty.php";
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

    <title><?php echo $fetch_info['name'] ?> - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../CSS/faculty.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="icon" href="../Assets/Images/favicon-32x32.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    


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
                        <h1 class="h3 mb-0 text-gray-800">Faculty Details Maintenance</h1>
                        <button type="button" class="btn btn-primary" id="addBtn">Add Faculty</button>
                    </div>
                    <?php
                        if (isset($_SESSION['message'])) {
                            echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
                            unset($_SESSION['message']);
                        } elseif (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);
                        }
                        
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="addFacultyModal" tabindex="-1" role="dialog" aria-labelledby="addFacultyModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="addFacultyModalLabel">Add New Faculty</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="addFacultyForm" method="post">
                              <div class="form-group">
                                <label for="facultyId">Faculty Id:</label>
                                <input type="text" class="form-control" id="facultyId" name="faculty_id" required>
                              </div>
                              <div class="form-group">
                                <label for="facultyName">Name:</label>
                                <input type="text" class="form-control" id="facultyName" name="name" required>
                              </div>
                              <div class="form-group">
                                <label for="facultyQualification">Qualification:</label>
                                <input type="text" class="form-control" id="facultyQualification" name="qualification">
                              </div>
                              <div class="form-group">
                                <label for="facultyDesignation">Designation:</label>
                                <input type="text" class="form-control" id="facultyDesignation" name="designation">
                              </div>
                              <div class="form-group">
                                <label for="facultyCoordinator">Coordinator:</label>
                                <input type="text" class="form-control" id="facultyCoordinator" name="coordinator">
                              </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add-faculty" id="saveFacultyBtn">Save changes</button>
                          </div>

                          </form>
                        </div>
                      </div>
                    </div>


                    <!-- Content Row -->
                    <div class="row">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Total Faculty List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-fixed" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr style="background-color:#f8f9fc; text-align:center">
            <th>S.No</th>
            <th>Faculty ID</th>
            <th>Name</th>
            <th>Qualification</th>
            <th>Designation</th>
            <th>Co-Ordinator</th>
            <th>Action</th>
            
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
        $name = $fetch_info['name'];
        $sql_query="SELECT department_id FROM hodlist WHERE hod_name='$name'";
        $run_query = mysqli_query($con,$sql_query);
        $fetch = mysqli_fetch_array($run_query);
        $department_id = $fetch['department_id'];

        $query = "SELECT faculty_id, name, qualification, designation,coordinator FROM faculty WHERE department_id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 's', $department_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0) {
            $serial_no = 1;
            while($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?= $serial_no++; ?></td>
                <td><?= htmlspecialchars($row['faculty_id']); ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['qualification']); ?></td>
                <td><?= htmlspecialchars($row['designation']); ?></td>
                <td><?= htmlspecialchars($row['coordinator']); ?></td>
                <td> <a href="#" data-toggle="modal" data-target="#updateFacultyModal<?= $row['faculty_id']; ?>"><i class="fa fa-edit"></i></a>
                    <a href="#" data-toggle="modal" data-target="#deleteFacultyModal<?= $row['faculty_id']; ?>"><i class="fa fa-trash"></i></a></td>
          
                
            </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='12' class='text-center'>No Record Found</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- Update Faculty Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Faculty</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="updateFacultyForm">
          <div class="form-group">
            <label for="updateFacultyId">Faculty ID</label>
            <input type="text" class="form-control" id="updateFacultyId" name="updateFacultyId" readonly>
          </div>
          <div class="form-group">
            <label for="updateName">Name</label>
            <input type="text" class="form-control" id="updateName" name="updateName">
          </div>
          <div class="form-group">
            <label for="updateQualification">Qualification</label>
            <input type="text" class="form-control" id="updateQualification" name="updateQualification">
          </div>
          <div class="form-group">
            <label for="updateDesignation">Designation</label>
            <input type="text" class="form-control" id="updateDesignation" name="updateDesignation">
          </div>
          <div class="form-group">
            <label for="updateCoordinator">Co-Ordinator</label>
            <input type="text" class="form-control" id="updateCoordinator" name="updateCoordinator">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Delete Faculty Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Faculty</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this faculty?</p>
        <input type="hidden" id="deleteFacultyId" name="deleteFacultyId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="deleteFacultyBtn">Delete</button>
      </div>
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
    <script>
      // Show alert when user clicks outside form
      $('#addFacultyModal').on('focusout', function(event) {
        if ($(event.relatedTarget).closest('#addFacultyModal').length === 0) {
          $('#addFacultyModal').modal('handleUpdate');
          if ($('#addFacultyModal').hasClass('show')) {
            if (!confirm('Do you want to save the changes?')) {
              // Reset form values
              $('#addFacultyForm')[0].reset();
              $('#addFacultyModal').modal('hide');
            }
          }
        }
      });


      $(document).ready(function() {
  // Add event listener to "Add Faculty" button
  $('#addBtn').on('click', function() {
    // Show modal
    $('#addFacultyModal').modal('show');
  });

  // Add event listener to "Add Faculty" form submit button
  $('#addFacultyBtn').on('click', function() {
    // Get form data
    var formData = {
      'facultyId': $('#facultyId').val(),
      'name': $('#facultyName').val(),
      'qualification': $('#facultyQualification').val(),
      'designation': $('#facultyDesignation').val(),
      'coordinator': $('#facultuCoordinator').is(':checked') ? 'Yes' : 'No'
    };

    // Send AJAX request to add faculty
    $.ajax({
      type: 'POST',
      url: 'save_faculty.php',
      data: formData,
      dataType: 'json',
      encode: true
    })
    .done(function(data) {
      // Show success message
      $('#addFacultySuccessMsg').text(data.message);
      $('#addFacultySuccessAlert').removeClass('d-none');
      $('#addFacultyModal').modal('hide');

      // Reset form values
      $('#addFacultyForm')[0].reset();
    })
    .fail(function(data) {
      // Show error message
      $('#addFacultyErrorMsg').text(data.responseJSON.message);
      $('#addFacultyErrorAlert').removeClass('d-none');
    });
  });

  // Add event listener to "Add Faculty" modal close button
  $('#addFacultyModal').on('hidden.bs.modal', function(e) {
    // Reset form values
    $('#addFacultyForm')[0].reset();

    // Hide all alerts
    $('#addFacultySuccessAlert').addClass('d-none');
    $('#addFacultyErrorAlert').addClass('d-none');
  });
});

// Handle click event of Update button
$('body').on('click', '.updateBtn', function() {
  // Get faculty ID
  var faculty_id = $(this).data('id');

  // Send AJAX request to get faculty data
  $.ajax({
    url: 'get_faculty.php',
    method: 'POST',
    data: { faculty_id: faculty_id },
    dataType: 'json',
    success: function(data) {
      // Update modal form with faculty data
      $('#updateFacultyModal #faculty_id').val(data.faculty_id);
      $('#updateFacultyModal #name').val(data.name);
      $('#updateFacultyModal #qualification').val(data.qualification);
      $('#updateFacultyModal #designation').val(data.designation);
      $('#updateFacultyModal #coordinator').val(data.coordinator);

      // Show modal popup form
      $('#updateFacultyModal').modal('show');
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert('Error occurred while getting faculty data.');
    }
  });
});

// Handle click event of Delete button
$('body').on('click', '.deleteBtn', function() {
  // Get faculty ID
  var faculty_id = $(this).data('id');

  // Show confirmation message before deleting faculty
  if(confirm('Are you sure you want to delete this faculty?')) {
    // Send AJAX request to delete faculty
    $.ajax({
      url: 'delete_faculty.php',
      method: 'POST',
      data: { faculty_id: faculty_id },
      success: function(response) {
        // Reload the page to display updated data
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        alert('Error occurred while deleting faculty.');
      }
    });
  }
});


</script>

</body>

</html>