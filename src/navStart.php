<div class="d-flex" id="wrapper">

      <!-- Sidebar -->
      <div class="black p-3" id="sidebar-wrapper">
        <div class="sidebar-heading orange text-center font-weight-bold" >K11 SECURITY</div>
        <?php if ($_SESSION['designation'] != "Security Officer") { ?>
        <div class="btn-group btn-group-sm pb-3 d-flex justify-content-center" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-outline-primary text-white active">Admin</button>
          <button type="button" class="btn btn-outline-secondary text-white">User</button>
        </div>
        <?php } ?>
        <div class="list-group list-group-flush text-left navItems" id="indent" >  
          <a href="index.php" class="list-group-item list-group-item-dark"><span class="fa fa-line-chart mr-3"></span> Dashboard</a>
          <a href="employee.php" class="list-group-item list-group-item-dark"><span class="fa fa-users mr-3"></span> Employee</a>
          <a href="site.php" class="list-group-item list-group-item-dark"><span class="fa fa-map mr-3"></span> Site</a>
          <a href="leaveAdministration.php" class="list-group-item list-group-item-dark"><span class="fa fa-calendar-o mr-3"></span> Leave</a>
          <a href="attendance.php" class="list-group-item list-group-item-dark"><span class="fa fa-check-square mr-3"></span> Attendance</a>
          <a href="scheduleAdministration.php" class="list-group-item list-group-item-dark"><span class="fa fa-table mr-3"></span> Schedule</a>
          <a href="payment.php" class="list-group-item list-group-item-dark"><span class="fa fa-table mr-3"></span> Payment</a>
          <a href="telegramAdministration.php" class="list-group-item list-group-item-dark"><span class="fa fa-table mr-3"></span> Telegram</a>
        </div>
        <div class="list-group list-group-flush text-left navItems" id="empSidebar">  
          <a href="indexEmployee.php" class="list-group-item list-group-item-dark"><span class="fa fa-line-chart mr-3"></span> Your Dashboard</a>
          <a href="attendanceEmployee.php" class="list-group-item list-group-item-dark"><span class="fa fa-check-square mr-3"></span> Your Attendance</a>
          <a href="scheduleIndividual.php" class="list-group-item list-group-item-dark"><span class="fa fa-table mr-3"></span> Your Schedule</a>
          <a href="leaveManagement.php" class="list-group-item list-group-item-dark"><span class="fa fa-calendar-o mr-3"></span> Personal Leave</a>
          <a href="leaveRequest.php" class="list-group-item list-group-item-dark"><span class="fa fa-calendar-o mr-3"></span> Leave Request</a>
          <a href="paymentEmployee.php" class="list-group-item list-group-item-dark"><span class="fa fa-table mr-3"></span> Payment</a>
        </div>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
        <div class="effect"></div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white ">
          <img src="img/menu.png" width=25rem height=auto id="menu-toggle"/>
          <div class="collapse navbar-collapse navbar-toggleable-sm navbar-toggleable-md" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">     
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="fa fa-bell fa-lg"><span id="notificationNo" class="badge badge-danger"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right overflow-auto tableShadow" aria-labelledby="navbarDropdown" id="dashboardDropdown">
                  <span class="font-weight-bold pl-3">Notifications</span>
                  <div class="dropdown-divider"></div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user-circle fa-lg"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right tableShadow" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="profile.php">Profile</a>
                  <?php if ($_SESSION['designation'] != "Security Officer") { ?>
                  <a class="dropdown-item" href="accessControl.php">Access Control</a>
                  <?php } ?>
                  <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="processes/processLogout.php">Log Out</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      