<?php
require_once "controller.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if ($status == "verified") {
            if ($code != 0) {
                header('Location: reset-code.php');
                exit();
            }
        } else {
            header('Location: user-otp.php');
            exit();
        }
    }
} else {
    header('Location: login-user.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link href="../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../CSS/bootstrap.min.css"rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../CSS/faculty.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" />
    <!-- <link rel="stylesheet" href="../CSS/home-style.css">
    <link rel="stylesheet" href="../CSS/fh-style.css"> -->
    <link rel="icon" href="../Assets/Images/favicon-16x16.png">

    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <script type="text/javascript" src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500;600;700&family=Josefin+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
  *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Nunito', fantasy;
}
  body{
  height: 100%;
  width: 100%;
  text-align: center;
  background: #f2f2f2;
}
  .wrapper{
  display: grid;
  margin: 200px 90px auto;
  grid-gap: 20px;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
}
@media (max-width: 700px) {
  .wrapper{
    margin: 200px auto;
  }
}
.wrapper .box{
    width: 350px;
    margin: 0 auto;
    position: relative;
    perspective: 1000px;
    border-radius: 10px;
  }
  .wrapper .box .front-face{
    background: #fff;
    height: 200px;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-radius: 8px;
    box-shadow: 0px 5px 20px 0px rgba(0, 81, 250, 0.1);
    transition: all 0.5s ease;
  }
  .box .front-face .icon{
    height: 40px;
    margin-bottom: 5px;
  }
  .box .front-face .icon i{
    font-size: 30px;
    text-align: center;
  }
  .box .front-face span,
  .box .back-face span{
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
  }
  .box .front-face .icon i,
  .box .front-face span{
    background: linear-gradient(-135deg, #c850c0, #4158d0);
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .box .back-face{
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    height: 200px;
    width: 100%;
    padding: 30px;
    color: #fff;
    opacity: 0;
    border-radius: 8px;
    transform-style: preserve-3d;
    backface-visibility: hidden;
    background: linear-gradient(-135deg, #c850c0, #4158d0);
    transform: translateY(110px) rotateX(-90deg);
    box-shadow: 0px 5px 20px 0px rgba(0, 81, 250, 0.1);
    transition: all 0.5s ease;
  }
  .box .back-face p{
    margin-top: 10px;
    text-align: justify;
  }
  .box:hover .back-face{
    opacity: 1;
    transform: rotateX(0deg);
  }
  .box:hover .front-face{
    opacity: 0;
    transform: translateY(-110px) rotateX(90deg);
  }

  .btn{
    color: #4158d0;
    background: #fff;
    text-align: center;
  }
</style>
<body>
    
    <!-- <div class="hero">
            
    <div class="navbar"> 
    <div class="left">
      <ul>
        <a class="nav-brand" href="home.php"><h2>Curricula.</h2></a>
      </ul>
    </div>
    <div class="right">
      <ul>
        <li>
            <a href="class-coordinator.php" >

                <?php
if (isset($fetch_info['userid'])) {
    $facultyId = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $query = "SELECT coordinator FROM faculty WHERE faculty_id = ? AND name = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "is", $facultyId, $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $facultyRole = $row['coordinator'];

        switch ($facultyRole) {
            case 'Class Coordinator':
                echo $facultyRole;
                
                break;
            case 'Exam Cell Coordinator':
                $facultyRole;
                
                break;
            case 'Fdp Coordinator':
                $facultyRole;
               
                break;
            default:
                
                echo '';
                // header('Location: error_page.php');
                // exit();
        }
    } else {
        // If the faculty ID is not found in the database, handle the error or redirect to an error page
        echo 'Faculty ID Not Found';
        // header('Location: error_page.php');
        // exit();
    }

    
}


?>

            </a>
        </li>
        <li>
           
          <a href="#" class="dropdown-toggle" onclick="toggleDropdown()">
            <p><?php echo $fetch_info['name'] ?><br> <span><?php echo $fetch_info['department'] ?></span></p>
            <img src="../Assets/Images/user.png" alt="Admin" width="40">
            <i class="fas fa-angle-down"></i>
          </a>

        
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
              <i class="fi fi-rr-diploma"></i>
              Profile
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Activity Log
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
    </div>


<br /><br /><br />

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="box">
                            <div class="front-face">
                                <div class="icon">
                                <i class="fi fi-rr-diploma"></i>
                                </div>
                                <span>Research & Development</span>
                            </div>
                            <div class="back-face">
                                <span>Your Research Activities are With Me!</span>
                                <a href="research-dashboard.php">
                                    <button class="btn btn-rounded">Explore Now!</button>
                                </a>
                            </div>
                        </div>

                        <div class="box">
                            <div class="front-face">
                                <div class="icon">
                                <i class="fi fi-rr-chalkboard-user"></i>
                                </div>
                                <span>Faculty</span>
                            </div>
                            <div class="back-face">
                                <span>Your Academic Perfomance are With Me!</span>
                                <a href="faculty-dashboard.php">
                                    <button class="btn btn-rounded">Explore Now!</button>
                                </a>
                            </div>
                        </div>

                        <div class="box">
                            <div class="front-face">
                                <div class="icon">
                                <i class="fi fi-rr-graduation-cap"></i>
                                </div>
                                <span>Ph.D</span>
                            </div>
                            <div class="back-face">
                                <span>Your Ph.D Details are With Me!</span>
                                <a href="Phd/phd-dashboard.php">
                                    <button class="btn btn-rounded">Explore Now!</button>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        <script>
            function toggleDropdown() {
      var dropdown = document.querySelector('.dropdown-menu');
      dropdown.classList.toggle('show');
    }

    document.querySelector(".dropdown-toggle").addEventListener("click", toggleDropdown);
  
        </script>
            <script src="https://kit.fontawesome.com/85d9b987b8.js" crossorigin="anonymous"></script>
            <script>
	
</script>
    </div> -->

    <div id="wrapper">
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                
                <!-- Topbar -->
                
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fas fa-bars"></i>
</button>

<ul class="navbar-nav ml-auto">
<li class="nav-item dropdown no-arrow d-text-right">
        <a href="#" class="nav-link dropdown-toggle" href="../Faculty/home.php">
            <h2 style="color: #6665ee; text-align:center; text-decoration:none; font-family: 'Comfortaa', cursive; padding: 250px;">Curricula.</h2>
        </a>
    </li>
    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>
    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="class-coordinator.php">
        <?php
if (isset($fetch_info['userid'])) {
    $facultyId = $fetch_info['userid'];
    $name = $fetch_info['name'];
    $query = "SELECT coordinator FROM faculty WHERE faculty_id = ? AND name = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "is", $facultyId, $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $facultyRole = $row['coordinator'];

        switch ($facultyRole) {
            case 'Class Coordinator':
                echo $facultyRole;
                
                break;
            case 'Exam Cell Coordinator':
                $facultyRole;
                
                break;
            case 'Fdp Coordinator':
                $facultyRole;
               
                break;
            default:
                
                echo '';
                // header('Location: error_page.php');
                // exit();
        }
    } else {
        // If the faculty ID is not found in the database, handle the error or redirect to an error page
        echo 'Faculty ID Not Found';
        // header('Location: error_page.php');
        // exit();
    }

    
}


?>
        </a>
       
    </li>
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="../Faculty/home.php">
            <i class="fi fi-rr-home"></i>
        </a>
       
    </li>
    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fi fi-rr-bell"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">3+</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Alerts Center
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
    </li>

    <!-- Nav Item - Messages -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fi fi-rr-envelope"></i>
            <!-- Counter - Messages -->
            <span class="badge badge-danger badge-counter">7</span>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">
                Message Center
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/undraw_profile_1.svg"
                        alt="...">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                        problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/undraw_profile_2.svg"
                        alt="...">
                    <div class="status-indicator"></div>
                </div>
                <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how
                        would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/undraw_profile_3.svg"
                        alt="...">
                    <div class="status-indicator bg-warning"></div>
                </div>
                <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with
                        the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                        alt="...">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                        told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
        </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $fetch_info['name'] ?> </span>
            <img class="img-profile rounded-circle"
                src="../Assets/Images/user.png">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                Activity Log
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div> -->

                    <div class="wrapper">
         <div class="box">
            <div class="front-face">
               <div class="icon">
               <i class="fi fi-rr-bank"></i><br>
               </div>
               <span>Faculty</span>
            </div>
            <div class="back-face">
               <span>Your Academic Perfomances are With Me! <br> <br></span>
               <a href="faculty-dashboard.php">
                  <button class="btn btn-rounded">Explore Now!</button>
                </a>
            </div>
         </div>
         <div class="box">
            <div class="front-face">
               <div class="icon">
                  <i class="fi fi-rr-chart-histogram"></i><br>
               </div>
               <span>Research & Development</span>
            </div>
            <div class="back-face">
               <span>Your Research Activities are With Me! <br><br></span>
               <a href="research-dashboard.php">
                  <button class="btn btn-rounded">Explore Now!</button>
                </a>
            </div>
         </div>
         <div class="box">
            <div class="front-face">
               <div class="icon">
                  <i class="fi fi-rr-graduation-cap"></i>
               </div>
               <span>Ph. D</span>
            </div>
            <div class="back-face">
               <span>Your Ph.D Details are With Me!<br><br></span>
               <a href="phd-dashboard.php">
                  <button class="btn btn-rounded">Explore Now!</button>
                </a>
            </div>
         </div>
      </div>

               <div><br><br><br></div>     
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
