<?php
    include "../../common/commonAPI.php";

    function create($leave, $eidCreate)
    {
        $sql = "INSERT INTO Leave_Application
                (Employee_ID, From_Date, To_Date, Status, Leave_Type, Remarks, CREATED_BY)
                VALUES
                (:eid, :fromDate, :toDate, :status, :leaveType, :remarks, :createdBy)";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);

        $status = "Pending";
        
        $stmt->bindParam(':eid', $leave->eid, PDO::PARAM_INT);
        $stmt->bindParam(':fromDate', $leave->fromDate, PDO::PARAM_STR);
        $stmt->bindParam(':toDate', $leave->toDate, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':leaveType', $leave->leaveType, PDO::PARAM_STR);
        $stmt->bindParam(':remarks', $leave->remarks, PDO::PARAM_STR);
        $stmt->bindParam(':createdBy', $eidCreate, PDO::PARAM_INT);

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
        header("Content-Type: application/json; charset=UTF-8");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>