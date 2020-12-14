<?php
    include "../../../common/commonAPI.php";

    function update($employee, $EID)
    {
        $sql = "UPDATE Emp_Employment_Details set Joining_Date=:joinDate, Employment_Type=:empType,
                Contract_Start_Date=:contractSD, Contract_End_Date=:contractED, Probation_Start_Date=:probationSD,
                Probation_End_Date=:probationED, Confirmation_Date=:confirmDate, Designation=:designation, Department=:department, 
                Supervisor_ID=:supervisorID, Last_Modified_By=:lastModBy where Employee_ID=:eid";      
            
        $connMgr = new connectionManager();           
        $conn = $connMgr->getConnection();
            
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':joinDate', $employee->joinDate, PDO::PARAM_STR);
        $stmt->bindParam(':empType', $employee->empType, PDO::PARAM_STR);
        $stmt->bindParam(':contractSD', $employee->contractSD, PDO::PARAM_STR);
        $stmt->bindParam(':contractED', $employee->contractED, PDO::PARAM_STR);
        $stmt->bindParam(':probationSD', $employee->probationSD, PDO::PARAM_STR);
        $stmt->bindParam(':probationED', $employee->probationED, PDO::PARAM_STR);
        $stmt->bindParam(':confirmDate', $employee->confirmDate, PDO::PARAM_STR);
        $stmt->bindParam(':designation', $employee->designation, PDO::PARAM_STR);
        $stmt->bindParam(':department', $employee->department, PDO::PARAM_STR);
        $stmt->bindParam(':supervisorID', $employee->supervisorID, PDO::PARAM_INT);
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