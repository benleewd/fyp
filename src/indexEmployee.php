<!DOCTYPE HTML>
<html lang="en">
<?php
include "common/common.php";
include 'header.php';

$empID = $_SESSION['eid'];
$assignedSiteArr = [];
$time = date('H:i', strtotime('+8 hours'));

if (count($assignedSiteArr) > 0) {
    if ($time > "19:30") {
        if (isset($assignedSiteArr['night'])) {
            $siteID = $assignedSiteArr['night'];
            $shift = 'night';
        } else {
            $siteID = 0;
            $shift = '';
        }
    } else {
        $siteID = $assignedSiteArr['day'];
        $shift = array_keys($assignedSiteArr)[0];
    }
} else if (count($assignedSiteArr) == 1) {
    $siteID = $assignedSiteArr[0];
    $shift = array_keys($assignedSiteArr)[0];
} else {
    $siteID = 0;
    $shift = '';
}

$connMgr = new connectionManager();
$conn = $connMgr->getConnection();

$tomorrow = date('Y-m-d', strtotime('tomorrow'));

$dateArr = explode("-", $tomorrow);
$year = $dateArr[0];
$month = $dateArr[1];
$day = $dateArr[2];

$sql = "SELECT Project_Name, Shift, schedule.Site_ID from schedule inner join site on schedule.Site_ID = site.Project_ID where Year=$year and Month=$month and Day=$day and Employee_ID=$empID";

$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$projectNameArr = array();
$shiftArr = array();

while ($row = $stmt->fetch()) {
    array_push($projectNameArr, $row['Project_Name']);
    array_push($shiftArr, $row['Shift']);
    $assignedSiteArr[$row['Shift']] = $row['Site_ID'];
}


?>
<title>Dashboard</title>
<script src="static/js/qr_packed.js"></script>
<script src="js/qrReader.js"></script>
<input type="hidden" id="siteID" name="siteID" value=<?= $siteID ?>>
<input type="hidden" id="shift" name="shift" value=<?= $shift ?>>
<input type="hidden" id="empID" name="empID" value=<?= $empID ?>>

