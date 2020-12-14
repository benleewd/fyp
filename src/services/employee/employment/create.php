<?php
    include "../../../common/commonAPI.php";

    function create($employee, $eid)
    {
        $sql = "INSERT INTO Emp_Employment_Details 
        (Employee_ID, Joining_Date, Employment_Type, Contract_Start_Date, Contract_End_Date, Probation_Start_Date, Probation_End_Date,
        Confirmation_Date, Designation, Department, Supervisor_ID, CREATED_BY) 
            VALUES (:eid, :joinDate, :empType, :contractSD, :contractED, :probationSD, :probationED, :confirmDate, :designation, 
            :department, :supervisorID, :createdBy)";
    
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':eid', $employee->eid, PDO::PARAM_INT);
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