<?php
    include "../../common/commonAPI.php";

    function retrieveByEID($eid, $sku)
    {
        $sql = "SELECT * from Site where Employee_ID=:eid and SKU=:sku";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->bindParam(':sku', $sku, PDO::PARAM_INT);
        $stmt->execute();

        if($row = $stmt->fetch()){
            return new inventoryOrder($row['Employee_ID'], $row['SKU'], $row['Date_Ordered'], $row['Quantity_Ordered'], $row['Date_Of_Issue'], $row['Date_Of_Collection'], $row['Remarks'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
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
            $sku = $_GET['sku'];
            $result = retrieveByEID($eid, $sku);

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