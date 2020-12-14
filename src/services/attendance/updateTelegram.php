<?php
    include "../../common/commonAPI.php";

    function update($attendance, $eid)
    {
        $sql = "UPDATE Attendance SET
                Clock_In=:clockIn, Clock_Out=:clockOut, LAST_MODIFIED_BY=:lastModifiedBy
                where Employee_ID=:eid and Date_Completed_Shift=:dateCompletedShift and Shift_Name=:shiftName and Project_ID=:projectID";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $modBy = 1;
        
        $stmt->bindParam(':eid', $attendance->eid, PDO::PARAM_INT);
        $stmt->bindParam(':dateCompletedShift', $attendance->dateCompletedShift, PDO::PARAM_STR);
        $stmt->bindParam(':shiftName', $attendance->shiftName, PDO::PARAM_STR);
        $stmt->bindParam(':projectID', $attendance->projectID, PDO::PARAM_INT);
        $stmt->bindParam(':clockIn', $attendance->clockIn, PDO::PARAM_STR);
        $stmt->bindParam(':clockOut', $attendance->clockOut, PDO::PARAM_STR);
        $stmt->bindParam(':lastModifiedBy', $modBy , PDO::PARAM_INT);

        $stmt->execute();

        $count = $stmt->rowCount();

        return $count;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");

        //Connect DB and get data
        try {
            $data = json_decode($_POST['data']);
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