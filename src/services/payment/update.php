<?php
    include "../../common/commonAPI.php";

    function update($payment, $eid)
    {
        $sql = "UPDATE payroll_records SET
                Year=:Year, Payment_Frequency=:Payment_Frequency, Payment_Type=:Payment_Type, No_Of_PH=:No_Of_PH, Payment_Amount=:Payment_Amount, Basic_Hourly_Rate=:Basic_Hourly_Rate, OT_Per_Shift=:OT_Per_Shift, From_Date=:From_Date, To_Date=:To_Date, Transport_Cost=:Transport_Cost, Bonus=:Bonus, Status=:Status, LAST_MODIFIED_BY=:lastModifiedBy
                where Employee_ID=:Employee_ID and Month=:Month and From_Date=:From_Date and To_Date=:To_Date";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':Employee_ID', $payment->eid, PDO::PARAM_INT);
        $stmt->bindParam(':Month', $payment->month, PDO::PARAM_STR);
        $stmt->bindParam(':Year', $payment->year, PDO::PARAM_STR);
        $stmt->bindParam(':Payment_Frequency', $payment->payFreq, PDO::PARAM_STR);
        $stmt->bindParam(':Payment_Type', $payment->payType, PDO::PARAM_STR);
        $stmt->bindParam(':No_Of_PH', $payment->noOfPH, PDO::PARAM_INT);
        $stmt->bindParam(':Payment_Amount', $payment->payAmount, PDO::PARAM_STR);
        $stmt->bindParam(':Basic_Hourly_Rate', $payment->basicHourlyRate, PDO::PARAM_STR);
        $stmt->bindParam(':OT_Per_Shift', $payment->OTPerShift, PDO::PARAM_STR);
        $stmt->bindParam(':From_Date', $payment->fromDate, PDO::PARAM_STR);
        $stmt->bindParam(':To_Date', $payment->toDate, PDO::PARAM_STR);
        $stmt->bindParam(':Transport_Cost', $payment->transportCost, PDO::PARAM_STR);
        $stmt->bindParam(':Bonus', $payment->bonus, PDO::PARAM_STR);
        $stmt->bindParam(':Status', $payment->status, PDO::PARAM_STR);
        $stmt->bindParam(':lastModifiedBy', $eid , PDO::PARAM_INT);

        $stmt->execute();

        $count = $stmt->rowCount();

        return $count;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PUT");

        //Connect DB and get data
        try {
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
            // echo $e;

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