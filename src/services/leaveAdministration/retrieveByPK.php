<?php
    include "../../common/commonAPI.php";

    function retrieveByPK($empID, $fromDate)
    {
        $sql = "SELECT * from Leave_Application where Employee_ID=:empID and From_Date=:fromDate";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':empID', $empID, PDO::PARAM_INT);
        $stmt->bindParam(':fromDate', $fromDate, PDO::PARAM_STR);
        $stmt->execute();

        if($row = $stmt->fetch()){
            return new leave($row['Employee_ID'], $row['From_Date'], $row['To_Date'], $row['Status'], $row['Leave_Type'], $row['Remarks'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
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
            $empID = $_GET['empID'];
            $fromDate = $_GET['fromDate'];
            $result = retrieveByPK($empID, $fromDate);

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