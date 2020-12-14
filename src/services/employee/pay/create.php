<?php
    include "../../../common/commonAPI.php";

    function create($employee, $eid)
    {
        $sql = "INSERT INTO Emp_Pay_Details 
        (Employee_ID, Pay_Frequency, Pay_Type, Basic_Pay, Day_Shift_Rate, Night_Shift_Rate, CPF_Entitled,
        Fund_Donation, Pay_Mode, Employee_Bank, Account_No, Notice_Period, Remarks, CREATED_BY) 
            VALUES (:eid, :payFreq, :payType, :basicPay, :dayShiftRate, :nightShiftRate, :cpfEntitled, :fundDonation, :payMode, 
            :empBank, :accNo, :noticePeriod, :remarks, :createdBy)";
    
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':eid', $employee->eid, PDO::PARAM_INT);
        $stmt->bindParam(':payFreq', $employee->payFreq, PDO::PARAM_STR);
        $stmt->bindParam(':payType', $employee->payType, PDO::PARAM_STR);
        $stmt->bindParam(':basicPay', $employee->basicPay, PDO::PARAM_STR);
        $stmt->bindParam(':dayShiftRate', $employee->dayShiftRate, PDO::PARAM_STR);
        $stmt->bindParam(':nightShiftRate', $employee->nightShiftRate, PDO::PARAM_STR);
        $stmt->bindParam(':cpfEntitled', $employee->cpfEntitled, PDO::PARAM_STR);
        $stmt->bindParam(':fundDonation', $employee->fundDonation, PDO::PARAM_STR);
        $stmt->bindParam(':payMode', $employee->payMode, PDO::PARAM_STR);
        $stmt->bindParam(':empBank', $employee->empBank, PDO::PARAM_STR);
        $stmt->bindParam(':accNo', $employee->accNo, PDO::PARAM_STR);
        $stmt->bindParam(':noticePeriod', $employee->noticePeriod, PDO::PARAM_STR);
        $stmt->bindParam(':remarks', $employee->remarks, PDO::PARAM_STR);
        $stmt->bindParam(':createdBy', $eid, PDO::PARAM_INT);
    
        $success = FALSE;
    
        if($stmt->execute()){
            $success = TRUE;
        }
    
        return $success;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");

        //Connect DB and get data
        try {
            $data = json_decode($_POST['data']);
            $eid = $_SESSION['eid'];
            $result = create($data, $eid);

            if ($result) {
                //Set response code
                http_response_code(200);

                //Standard json to return
                $json = new json(200, "Data created successfully.");
                echo json_encode($json);
            } else {
                //Set response code
                http_response_code(500);

                //Standard json to return
                $json = new json(500, "Something went wrong.");
                echo json_encode($json);
            }
        } catch (Exception $e) {
            //Set response code
            http_response_code(500);
    
            //Standard json to return
            $json = new json(500, "Something went wrong.");
            echo json_encode($json);
        }
        
        
    } else {
        header("Access-Control-Allow-Methods: POST");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>