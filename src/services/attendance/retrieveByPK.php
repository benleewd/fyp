<?php
    include "../../common/commonAPI.php";

    function retrieveByPK($eid, $dateCompletedShift, $shiftName, $projectID)
    {
        $sql = "SELECT * from Attendance where Employee_ID=:eid and Date_Completed_Shift=:dateCompletedShift and Shift_Name=:shiftName and Project_ID=:projectID";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->bindParam(':dateCompletedShift', $dateCompletedShift, PDO::PARAM_STR);
        $stmt->bindParam(':shiftName', $shiftName, PDO::PARAM_STR);
        $stmt->bindParam(':projectID', $projectID, PDO::PARAM_INT);
        $stmt->execute();

        if($row = $stmt->fetch()){
            return new attendance($row['Employee_ID'], $row['Date_Completed_Shift'], $row['Shift_Name'], $row['Project_ID'], $row['Clock_In'], $row['Clock_Out'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
        }

        return null;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");

        //Connect DB and get data
        try {
            $eid = $_GET['eid'];
            $dateCompletedShift = $_GET['dateCompletedShift'];
            $shiftName = $_GET['shiftName'];
            $projectID = $_GET['projectID'];
            $result = retrieveByPK($eid, $dateCompletedShift, $shiftName, $projectID);

            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "All data retrieved successfully.", $result);
            echo json_encode($json);
        } catch (Exception $e) {
            //Set response code
            http_response_code(500);
    
            //Standard json to return
            $json = new json(500, "Something went wrong.");
            echo json_encode($json);
        }
        
        
    } else {
        header("Access-Control-Allow-Methods: GET");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>