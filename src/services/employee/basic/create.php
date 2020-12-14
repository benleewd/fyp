<?php
    include "../../../common/commonAPI.php";

    function create($employee, $eid)
    {
        $sql = "insert into emp_basic_information 
        (First_Name, Last_Name, Gender, Marital_Status, Date_Of_Birth, Nationality, Religion, Race, Blood_Group, 
            Place_Of_Birth, Identification_Type, Identification_No, Pass_Type, Highest_Qualification, Mobile_No, Email, CREATED_BY) 
            values (:firstName, :lastName, :gender, :maritalStatus, :dob, :nationality, :religion, :race, :bloodGroup,
            :placeOfBirth, :idType, :idNo, :passType, :highestQual, :mobileNo, :email, :createdBy)";
    
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