<?php
    include "../../common/commonAPI.php";

    function update($inventoryOrder, $eid)
    {
        $sql = "UPDATE Inventory_Order SET
                Date_Ordered=:dateOrdered, Quantity_Ordered=:qtyOrdered, Date_Of_Issue=:dateIssued, Date_Of_Collection=:dateCollected, Remarks=:remarks, LAST_MODIFIED_BY=:lastModifiedBy
                where Employee_ID=:eid and SKU=:sku";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':eid', $inventoryOrder->eid , PDO::PARAM_INT);
        $stmt->bindParam(':sku', $inventoryOrder->sku , PDO::PARAM_INT);
        $stmt->bindParam(':dateOrdered', $inventoryOrder->dateOrdered, PDO::PARAM_STR);
        $stmt->bindParam(':qtyOrdered', $inventoryOrder->qtyOrdered, PDO::PARAM_STR);
        $stmt->bindParam(':dateIssued', $inventoryOrder->dateIssued, PDO::PARAM_STR);
        $stmt->bindParam(':dateCollected', $inventoryOrder->dateCollected, PDO::PARAM_STR);
        $stmt->bindParam(':remarks', $inventoryOrder->remarks, PDO::PARAM_STR);
        $stmt->bindParam(':lastModifiedBy', $eid , PDO::PARAM_INT);

        $stmt->execute();

        $count = $stmt->rowCount();

        return $count;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PUT");

        //Connect DB and get data
        try {
            parse_str(file_get_contents("php://input"),$_PUT);
            $data = json_decode($_PUT['data']);
            $eid = $_SESSION['eid'];
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