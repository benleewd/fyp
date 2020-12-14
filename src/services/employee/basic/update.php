<?php
    include "../../../common/commonAPI.php";

    function update($employee, $EID)
    {
        $sql = "UPDATE Emp_Basic_Information set First_Name=:firstName, Last_Name=:lastName,
            Gender=:gender, Marital_Status=:maritalStatus, Date_Of_Birth=:dob,
            Nationality=:nationality, Religion=:religion, Race=:race, Blood_Group=:bloodGroup, 
            Place_Of_Birth=:placeOfBirth, Identification_Type=:idType, Identification_No=:idNo,
            Pass_Type=:passType, Highest_Qualification=:highestQual, Mobile_No=:mobileNo, Email=:email, 
            Last_Modified_By=:lastModBy where Employee_ID=:eid";      
        
        $connMgr = new connectionManager();           
        $conn = $connMgr->getConnection();
            
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':firstName', $employee->firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $employee->lastName, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $employee->gender, PDO::PARAM_STR);
        $stmt->bindParam(':maritalStatus', $employee->maritalStatus, PDO::PARAM_STR);
        $stmt->bindParam(':dob', $employee->dob, PDO::PARAM_STR);
        $stmt->bindParam(':nationality', $employee->nationality, PDO::PARAM_STR);
        $stmt->bindParam(':religion', $employee->religion, PDO::PARAM_STR);
        $stmt->bindParam(':race', $employee->race, PDO::PARAM_STR);
        $stmt->bindParam(':bloodGroup', $employee->bloodGroup, PDO::PARAM_STR); 
        $stmt->bindParam(':placeOfBirth', $employee->placeOfBirth, PDO::PARAM_STR);
        $stmt->bindParam(':idType', $employee->idType, PDO::PARAM_STR);
        $stmt->bindParam(':idNo', $employee->idNo, PDO::PARAM_STR);
        $stmt->bindParam(':passType', $employee->passType, PDO::PARAM_STR);
        $stmt->bindParam(':highestQual', $employee->highestQual, PDO::PARAM_STR);
        $stmt->bindParam(':mobileNo', $employee->mobileNo, PDO::PARAM_STR);
        $stmt->bindParam(':email', $employee->email, PDO::PARAM_STR);
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