<?php
    include "../../common/commonAPI.php";

    function update($empID, $fromDate, $statusUpdate, $eid)
    {
        $sql = "UPDATE leave_application set Status=:statusUpdate, LAST_MODIFIED_BY=:lastModifiedBy where Employee_ID=:empID and From_Date=:fromDate";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':empID', $empID , PDO::PARAM_INT);
        $stmt->bindParam(':fromDate', $fromDate, PDO::PARAM_STR);
        $stmt->bindParam(':statusUpdate', $statusUpdate, PDO::PARAM_STR);
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
            $fromDate = $_PUT['fromDate'];
            $status = $_PUT['status'];
            if (isset($_PUT['eid']) && $_PUT['eid'] != null){
                $eid = $_PUT['eid'];
            } else{
                $eid = $_SESSION['eid'];
            }
            
            update($empID, $fromDate, $status, $eid);

            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "Employee's leave status updated successfully.");
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