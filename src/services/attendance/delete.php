<?php
    include "../../common/commonAPI.php";

    function delete($eid, $dateCompletedShift, $shiftName, $projectID)
    {
        $sql = 'DELETE from Attendance where Employee_ID=:eid and Date_Completed_Shift=:dateCompletedShift and Shift_Name=:shiftName and Project_ID=:projectID';
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->bindParam(':dateCompletedShift', $dateCompletedShift, PDO::PARAM_STR);
        $stmt->bindParam(':shiftName', $shiftName, PDO::PARAM_STR);
        $stmt->bindParam(':projectID', $projectID, PDO::PARAM_INT);
        
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");

        //Connect DB and get data
        try {
            parse_str(file_get_contents("php://input"),$_DELETE);
            $eid = $_DELETE['eid'];
            $dateCompletedShift = $_DELETE['dateCompletedShift'];
            $shiftName = $_DELETE['shiftName'];
            $projectID = $_DELETE['projectID'];
            $result = delete($eid, $dateCompletedShift, $shiftName, $projectID);
            
            if ($result) {
                //Set response code
                http_response_code(200);

                //Standard json to return
                $json = new json(200, "Data deleted successfully.");
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
        header("Access-Control-Allow-Methods: DELETE");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>