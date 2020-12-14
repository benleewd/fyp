<span ng-bind-html="statusCreate" class="fixed-alert fadeout"></span>
<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Schedule Administration</h2>

<?php
include "../../common/connectionManager.php";
include "../../common/schedule.php";

function formatMonthlySchedule($scheduleData) {
    $output = array();
    foreach ($scheduleData as $obj) {
        if (!isset($output[$obj->siteID])) {
            $output[$obj->siteID] = array();
        }
        if (!isset($output[$obj->siteID][$obj->shifts])) {
            $output[$obj->siteID][$obj->shifts]= array();
        }
        if (!isset($output[$obj->siteID][$obj->shifts][$obj->day])) {
            $output[$obj->siteID][$obj->shifts][$obj->day] = array();
        }
        array_push($output[$obj->siteID][$obj->shifts][$obj->day], $obj->employeeID);
    }
    return $output;
}


if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
} else {
    $month = 1;
    $year = 2020;
}

?>

<form action="scheduleAdministration.php" method="get">
    <span>Month: </span>
    <input type="number" min="1" max="12" step="1" value=<?php echo $month; ?>>
    <span>Year: </span>
    <input type="number" min="2019" max="2030" step="1" value=<?php echo $year; ?>>
    <button type="submit">Get</button>
</form>
<br>

<table id="myTable" class="table table-striped table-bordered">
    <?php
        // Extracting necessary data and formatting into desired form
        $sql = "SELECT Year, Month, Day, Site_ID, Shift, schedule.Employee_ID, First_Name, Last_Name, Project_Name from schedule 
        inner join (select Employee_ID, First_Name, Last_Name from emp_basic_information) as emp on schedule.Employee_ID = emp.Employee_ID 
        inner join (select Project_ID, Project_Name from site) as site_temp on site_temp.Project_ID = schedule.Site_ID 
        where schedule.Month=:month and schedule.Year=:year";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();
        $nameArr = array();
        $siteArr = array();
        $uniqueDays = array();
        $noOfDays = 0;

        while ($row = $stmt->fetch()) {
            $result[] = new schedule($row['Year'], $row['Month'], $row['Day'], $row['Site_ID'], $row['Shift'], $row['Employee_ID']);
            if (!isset($nameArr[$row['Employee_ID']])) {
                $nameArr[$row['Employee_ID']] = $row['First_Name'] . " " . $row['Last_Name'];
            }
            if (!isset($siteArr[$row['Site_ID']])) {
                $siteArr[$row['Site_ID']] = $row['Project_Name'];
            }
            if (!in_array($row['Day'], $uniqueDays)) {
                array_push($uniqueDays, $row['Day']);
                $noOfDays++;
            }
        }

        $formattedSchedule = formatMonthlySchedule($result);

        $sql = "SELECT Employee_ID, First_Name, Last_Name, Identification_No from emp_basic_information";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();

        $employeeList = array();

        while ($row = $stmt->fetch()) {
            array_push($employeeList, array($row['Employee_ID'], $row['First_Name'], $row['Last_Name'], $row['Identification_No']));
        }

        // Setting headers of the table
        echo "<thead class='thead-dark'>";
        echo "<th>Location/Day</th>";
        echo "<th>Shift</th>";

        for ($daysHeader = 1; $daysHeader <= $noOfDays; $daysHeader++) {
            echo "<th>$daysHeader</th>";
        }

        echo "</thead>";

        // Setting body of the table
        echo "<tbody>";
        foreach ($formattedSchedule as $site => $siteDetails) {
            foreach ($siteDetails as $shift => $shiftDetails) {
                echo "<tr>";
                $siteName = $siteArr[$site];
                echo "<td>$siteName</td>";
                echo "<td>$shift</td>";
                for ($day=1; $day<=count($shiftDetails); $day++) {
                    echo "<td>";
                    foreach ($shiftDetails[$day] as $empID) {
                        echo "<select >";
                        foreach ($employeeList as $employee) {
                            $id = $employee[0];
                            $display = $employee[1] . " " . $employee[2] . " (" . $employee[3] . ")";
                            if ($id == $empID) {
                                echo "<option value='$id' selected>$display</option>";
                            } else {
                                echo "<option value='$id'>$display</option>";
                            }
                            
                        }
                        echo "</select>";
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
        }
        echo "</tbody>";
    ?>
    <select ng-change="update">
        <option value="1">a</option>
        <option value="1" selected>b</option>
    </select>
</table>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            "scrollY": 500,
            "scrollX": true
        });
    });
</script>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>