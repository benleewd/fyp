<?php
    include "../../common/commonAPI.php";

    function retrieveAll() {
        $sql = "SELECT * from Site";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] = new site($row['Project_ID'], $row['Project_Name'], $row['Shifts'], $row['Public_Holiday'], $row['Site_Allowance'], $row['Employees_Required'], "Empty QR code for now", $row['Address'], $row['Longitude'], $row['Latitude'], $row['Active'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
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
            $result = retrieveAll();

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