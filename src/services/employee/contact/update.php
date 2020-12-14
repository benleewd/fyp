<?php
    include "../../../common/commonAPI.php";

    function update($employee, $EID)
    {
        $sql = "UPDATE Emp_Emergency_Contact set Emergency_Contact_Name=:emergencyCN, Relationship=:relationship,
        Emergency_Contact_No=:emergencyCD, Last_Modified_By=:lastModBy where Employee_ID=:eid";      
    
        $connMgr = new connectionManager();           
        $conn = $connMgr->getConnection();
            
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':emergencyCN', $employee->emergencyCN, PDO::PARAM_STR);
        $stmt->bindParam(':relationship', $employee->relationship, PDO::PARAM_STR);
        $stmt->bindParam(':emergencyCD', $employee->emergencyCD, PDO::PARAM_STR);
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