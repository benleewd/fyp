<!DOCTYPE html>
<html lang="en" >
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Schedule Administration</title>
</head>

<body>
    <?php include 'navStart.php'; ?>

    <div class="container">

        <h2>Schedule Administration</h2>

        <?php

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
            $month = intval(date('m'));
            $year = intval(date('yy'));
        }

        $currentMonth = intval(date('m'));
        $currentYear = intval(date('yy'));

        ?>

        <hr>
        <span>Month: </span>
        <input type="number" min="1" max="12" step="1" id='generateMonth' value=<?php echo $currentMonth; ?>>
        <span>Year: </span>
        <input type="number" min="2019" max="2050" step="1" id='generateYear'value=<?php echo $currentYear; ?>>
        <button class="btn btn-sm btn-dark" id="generateSchedule">Generate Schedule</button>
        <hr>

        <form action="scheduleAdministration.php" method="get">
            <span>Month: </span>
            <input type="number" min="1" max="12" step="1" id='month' name='month' value=<?php echo $month; ?>>
            <span>Year: </span>
            <input type="number" min="2019" max="2050" step="1" id='year' name='year' value=<?php echo $year; ?>>
            <button type="submit" class="btn btn-sm btn-dark">Show</button>
        </form>
        <br>
        <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#add"> Add Site </button>
        <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#remove"> Remove Site </button>
        <br>
        <br>


        <table id="myTable" class="table table-striped table-bordered w-100">
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
                                echo "<select class='selectEmp'>";
                                foreach ($employeeList as $employee) {
                                    $id = $employee[0];
                                    $display = $employee[1] . " " . $employee[2] . " (" . $employee[3] . ")";
                                    if ($id == $empID) {
                                        echo "<option value='$id|$year|$month|$day|$site|$shift' selected>$display</option>";
                                    } else {
                                        echo "<option value='$id|$year|$month|$day|$site|$shift' >$display</option>";
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
        </table>

        <!-- Add Modal -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Site</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        $sql = "SELECT Project_ID, Project_Name from Site where Project_ID not in (select distinct(Site_ID) from schedule where year=$year and month=$month)";
                
                        $stmt = $conn->prepare($sql);
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt->execute();
                
                        $empty = true;
                        $options = "";
                
                        while($row = $stmt->fetch()) {
                            $projectID = $row['Project_ID'];
                            $projectName = $row['Project_Name'];
                            $options .= "<option value='$projectID'>$projectName</option>";
                            $empty = false;
                        }

                        if ($empty) {
                            echo "All sites are present already.";
                        } else {
                            echo "<select id='toAdd' class='d-block mx-auto'>";
                            echo $options;
                            echo "</select>";
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <?php 
                        if (!$empty) {
                            echo "<button type='button' class='btn btn-success' id='addButton'>Add</button>";
                        }
                    ?>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Remove Modal -->
        <div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeModalLabel">Remove Site</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        $sql = "SELECT distinct(Site_ID), Project_Name from schedule inner join Site on schedule.Site_ID = Site.Project_ID where year=$year and month=$month";
                
                        $stmt = $conn->prepare($sql);
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt->execute();
                
                        $empty = true;
                        $options = "";
                
                        while($row = $stmt->fetch()) {
                            $projectID = $row['Site_ID'];
                            $projectName = $row['Project_Name'];
                            $options .= "<option value='$projectID'>$projectName</option>";
                            $empty = false;
                        }

                        if ($empty) {
                            echo "Schedule is not generated yet";
                        } else {
                            echo "<select id='toRemove' class='d-block mx-auto'>";
                            echo $options;
                            echo "</select>";
                        }
                    ?>
                </div>
                <div class="modal-footer">
                <?php 
                        if (!$empty) {
                            echo "<button type='button' class='btn btn-success' id='removeButton'>Remove</button>";
                        }
                    ?>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <script src="js/scheduleAdministration.js"></script>
       
    </div>
    
    <?php include 'navEnd.php'; ?>

</body>
</html>