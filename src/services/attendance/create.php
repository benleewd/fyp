<?php
    include "../../common/commonAPI.php";

    function create($attendance, $eid)
    {
        $sql = "INSERT INTO Attendance
                (Employee_ID, Date_Completed_Shift, Shift_Name, Project_ID, Clock_In, Clock_Out, CREATED_BY)
                VALUES
                (:eid, :dateCompletedShift, :shiftName, :projectID, :clockIn, :clockOut, :createdBy)";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':eid', $attendance->eid, PDO::PARAM_INT);
        $stmt->bindParam(':dateCompletedShift', $attendance->dateCompletedShift, PDO::PARAM_STR);
        $stmt->bindParam(':shiftName', $attendance->shiftName, PDO::PARAM_STR);
        $stmt->bindParam(':projectID', $attendance->projectID, PDO::PARAM_INT);
        $stmt->bindParam(':clockIn', $attendance->clockIn, PDO::PARAM_STR);
        $stmt->bindParam(':clockOut', $attendance->clockOut, PDO::PARAM_STR);
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
        header("Content-Type: application/json; charset=UTF-8");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>