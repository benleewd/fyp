<?php
    include "../../common/commonAPI.php";

    function retrieveByMonth($eid, $monthSelected, $yearSelected)
    {
        $sql = "SELECT * from Attendance where Employee_ID=:eid and Month(Date_Completed_Shift) =:monthSelected and Year(Date_Completed_Shift) =:yearSelected";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->bindParam(':monthSelected', $monthSelected, PDO::PARAM_INT);
        $stmt->bindParam(':yearSelected', $yearSelected, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();

        while ($row = $stmt->fetch()){
            $result[] = new attendance($row['Employee_ID'], $row['Date_Completed_Shift'], $row['Shift_Name'], $row['Project_ID'], $row['Clock_In'], $row['Clock_Out'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
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
            $monthSelected = $_GET['monthSelected'];
            $yearSelected = $_GET['yearSelected'];
            $result = retrieveByMonth($eid, $monthSelected, $yearSelected);

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