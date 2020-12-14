<?php
    include "../../common/commonAPI.php";

    function update($empID, $leaveType, $daysDeducted)
    {
        $sql = "UPDATE emp_leave_details set Days_Remaining = Days_Remaining - :daysDeducted, LAST_MODIFIED_BY=:lastModifiedBy where Employee_ID=:empID and Leave_Type=:leaveType";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $eid = 1;

        $stmt->bindParam(':empID', $empID , PDO::PARAM_INT);
        $stmt->bindParam(':daysDeducted', $daysDeducted, PDO::PARAM_INT);
        $stmt->bindParam(':leaveType', $leaveType, PDO::PARAM_STR);
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
            $empID = $_PUT['empID'];
            $leaveType = $_PUT['leaveType'];
            $daysDeducted = $_PUT['daysDeducted'];
            
            update($empID, $leaveType, $daysDeducted);

            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "Employee's leave balance updated successfully.");
            echo json_encode($json);

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