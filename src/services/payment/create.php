<?php
    include "../../common/commonAPI.php";

    function get_Public_Holidays($year) {
        $json = file_get_contents("https://rjchow.github.io/singapore_public_holidays/api/$year/data.json");
        $decode = json_decode($json);
        $PHDates = [];
        foreach ($decode as $ph){
            array_push($PHDates, $ph->Date);
        }
        return $PHDates;
    }

    function attendanceOfCurrentWeek($eid, $shift, $fromDate, $toDate){
        $sql = "SELECT Date_Completed_Shift from attendance where Employee_ID=$eid and Shift_Name='$shift' and Date_Completed_Shift >='$fromDate' and Date_Completed_Shift <='$toDate'";
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] = new attendance($row['Date_Completed_Shift']);
            // if (strcmp(date("F", strtotime($row['Date_Completed_Shift'])), $currentMonth) == 0) {
                
            // }
        }

        return $result;
    }

    // function attendanceOfCurrentWeekDay($eid, $fromDate, $toDate){
    //     $sql = "SELECT Date_Completed_Shift from attendance where Employee_ID=$eid and Shift_Name='day' and Date_Completed_Shift >= $fromDate and Date_Completed_Shift <=$toDate";
        
    //     $connMgr = new connectionManager();
    //     $conn = $connMgr->getConnection();

    //     $stmt = $conn->prepare($sql);
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     $stmt->execute();

    //     $result = array();

    //     while($row = $stmt->fetch())
    //     {
    //         $result[] = new attendance($row['Date_Completed_Shift']);
    //         // if (strcmp(date("F", strtotime($row['Date_Completed_Shift'])), $currentMonth) == 0) {
                
    //         // }
    //     }

    //     return $result;
    // }

    function attendanceOfCurrentMonthDay($eid, $currentMonth){
        $sql = "SELECT Date_Completed_Shift from attendance where Employee_ID=$eid and Month(Date_Completed_Shift) = $currentMonth";
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {   
            $result[] = $row['Date_Completed_Shift'];
            // var_dump($row['Date_Completed_Shift']);
            // if (strcmp(date("F", strtotime($row['Date_Completed_Shift'])), $currentMonth) == 0) {
                
            // }
        }

        return $result;
    }

    function totalHoursWorked($eid, $currentMonth){
        $sql = "SELECT Clock_In, Clock_Out from attendance where Employee_ID=$eid";
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            if (strcmp(date("n", strtotime($row['Date_Completed_Shift'])), $currentMonth) == 0) {
                $result[] =[$row['Clock_In'], $row['Clock_Out']];
            }
            
        }

        $hoursWorked = 0;

        foreach($result as $perShift) {
            $time1 = new DateTime($perShift['Clock_In']);
            $time2 = new DateTime($perShift['Clock_Out']);
            $timeDiff = $time1->diff($time2);
            $hoursWorked += $timeDiff->h;
        }

        return $hoursWorked;
    }

    function totalOTHours($eid, $shift, $fromDate, $toDate){
        $sql = "SELECT Clock_In, Clock_Out from Attendance where Employee_ID=$eid and Shift_Name='$shift' and Date_Completed_Shift >='$fromDate' and Date_Completed_Shift <='$toDate'";
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] =[$row['Clock_In'], $row['Clock_Out']];    
        }

        $gotOT = 0;
        
        foreach($result as $perShift) {
            $time1 = strtotime($perShift[0]);
            $time2 = strtotime($perShift[1]);
            $difference = abs($time2 - $time1)/3600;
            if ($difference > 9) {
                $gotOT++;
            }
        }
        return $gotOT;
    }

    function isTherePublicHolidays($arrayOfProjectIDs){
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
        
        $result = array();
        
        foreach ($arrayOfProjectIDs as $projectId) {
            $sql = "SELECT Public_Holiday from site where Project_ID=$projectId";
    
            $stmt = $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            $row = $stmt->fetch();

            if (!(in_array($row, $result))) {
                array_push($result, $row);
            }
        }
        
        return $result;
    }

    // function getPaymentFrequency($eid){
    //     $sql = "SELECT Pay_Frequency from emp_pay_details where Employee_ID=$eid";
        
    //     $connMgr = new connectionManager();
    //     $conn = $connMgr->getConnection();

    //     $stmt = $conn->prepare($sql);
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     $stmt->execute();

    //     if($row = $stmt->fetch())
    //     {
    //         $result = $row['Pay_Frequency'];
    //     }

    //     return $result;
    // }

    function getPaymentType($eid){
        $sql = "SELECT Pay_Type from emp_pay_details where Employee_ID=$eid";
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if($row = $stmt->fetch())
        {
            $result = $row['Pay_Type'];
        }

        return $result;
    }

    function getBasicPay($eid){
        $sql = "SELECT Basic_Pay from emp_pay_details where Employee_ID=$eid";
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if($row = $stmt->fetch())
        {
            $result = $row['Basic_Pay'];
        }

        return $result;
    }

    function checkIfLastWeekPaymentStatus($eid, $fromDate, $toDate){
        $sql = "SELECT Payment_Amount, Status from payroll_records where Employee_ID=$eid and From_Date=$fromDate and To_Date<$toDate";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        if($row = $stmt->fetch())
        {
            $result[] = [$row['Payment_Amount'], $row['Status']];
        }

        return $result;
    }

    function checkIfThereIsStillLeftovers($eid, $month){
        $sql = "SELECT Payment_Amount, Status from payroll_records where Employee_ID=$eid and Month(To_Date) = $month";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch())
        {
            $result[] = [$row['Payment_Amount'], $row['Status']];
        }

        return $result;
    }


    // function getShiftRate($eid){
    //     $sql = "SELECT Day_Shift_Rate, Night_Shift_Rate from emp_pay_details where Employee_ID=$eid";
        
    //     $connMgr = new connectionManager();
    //     $conn = $connMgr->getConnection();

    //     $stmt = $conn->prepare($sql);
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     $stmt->execute();

    //     $result = array();

    //     if($row = $stmt->fetch())
    //     {
    //         $result[0] = $row['Day_Shift_Rate'];
    //         $result[1] = $row['Night_Shift_Rate'];
    //     }

    //     return $result;
    // }

    // function create($eid)
    // {
        $eid = $_GET['eid'];
        $eidRecorded = $_SESSION['eid'];
        if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
            $fromDateCheck = strtotime($_GET['fromDate']);
            $toDateCheck = strtotime($_GET['toDate']);
            $fromDate = $_GET['fromDate'];
            $toDate = $_GET['toDate'];
            $month = "";
            $datediff = ($toDateCheck - $fromDateCheck)/60/60/24;
            if ($datediff > 7){
                $paymentFrequency = "BiWeekly";
            } else {
                $paymentFrequency = "Weekly";
            }
        } else {
            $fromDate = "1970-01-01";
            $toDate = "1970-01-01";
            $month = $_GET['selectedMonth'];
            $paymentFrequency = "Monthly";
        }
        // $paymentFrequency = getPaymentFrequency($eid);
        $paymentType = getPaymentType($eid);
        $currentMonth = date('F'); //current month
        $currentYear = date("Y");
        // for weekly
        $attendanceOfCurrentWeekNight = attendanceOfCurrentWeek($eid, 'night', $fromDate, $toDate);
        $totalAttendanceOfCurrentWeekNight = count($attendanceOfCurrentWeekNight); 
        $totalOTDays = totalOTHours($eid, 'night', $fromDate, $toDate);

        //for BiWeekly
        $attendanceOfCurrentWeekDay = attendanceOfCurrentWeek($eid, 'day', $fromDate, $toDate);
        $totalAttendanceOfCurrentWeekDay = count($attendanceOfCurrentWeekDay);
        $totalOTDaysBiWeekly = totalOTHours($eid, 'day', $fromDate, $toDate);
        // var_dump($totalOTDaysBiWeekly);

        
       
        //get Project IDs to check for PH
        // $projectIDs = [];
        
        // foreach ($result as $row) {
        //     if (!(in_array($row['Project_ID'], $projectIDs))) {
        //         array_push($projectIDs, $row['Project_ID']);
        //     }
        // }

        //check if the working dates consists of PH
        $allPublicHolidays = get_Public_Holidays(2020);

        
        $countWorkingPH = 0;
        

        //for monthly
        // $countWorkingPHMonthly = 0;
        // foreach ($attendanceOfCurrentMonthDay as $workingDate) {
        //     if (in_array($workingDate, $allPublicHolidays)){
        //         $countWorkingPHMonthly++;
        //     }
        // }  
        
        $basicPay = getBasicPay($eid);
        $OTPayPerShift = ((($basicPay * 12)/365)/7) * 1.5 * 3;
        $basicHourlyRate = ((($basicPay * 12)/365)/7);
        $transportFee = 0.0;
        $bonus = 0.0;
        $paymentStatus = "Not Paid";
        $paymentAmount = 0;

        if ($paymentFrequency == "Weekly"){
            //check if got work night shift
            if ($totalAttendanceOfCurrentWeekNight > 0){
                //check if got OT
                if ($totalOTDays > 0) {
                    $paymentAmount += $OTPayPerShift * $totalOTDays;
                }

                //for weekly - check if got PH
                $countWorkingPH = 0;
                foreach ($attendanceOfCurrentWeekNight as $workingDate) {
                    if (in_array($workingDate, $allPublicHolidays)){
                        $countWorkingPH++;
                    }
                }

                //check if got work on PH - night shift
                if ($countWorkingPH > 0){
                    $totalAttendanceOfCurrentWeekNight = $totalAttendanceOfCurrentWeekNight - $countWorkingPH;
                    $paymentAmount += $countWorkingPH * $basicHourlyRate * 2;
                }
                $paymentAmount += $basicHourlyRate * 7 * $totalAttendanceOfCurrentWeekNight;
            }
        } else if ($paymentFrequency == "BiWeekly"){
            // $totalWorkedHours = totalHoursWorked($eid, $currentMonth);
           
            // if ($totalWorkedHours <= 176){
            //     $paymentAmount = ($totalWorkedHours - $workingHoursPH) * $basicHourlyRate;
            //     $paymentAmount += $workingHoursPH * $basicHourlyRate * 2;
            // } else if ($totalWorkedHours - 176 <= 72) {
            //     $paymentAmount = (176 - $workingHoursPH) * $basicHourlyRate;
            //     $OTHours = $totalWorkedHours-176;
            //     $paymentAmount += ($OTHours%3) * $OTPayPerShift;
            // }

            if ($totalAttendanceOfCurrentWeekDay > 0){
                //for BiWeekly
                $countWorkingPH = 0;
                foreach ($attendanceOfCurrentWeekDay as $workingDate) {
                    if (in_array($workingDate, $allPublicHolidays)){
                        $countWorkingPH++;
                    }
                }
                
                //check if got PH
                if ($countWorkingPH > 0){
                    $totalAttendanceOfCurrentWeekDay = $totalAttendanceOfCurrentWeekDay - $countWorkingPH;
                    $totalAttendanceOfCurrentWeekNight = $totalAttendanceOfCurrentWeekNight - $countWorkingPH;
                    $paymentAmount += $countWorkingPH * 2 * $basicHourlyRate;
                }
                //check if got OT
                if ($totalOTDaysBiWeekly > 0){
                    $paymentAmount += $totalOTDaysBiWeekly * $OTPayPerShift;
                }
                //check if last week paid
                $lastWeekPaymentStatus = checkIfLastWeekPaymentStatus($eid, $fromDate, $toDate);
                if (count($lastWeekPaymentStatus) > 0) {
                    if ($lastWeekPaymentStatus[1] == "Not Paid"){
                        $paymentAmount += $lastWeekPaymentStatus[0];
                    } else {
                        $paymentAmount -= $lastWeekPaymentStatus[0];
                        $paymentAmount += $totalAttendanceOfCurrentWeekNight * $basicHourlyRate * 7;
                    }
                }
            }
            $paymentAmount += $totalAttendanceOfCurrentWeekDay * $basicHourlyRate * 7;
            $paymentAmount += $bonus + $transportFee;
            // var_dump($paymentAmount);
        } else {
             //check if got work on PH - day shift
            //  if ($countWorkingPHMonthly > 0) {
            //     $paymentAmount += $countWorkingPHMonthly * $basicHourlyRate * 2; 
            // }
            //for Monthly
            $attendanceOfCurrentMonthDay = attendanceOfCurrentMonthDay($eid, $month);
            $totalAttendanceOfCurrentMonthDay = count($attendanceOfCurrentMonthDay);

            //count PH
            $countWorkingPH = 0;
            foreach ($attendanceOfCurrentMonthDay as $workingDate) {
                if (in_array($workingDate, $allPublicHolidays)){
                    $countWorkingPH++;
                }
            }

            $pastThreeWeeksPaymentStatus = checkIfThereIsStillLeftovers($eid, $month);
            $leftoverAmount = 0;
            if (count($pastThreeWeeksPaymentStatus) > 0) {
                foreach($pastThreeWeeksPaymentStatus as $result){
                    if (in_array("Not Paid", $result)){
                        $leftoverAmount += $result[0];
                    }
                }
            }
            $paymentAmount += $leftoverAmount;
            $paymentAmount += $bonus + $transportFee;
            // var_dump($paymentAmount);
        } 
        
        
        $sql = "INSERT INTO payroll_records
                (Employee_ID, Month, Year, Payment_Frequency, Payment_Type, No_Of_PH, Payment_Amount, Basic_Hourly_Rate, OT_Per_Shift, From_Date, To_Date, Transport_Cost, Bonus, Status, CREATED_BY)
                VALUES
                (:Employee_ID, :Month, :Year, :Payment_Frequency, :Payment_Type, :No_Of_PH, :Payment_Amount, :Basic_Hourly_Rate, :OT_Per_Shift, :From_Date, :To_Date, :Transport_Cost, :Bonus, :Status, :createdBy)";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':Employee_ID', $eid, PDO::PARAM_INT);
        $stmt->bindParam(':Month', $month, PDO::PARAM_STR);
        $stmt->bindParam(':Year', $currentYear, PDO::PARAM_STR);
        $stmt->bindParam(':Payment_Frequency', $paymentFrequency, PDO::PARAM_STR);
        $stmt->bindParam(':Payment_Type', $paymentType, PDO::PARAM_STR);
        $stmt->bindParam(':No_Of_PH', $countWorkingPH, PDO::PARAM_INT);
        $stmt->bindParam(':Payment_Amount', $paymentAmount, PDO::PARAM_STR);
        $stmt->bindParam(':Basic_Hourly_Rate', $basicHourlyRate, PDO::PARAM_STR);
        $stmt->bindParam(':OT_Per_Shift', $OTPayPerShift, PDO::PARAM_STR);
        $stmt->bindParam(':From_Date', $fromDate, PDO::PARAM_STR);
        $stmt->bindParam(':To_Date', $toDate, PDO::PARAM_STR);
        $stmt->bindParam(':Transport_Cost', $transportFee, PDO::PARAM_STR);
        $stmt->bindParam(':Bonus', $bonus, PDO::PARAM_STR);
        $stmt->bindParam(':Status', $paymentStatus, PDO::PARAM_STR);
        $stmt->bindParam(':createdBy', $eidRecorded, PDO::PARAM_INT);

        $stmt->execute();

        return true;

        // $success = FALSE;

        // if($stmt->execute()){
        //     $success = TRUE;
        // }

        // return $success;
    // }
    
    // if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //     //Set headers
    //     header("Access-Control-Allow-Origin: *");
    //     header("Content-Type: application/json; charset=UTF-8");
    //     header("Access-Control-Allow-Methods: POST");

    //     //Connect DB and get data
    //     try {
    //         $eid = $_SESSION['eid'];
    //         $result = create($eid);

    //         if ($result) {
    //             //Set response code
    //             http_response_code(200);
    
    //             //Standard json to return
    //             $json = new json(200, "Data created successfully.");
    //             echo json_encode($json);
    //         } else {
    //             //Set response code
    //             http_response_code(500);
    
    //             //Standard json to return
    //             $json = new json(500, "Something went wrong.");
    //             echo json_encode($json);
    //         }
    //     } catch (Exception $e) {
    //         //Set response code
    //         http_response_code(500);
    
    //         //Standard json to return
    //         $json = new json(500, "Something went wrong.");
    //         echo json_encode($json);
    //     }
    // } else {
    //     header("Access-Control-Allow-Methods: POST");
    //     header("Content-Type: application/json; charset=UTF-8");

    //     //Set response code
    //     http_response_code(405);

    //     //Standard json to return
    //     $json = new json(405, "HTTP request method not allowed.");
    //     echo json_encode($json);
    // }
    
    
?>