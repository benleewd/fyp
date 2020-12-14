<?php

    include "../../common/commonAPI.php";

    function retrieveScheduleByMonth($month, $year) {
        $sql = "SELECT * from Schedule where Month=:month and Year=:year";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();
        $dayInNextMonth = cal_days_in_month(CAL_GREGORIAN, $month + 1, $year);
        $dayInCurrentMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        while ($row = $stmt->fetch()) {
            if ($row['Day'] <= $dayInNextMonth) {
                if ($dayInNextMonth - $dayInCurrentMonth > 0 && $row['Day'] == $dayInCurrentMonth) {
                    for ($i = 1; $i <= ($dayInNextMonth - $dayInCurrentMonth); $i++) {
                        $result[] = new schedule($row['Year'], $row['Month'], $row['Day'] + $i, $row['Site_ID'], $row['Shift'], 1, $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
                    }
                }
                $result[] = new schedule($row['Year'], $row['Month'], $row['Day'], $row['Site_ID'], $row['Shift'], $row['Employee_ID'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
            }
        }

        return $result;
    }

    function retrieveAllLeaveByMonth($month, $year) {
        $sql = "SELECT * from Leave_Application where ((Year(From_Date)=:year and Month(From_Date)=:month) or (Year(To_Date)=:year and Month(To_Date)=:month)) and Status = 'Approved'";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();

        $noOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($i = 1; $i <= $noOfDaysInMonth; $i++) {
            $result[$i] = array();
        }

        while ($row = $stmt->fetch()) {
            $fromDay = intval(explode("-", $row['From_Date'])[2]);
            $fromMonth = intval(explode("-", $row['From_Date'])[1]);
            $toDay = intval(explode("-", $row['To_Date'])[2]);
            $toMonth = intval(explode("-", $row['To_Date'])[1]);

            if ($fromMonth == $month && $toMonth == $month) {
                for ($i = $fromDay; $i <= $toDay; $i++) {
                    $result[$i][$row['Employee_ID']] = True;
                }
            } elseif ($fromMonth == $month - 1 && $toMonth == $month) {
                for ($i = 1; $i <= $toDay; $i++) {
                    $result[$i][$row['Employee_ID']] = True;
                }
            } elseif ($fromMonth == $month && $toMonth == $month + 1) {
                for ($i = $fromDay; $i <= $noOfDaysInMonth; $i++) {
                    $result[$i][$row['Employee_ID']] = True;
                }
            }

        }

        return $result;
    }

    function retrieveScheduleRanking() {
        $sql = "SELECT * from Schedule_Ranking";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while ($row = $stmt->fetch()) {
            if (!isset($result[$row['Site_ID']])) {
                $result[$row['Site_ID']] = array();
            }

            array_push($result[$row['Site_ID']], array($row['Completed_Shift'], $row['Employee_ID']));
        }

        foreach ($result as $site => $output) {
            usort($output, function ($a,$b) {
                if ($a[0]==$b[0]) return 0;
                return ($a[0]>$b[0])?-1:1;
            });

            $result[$site] = $output;
        }

        return $result;
    }

    function formatMonthlySchedule($scheduleData) {
        $output = array();
        foreach ($scheduleData as $obj) {
            if (!isset($output[$obj->day])) {
                $output[$obj->day] = array();
            }
            if (!isset($output[$obj->day][$obj->siteID])) {
                $output[$obj->day][$obj->siteID] = array();
            }
            if (!isset($output[$obj->day][$obj->siteID][$obj->shifts])) {
                $output[$obj->day][$obj->siteID][$obj->shifts] = array();
            }
            array_push($output[$obj->day][$obj->siteID][$obj->shifts], $obj->employeeID);
        }
        return $output;
    }

    function insertIntoSchedule($year, $month, $day, $siteID, $shift, $employeeID) {
        $sql = "INSERT INTO Schedule
                (Year, Month, Day, Site_ID, Shift, Employee_ID, CREATED_BY)
                VALUES
                (:year, :month, :day, :siteID, :shift, :employeeID, 1)";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':day', $day, PDO::PARAM_INT);
        $stmt->bindParam(':siteID', $siteID, PDO::PARAM_INT);
        $stmt->bindParam(':shift', $shift, PDO::PARAM_STR);
        $stmt->bindParam(':employeeID', $employeeID, PDO::PARAM_INT);

        $success = FALSE;

        if($stmt->execute()){
            $success = TRUE;
        }

        return $success;
    }

    function optimiseMonthlySchedule($month, $year, $previousSchedule, $upcomingLeaveData, $scheduleRanking) {
        $staffCount = array();

        //Processing staff count first
        foreach ($previousSchedule as $day => $siteDetails) {
            foreach ($siteDetails as $site => $shiftDetails) {
                foreach ($shiftDetails as $shift => $employeeArr) {
                    foreach ($employeeArr as $employeeID) {
                        if (!isset($staffCount[$employeeID])) {
                            $staffCount[$employeeID] = 0;
                        }
                        $staffCount[$employeeID] += 1;
                    }
                    
                }
            }
        }
        
        //Optimising
        $maxAttempts = 20;
        $attemptNum = 1;
        $previousAttemptArray = array();
        $currentAttempt = $previousSchedule;

        while ($currentAttempt != $previousAttemptArray && $attemptNum <= $maxAttempts) {
            $previousAttemptArray = $currentAttempt;
            foreach ($currentAttempt as $day => $siteDetails) {
                // Ensure no repeated staff within a day. Staff can only work 1 shift a day at max
                $doNotRepeat = array();
                foreach ($siteDetails as $site => $shiftDetails) {
                    foreach ($shiftDetails as $shift => $employeeArr) {
                        $requiredManpowerSize = count($employeeArr);
                        $selectedStaffPool = array();
                        
                        $rank = 0;
                        while (count($selectedStaffPool) != $requiredManpowerSize) {
                            //Checking for leave and 24 shift a month criteria
                            $selectedStaff = $scheduleRanking[$site][$rank][1];
                            while (isset($upcomingLeaveData[$day][$selectedStaff]) || $staffCount[$selectedStaff] > 24 || in_array($selectedStaff, $doNotRepeat)) {
                                $rank += 1;

                                if ($rank >= count($scheduleRanking[$site])) {
                                    // $staffCount[$selectedStaff] -= 1;
                                    $selectedStaff = "1";
                                    break;
                                } else {
                                    $selectedStaff = $scheduleRanking[$site][$rank][1];
                                }
                                
                            }
                            array_push($selectedStaffPool, $selectedStaff);
                            // insertIntoSchedule($year, $month, $day, $site, $shift, $selectedStaff);
                            $rank += 1;
                        }  

                        // var_dump($employeeArr);
                        // var_dump("wait");
                        // var_dump($selectedStaffPool);
                        // var_dump($staffCount);
                        $staffCount[1] = 1;
                        foreach ($employeeArr as $eid) {
                            $staffCount[$eid] -= 1;
                        }

                        foreach ($selectedStaffPool as $eid) {
                            $staffCount[$eid] += 1;
                        }
                        
                        $currentAttempt[$day][$site][$shift] = $selectedStaffPool;
                        $doNotRepeat = array_merge($doNotRepeat, $selectedStaffPool);
                    }
                }
            }
            $attemptNum += 1;
        }

        //Add to DB
        foreach ($currentAttempt as $day => $siteDetails) {
            foreach ($siteDetails as $site => $shiftDetails) {
                foreach ($shiftDetails as $shift => $employeeArr) {
                    foreach ($employeeArr as $employeeID) {
                        insertIntoSchedule($year, $month, $day, $site, $shift, $employeeID);
                    }
                    
                }
            }
        }

        return $currentAttempt;
        
    }

    // $month = 2;
    // $year = 2020;

    // $previousSchedule = retrieveScheduleByMonth($month-1, $year);
    // $previousScheduleFormatted = formatMonthlySchedule($previousSchedule);
    // $upcomingLeaveData = retrieveAllLeaveByMonth($month, $year);
    // $scheduleRanking = retrieveScheduleRanking();
    // $output = optimiseMonthlySchedule($month, $year, $previousScheduleFormatted, $upcomingLeaveData, $scheduleRanking);

    // echo "<pre>";
    // var_dump($output);
    // echo "</pre>";


    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");

        //Connect DB and get data
        try {
            // $month = 2;
            // $year = 2020;

            $month = $_GET['month'];
            $year = $_GET['year'];

            $previousSchedule = retrieveScheduleByMonth($month-1, $year);
            $previousScheduleFormatted = formatMonthlySchedule($previousSchedule);
            $upcomingLeaveData = retrieveAllLeaveByMonth($month, $year);
            $scheduleRanking = retrieveScheduleRanking();
            $result = optimiseMonthlySchedule($month, $year, $previousScheduleFormatted, $upcomingLeaveData, $scheduleRanking);

            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "Schedule generated successfully.", $result);
            echo json_encode($json);
        } catch (Exception $e) {
            //Set response code
            http_response_code(500);
    
            //Standard json to return
            $json = new json(500, "Something went wrong. Perform admin check");
            echo json_encode($json);
        }
        
        
    } else {
        header("Access-Control-Allow-Methods: GET");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }

    
?>