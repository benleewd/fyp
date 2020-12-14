<?php
    include "../../common/commonAPI.php";

    function retrieveByEID($eid , $month, $fromDate, $toDate)
    {
        $sql = "SELECT * from payroll_records where Employee_ID=:eid and Month=:month and From_Date=:fromDate and To_Date=:toDate";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->bindParam(':month', $month, PDO::PARAM_STR);
        $stmt->bindParam(':fromDate', $fromDate, PDO::PARAM_STR);
        $stmt->bindParam(':toDate', $toDate, PDO::PARAM_STR);
        $stmt->execute();

        if($row = $stmt->fetch()){
            return new payment($row['Employee_ID'], $row['Month'], $row['Year'], $row['Payment_Frequency'], $row['Payment_Type'], $row['No_Of_PH'], $row['Payment_Amount'], $row['Basic_Hourly_Rate'], $row['OT_Per_Shift'], $row['From_Date'], $row['To_Date'],$row['Transport_Cost'], $row['Bonus'], $row['Status'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
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
            $month = $_GET['month'];
            $fromDate = $_GET['fromDate'];
            $toDate = $_GET['toDate'];
            $result = retrieveByEID($eid, $month, $fromDate, $toDate);

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