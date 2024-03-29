
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" id="sidebar" style="background-color: #6665ee;">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="faculty-dashboard.php">
    <div class="sidebar-brand-icon">
      <img src="../Assets/Images/curricula.png" alt="Curricula." class="img-responsive img-centered img">
    </div>
    
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="faculty-dashboard.php"><i class="fi fi-rr-apps-add"></i><span>Ph.D Dashboard</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">Things To Do</div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fi fi-rr-graduation-cap"></i>
                    <span>Ph.D Activity</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Categories</h6>
                        <a class="collapse-item" href="phd-form.php"><i class="fi fi-rr-edit" style="padding: 5px;"></i>Ph. D Registration</a>
                        <a class="collapse-item" href="supervisor-form.php"><i class="fi fi-rr-comment" style="padding: 5px;"></i>Supervisor</a>
                    </div>
                </div>
            </li>
            <!-- <?php
            
            
            $email = $_SESSION['email'];



                    // Prepare the query to fetch the faculty role for the logged in user
            $query = "SELECT faculty.coordinator FROM faculty INNER JOIN user ON faculty.faculty_id = user.userid WHERE user.email = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Check if the query returned any results
            if (mysqli_num_rows($result) > 0) {
                // If the faculty has a coordinator role, display the collapse-header with the role name
                $facultyRole = mysqli_fetch_assoc($result)['coordinator'];
                echo '
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                            aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-wrench"></i>
                            <span>Additional Activity</span>
                        </a>
                        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">'.$facultyRole.'</h6>
                                <a class="collapse-item" href="utilities-color.html">Colors</a>
                                <a class="collapse-item" href="utilities-border.html">Borders</a>
                                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                                <a class="collapse-item" href="utilities-other.html">Other</a>
                            </div>
                        </div>
                    </li>
                ';
            } else {
                // If the faculty doesn't have a coordinator role, don't display the collapse-header
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                ';
            }
            ?> -->

           
            <!-- <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Addons
            </div>

           
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->


            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <hr class="sidebar-divider d-none d-md-block">

            
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

           
            <!-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

        </ul>