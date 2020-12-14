<?php
    include "../../common/commonAPI.php";

    function retrieveAllPendingLeave($eid) {
        $sql = "SELECT * from leave_application inner join Emp_Basic_Information on leave_application.Employee_ID = Emp_Basic_Information.Employee_ID where leave_application.Employee_ID in (select Employee_ID from emp_employment_details where Supervisor_ID=:eid) and Status = 'Pending'";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] = new leave($row['Employee_ID'], $row['From_Date'], $row['To_Date'], $row['Status'], $row['Leave_Type'], $row['Remarks'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY'], $row['Identification_No']);
        }

        return $result;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");

        //Connect DB and get data
        try {
            $eid = $_SESSION['eid'];
            $result = retrieveAllPendingLeave($eid);

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