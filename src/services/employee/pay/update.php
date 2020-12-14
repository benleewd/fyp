<?php
    include "../../../common/commonAPI.php";

    function update($employee, $EID)
    {
        $sql = 'update Emp_Pay_Details set Pay_Frequency=:payFreq, Pay_Type=:payType, Basic_Pay=:basicPay, 
            Day_Shift_Rate=:dayShiftRate, Night_Shift_Rate=:nightShiftRate, CPF_Entitled=:cpfEntitled, Fund_Donation=:fundDonation, 
            Pay_Mode=:Pay_Mode, Employee_Bank=:Employee_Bank, Account_No=:accNo, Notice_Period=:noticePeriod, Remarks=:remarks, 
            Last_Modified_By=:lastModBy where Employee_ID=:eid';      
        
        $connMgr = new connectionManager();           
        $conn = $connMgr->getConnection();
            
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':payFreq', $employee->payFreq, PDO::PARAM_STR);
        $stmt->bindParam(':payType', $employee->payType, PDO::PARAM_STR);
        $stmt->bindParam(':basicPay', $employee->basicPay, PDO::PARAM_STR);
        $stmt->bindParam(':dayShiftRate', $employee->dayShiftRate, PDO::PARAM_STR);
        $stmt->bindParam(':nightShiftRate', $employee->nightShiftRate, PDO::PARAM_STR);
        $stmt->bindParam(':cpfEntitled', $employee->cpfEntitled, PDO::PARAM_STR);
        $stmt->bindParam(':fundDonation', $employee->fundDonation, PDO::PARAM_STR);
        $stmt->bindParam(':Pay_Mode', $employee->payMode, PDO::PARAM_STR);
        $stmt->bindParam(':Employee_Bank', $employee->empBank, PDO::PARAM_STR);
        $stmt->bindParam(':accNo', $employee->accNo, PDO::PARAM_STR);
        $stmt->bindParam(':noticePeriod', $employee->noticePeriod, PDO::PARAM_STR);
        $stmt->bindParam(':remarks', $employee->remarks, PDO::PARAM_STR);
        $stmt->bindParam(':lastModBy', $EID, PDO::PARAM_INT);
        $stmt->bindParam(':eid', $employee->eid, PDO::PARAM_INT);

        
        $stmt->execute();

        $count = $stmt->rowCount();

        return $count;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PUT");

        try {
            //Connect DB and get data
            parse_str(file_get_contents("php://input"),$_PUT);
            $data = json_decode($_PUT['data']);
            $eid = $_SESSION['eid'];
            $result = update($data, $eid);

            if ($result) {
                //Set response code
                http_response_code(200);

                //Standard json to return
                $json = new json(200, "Data updated successfully.");
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
        header("Access-Control-Allow-Methods: PUT");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>