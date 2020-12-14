<?php
    include "../../../common/commonAPI.php";

    function create($employee, $eid)
    {
        $sql = "INSERT INTO Emp_Emergency_Contact 
        (Employee_ID, Emergency_Contact_Name, Relationship, Emergency_Contact_No, CREATED_BY) 
            VALUES (:eid, :emergencyCN, :relationship, :emergencyCD, :createdBy)";
    
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':eid', $employee->eid, PDO::PARAM_INT);
        $stmt->bindParam(':emergencyCN', $employee->emergencyCN, PDO::PARAM_STR);
        $stmt->bindParam(':relationship', $employee->relationship, PDO::PARAM_STR);
        $stmt->bindParam(':emergencyCD', $employee->emergencyCD, PDO::PARAM_STR);
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

        try {
            //Connect DB and get data
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