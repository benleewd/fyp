<!DOCTYPE html>
<html lang="en" >
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>My Schedule</title>
    <link rel="stylesheet" href="css/scheduleIndividual.css">
</head>

<body>
    <?php include 'navStart.php'; ?>

    <div class="container">

        <h2>My Schedule</h2>

        <?php

        function formatMonthlySchedule($scheduleData) {
            $output = array();
            foreach ($scheduleData as $obj) {
                $output[$obj->day] = array($obj->shifts, $obj->siteID);
            }
            return $output;
        }


        if (isset($_GET['month']) && isset($_GET['year'])) {
            $month = $_GET['month'];
            $year = $_GET['year'];
        } else {
            $month = intval(date('m'));
            $year = intval(date('yy'));
        }


        ?>

        <form action="scheduleIndividual.php" method="get">
            <span>Month: </span>
            <input type="number" min="1" max="12" step="1" id='month' name='month' value=<?php echo $month; ?>>
            <span>Year: </span>
            <input type="number" min="2019" max="2050" step="1" id='year' name='year' value=<?php echo $year; ?>>
            <button type="submit" class="btn- btn-sm btn-dark">Show</button>
        </form>
        <br>

        <table id="empScheduleTable" class="table table-striped table-bordered">
            <?php
                // Extracting necessary data and formatting into desired form
                $sql = "SELECT Year, Month, Day, Site_ID, Shift, schedule.Employee_ID, First_Name, Last_Name, Project_Name from schedule 
                inner join (select Employee_ID, First_Name, Last_Name from emp_basic_information) as emp on schedule.Employee_ID = emp.Employee_ID 
                inner join (select Project_ID, Project_Name from site) as site_temp on site_temp.Project_ID = schedule.Site_ID 
                where schedule.Month=:month and schedule.Year=:year and schedule.Employee_ID=:eid";

                $connMgr = new connectionManager();
                $conn = $connMgr->getConnection();

                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(':month', $month, PDO::PARAM_INT);
                $stmt->bindParam(':year', $year, PDO::PARAM_INT);
                $stmt->bindParam(':eid', $_SESSION['eid'], PDO::PARAM_INT);
                $stmt->execute();

                $result = array();
                $siteArr = array();

                while ($row = $stmt->fetch()) {
                    $result[] = new schedule($row['Year'], $row['Month'], $row['Day'], $row['Site_ID'], $row['Shift'], $row['Employee_ID']);
                    if (!isset($siteArr[$row['Site_ID']])) {
                        $siteArr[$row['Site_ID']] = $row['Project_Name'];
                    }
                }

                $sql = "SELECT * from Leave_Application where ((Year(From_Date)=:year and Month(From_Date)=:month) or (Year(To_Date)=:year and Month(To_Date)=:month)) and Status = 'Approved' and Employee_ID=:eid";
                
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(':month', $month, PDO::PARAM_INT);
                $stmt->bindParam(':year', $year, PDO::PARAM_INT);
                $stmt->bindParam(':eid', $_SESSION['eid'], PDO::PARAM_INT);
                $stmt->execute();

                $noOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $leaveArr = array();
                while ($row = $stmt->fetch()) {
                    $fromDay = intval(explode("-", $row['From_Date'])[2]);
                    $fromMonth = intval(explode("-", $row['From_Date'])[1]);
                    $toDay = intval(explode("-", $row['To_Date'])[2]);
                    $toMonth = intval(explode("-", $row['To_Date'])[1]);

                    if ($fromMonth == $month && $toMonth == $month) {
                        for ($i = $fromDay; $i <= $toDay; $i++) {
                            $leaveArr[$i] = True;
                        }
                    } elseif ($fromMonth == $month - 1 && $toMonth == $month) {
                        for ($i = 1; $i <= $toDay; $i++) {
                            $leaveArr[$i] = True;
                        }
                    } elseif ($fromMonth == $month && $toMonth == $month + 1) {
                        for ($i = $fromDay; $i <= $noOfDaysInMonth; $i++) {
                            $leaveArr[$i] = True;
                        }
                    }
                }

                $formattedSchedule = formatMonthlySchedule($result);

                // Setting headers of the table
                echo "<thead class='thead-dark'>";
                echo "<th>Sunday</th>";
                echo "<th>Monday</th>";
                echo "<th>Tuesday</th>";
                echo "<th>Wednesday</th>";
                echo "<th>Thursday</th>";
                echo "<th>Friday</th>";
                echo "<th>Saturday</th>";
                echo "</thead>";

                // Setting body of the table
                $startDayOfMonth = date('w', strtotime($year . "-" . $month . "-1"));
                $noOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                echo "<tbody>";
                $newRow = 0;
                
                echo "<tr>";
                for ($i=1; $i<=$startDayOfMonth; $i++) {
                    echo "<td></td>";
                }
                $newRow += $startDayOfMonth;

                for ($day=1; $day<=$noOfDaysInMonth; $day++ ) {
                    if ($newRow == 7) {
                        echo "</tr>";
                        $newRow = 0;
                        echo "<tr>";
                    } 
                    if (isset($formattedSchedule[$day]) and !isset($leaveArr[$day])) {
                        $data = $formattedSchedule[$day];
                        $shift = $data[0];
                        $siteID = $data[1];
                        $site = $siteArr[$siteID];
                        echo "<td>$day<br><br>$site<br>($shift)</td>";
                    } elseif (isset($formattedSchedule[$day]) and isset($leaveArr[$day])) {
                        $data = $formattedSchedule[$day];
                        $shift = $data[0];
                        $siteID = $data[1];
                        $site = $siteArr[$siteID];
                        echo "<td>$day<br><br><b>On leave but assigned shift</b><br><br>$site<br>($shift)</td>";
                    } elseif (!isset($formattedSchedule[$day]) and isset($leaveArr[$day])) {
                        echo "<td>$day<br><br>On leave</td>";
                    } else {
                        echo "<td>$day</td>";
                    }
                
                    $newRow += 1;
                }

                $remainder = 7-($startDayOfMonth+$noOfDaysInMonth)%7;
                if ($remainder == 7) {
                    $remainder = 0;
                }
                for ($i=1; $i<=$remainder;$i++) {
                    echo "<td></td>";
                }

                echo "</tbody>";
            ?>
        </table>

        <script src="js/scheduleIndividual.js"></script>
    </div>
    
    <?php include 'navEnd.php'; ?>

    

</body>

</html>