<body class="preload">
    <?php include 'navStart.php'; ?>
    <div class="container">
        <div class="row mb-2">
            <h5 class="font-weight-bold">EMPLOYEE DASHBOARD</h5>
        </div>
        <div class="row mb-3 empDashboard">
            <div class="col black tableShadow p-3">
                <p class="font-weight-bold empDashboardFont ">ATTENDANCE FOR THE DAY</p>
                <p class="font-weight-bold text-center mt-n1 mb-2  empFont">Morning Shift: Jurong</p>
                <div class="alert alert-dismissible tableShadow" id="videoPopup">
                    <video id="video" width="200" height="200" autoplay playsinline></video>
                    <button id="snap" class="btn btn-sm btn-secondary mt-n5">Scan QRCode</button>
                    <button id="close" class="close"><i class="fa fa-window-close" aria-hidden="true"></i></button>
                </div>
                <canvas id="canvas" width="200" height="200" style="display:none"></canvas>
                <div class="d-flex justify-content-center">
                    <button id="timeIn" class="btn btn-secondary mr-1">Clock In</button>
                    <button id="timeOut" class="btn btn-secondary">Clock Out</button>
                </div>
            </div>
            <div class="col tableShadow p-2">
                <?php
                $tomorrow = date('Y-m-d', strtotime('tomorrow'));
                ?>
                <table class="table ">
                    <thead class="thead-dark">
                        <tr>
                            <th colspan=2 class="text-center">Schedule for <?= $tomorrow ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            if (count($projectNameArr) == 0) {
                                echo "<td colspan=2 class='text-center'>No work assigned</td>";
                            }
                            foreach ($shiftArr as $shift) {
                                $shift = strtoupper($shift);
                                echo "<th>$shift</th>";
                            }

                            ?>
                        </tr>
                        <tr class="text-wrap">
                            <?php
                            foreach ($projectNameArr as $projectName) {
                                $projectName = strtoupper($projectName);
                                echo "<td>$projectName</td>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row empDashboard">

            <div class="col black tableShadow p-3">
                <?php
                $sql = "SELECT * FROM payroll_records where Employee_ID=$empID";

                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();

                $result = array();
                $fromDate = "";
                $toDate = "";
                $status = "";
                $month = "";

                while ($row = $stmt->fetch()) {
                    $result[] = [$row['Month'], $row['From_Date'], $row['To_Date'], $row['Status']];
                }

                $lastRow = end($result);

                if ($lastRow[1] != "1970-01-01") {
                    $fromDate = $lastRow[1];
                    $toDate = $lastRow[2];
                } else {
                    $month = strtoupper(date("F", mktime(0, 0, 0, $lastRow[0], 10)));
                }

                $status = $lastRow[3];
                ?>
                <p class="font-weight-bold empDashboardFont">
                    <?php
                    if ($month != "") {
                        echo "PAYMENT STATUS FOR " . $month;
                    } else if ($fromDate != "") {
                        echo "PAYMENT STATUS FOR " . $fromDate . "to" . $toDate;
                    } else {
                        echo "NO PENDING PAYMENT STATUS";
                    }
                    ?>
                </p>
                <p class="font-weight-bold greyFont text-center my-auto"><?= $status ?></p>
            </div>
            <div class="col p-2 tableShadow">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th colspan=2 class="text-left">
                                Leave Updates
                                <button class="btn btn-sm btn-light float-right"><i class="fa fa-calendar fa-lg" aria-hidden="true"></i></button>
                            </th>
                        </tr>
                    </thead>
                    <tr>
                        <th>Next Leave Date</th>
                        <th>Pending Leave Request</th>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            $sql = "SELECT * from Leave_Application where Employee_ID=$empID and To_Date>=now()";

                            $stmt = $conn->prepare($sql);
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $stmt->execute();

                            $result = [];

                            while ($row = $stmt->fetch()) {
                                $result[] = $row['From_Date'];
                            }

                            if (count($result) > 0) {
                                echo end($result);
                            } else {
                                echo "N.A.";
                            }
                            ?>
                        </td>
                        <td>
                            <?php


                            $sql = "SELECT * from Emp_Employment_Details left outer join Leave_Application on Emp_Employment_Details.Employee_ID = Leave_Application.Employee_ID where Emp_Employment_Details.Employee_ID = $empID and Leave_Application.Status = 'Pending'";

                            $stmt = $conn->prepare($sql);
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $stmt->execute();

                            $pendingLeaveApproval = 0;

                            while ($row = $stmt->fetch()) {
                                $pendingLeaveApproval++;
                            }
                            echo $pendingLeaveApproval;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
            $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            $current_month = date('n');
            $current_year = date('Y');
            $current_day = date('d');
            $month = 0;
            ?>
            <div id="calendar" class="tableShadow">
                <table class="calendar">
                    <th colspan="1" class="year"><?= $current_year ?></th>
                    <?php
                    echo '<tr>';
                    echo '<td class="month">';
                    echo '<table >';
                    echo '<th colspan="7">' . $months[$current_month - 1] . '</th>';
                    echo '<tr class="days"><td>Mo</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td>';
                    echo '<td class="sat">Sa</td><td class="sun">Su</td></tr>';
                    echo '<tr>';
                    $first_day_in_month = date('w', mktime(0, 0, 0, $current_month, 1, $current_year));
                    $month_days = date('t', mktime(0, 0, 0, $current_month, 1, $current_year));
                    for ($i = 1; $i < $first_day_in_month; $i++) {
                        echo '<td> </td>';
                    }
                    for ($day = 1; $day <= $month_days; $day++) {
                        $pos = ($day + $first_day_in_month - 1) % 7;
                        $class = (($day == $current_day)) ? 'today' : 'day';
                        $class .= ($pos == 6) ? ' sat' : '';
                        $class .= ($pos == 0) ? ' sun' : '';

                        echo '<td class="' . $class . '">' . $day . '</td>';
                        if ($pos == 0) echo '</tr><tr>';
                    }
                    echo '</tr>';
                    echo '</table>';

                    echo '</td>';
                    echo '</tr>';
                    ?>
                </table>
            </div>
        </div>

        <?php printErrors(); ?>
    </div>
    <?php include 'navEnd.php'; ?>
    <script src="js/indexEmployee.js"></script>
</body>

</html>