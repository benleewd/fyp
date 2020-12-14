<!doctype html>
<html lang="en">
<?php
include "common/common.php";
include 'header.php';

$connMgr = new connectionManager();
$conn = $connMgr->getConnection();

?>
<title>Dashboard</title>
<script src="static/js/qr_packed.js"></script>
<script src="js/qrReader.js"></script>

<body class="preload">
  <?php include 'navStart.php'; ?>
  <div class="container">
    <div class="row mb-2">
      <h5 class="font-weight-bold">DASHBOARD</h5>
    </div>
    <div class="row black p-2 mb-1">
      <div class="col border border-dark border-left-0 border-bottom-0 border-top-0">
        <p class="font-weight-bold dashboardFont">LATE TODAY</p>
        <?php
        $sql = "SELECT * from Attendance where Date_Completed_Shift=CURDATE() and Clock_In>'08:00:00'";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $lateForWork = 0;

        while ($row = $stmt->fetch()) {
          $lateForWork++;
        }
        ?>
        <p class="font-weight-bold counterFont"><?= $lateForWork ?></p>
      </div>
      <div class="col border border-dark border-left-0 border-bottom-0 border-top-0">
        <p class="font-weight-bold dashboardFont">ON LEAVE</p>
        <?php
        $sql = "SELECT * from Leave_Application where From_Date=now() and To_Date<=now() and Status='Approved'";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $leaveToday = 0;

        while ($row = $stmt->fetch()) {
          $leaveToday++;
        }
        ?>
        <p class="font-weight-bold counterFont"><?= $leaveToday ?></p>
      </div>
      <div class="col">
        <p class="font-weight-bold dashboardFont">PENDING LEAVE REQUEST</p>
        <?php
        $empID = $_SESSION['eid'];

        $sql = "SELECT * from Emp_Employment_Details left outer join Leave_Application on Emp_Employment_Details.Employee_ID = Leave_Application.Employee_ID where Emp_Employment_Details.Supervisor_ID = $empID and Leave_Application.Status = 'Pending'";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $pendingLeaveApproval = 0;

        while ($row = $stmt->fetch()) {
          $pendingLeaveApproval++;
        }
        ?>
        <p class="font-weight-bold counterFont"><?= $pendingLeaveApproval ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-9 tableShadow p-2">
        <?php
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday next week'));
        ?>
        <table class="table" id="spanSelect">
          <thead>
            <tr>
              <th colspan="8" class="text-left" id="datePeriod">Schedule from <?= $sunday ?> to <?= $saturday ?>
                <span class="float-right">
                  <label>Select Site:</label>
                  <select id="siteSelected">
                    <?php
                    $sql = "SELECT Project_ID, Project_Name from Site";

                    $stmt = $conn->prepare($sql);
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $stmt->execute();

                    $result = array();

                    while ($row = $stmt->fetch()) {
                      $result[$row['Project_ID']] = $row['Project_Name'];
                    }

                    foreach ($result as $siteID => $site) {
                      echo "<option value='$siteID|$sunday|$saturday'>$site</option>";
                    }
                    ?>
                  </select>
                  <span></th>
            </tr>
          </thead>
          <tbody id="scheduleBody">
            
          </tbody>
        </table>
      </div>
      <div class="col-3 overflow-auto border attendanceOverview tableShadow">
        <p class="font-weight-bold p-3 text-center">Daily Attendance Overview</p>
        <div><canvas id="chDonut1"></canvas></div>
        <!-- Note down how many on site today, how many on leave (annual leave etc)-->
      </div>
    </div>
    <?php printErrors(); ?>
  </div>
  <?php include 'navEnd.php'; ?>
</body>
<script src="js/index.js"></script>

</html>