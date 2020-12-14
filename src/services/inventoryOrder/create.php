<?php
    include "../../common/commonAPI.php";

    function create($inventoryOrder, $eid)
    {
        $sql = "INSERT INTO Inventory_Order
                (Employee_ID, SKU, Date_Ordered, Quantity_Ordered, Date_Of_Issue, Date_Of_Collection, Remarks, CREATED_BY)
                VALUES
                (:eid, :sku, :dateOrdered, :qtyOrdered, :dateIssued, :dateCollected, :remarks, :createdBy)";


        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':eid', $inventoryOrder->eid, PDO::PARAM_INT);
        $stmt->bindParam(':sku', $inventoryOrder->sku, PDO::PARAM_INT);
        $stmt->bindParam(':dateOrdered', $inventoryOrder->dateOrdered, PDO::PARAM_STR);
        $stmt->bindParam(':qtyOrdered', $inventoryOrder->qtyOrdered, PDO::PARAM_STR);
        $stmt->bindParam(':dateIssued', $inventoryOrder->dateIssued, PDO::PARAM_STR);
        $stmt->bindParam(':dateCollected', $inventoryOrder->dateCollected, PDO::PARAM_STR);
        $stmt->bindParam(':remarks', $inventoryOrder->remarks, PDO::PARAM_STR);
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