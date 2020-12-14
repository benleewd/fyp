<?php
    include "../../common/commonAPI.php";

    function update($accessControl, $eid)
    {
        $sql = "UPDATE Access_Right SET
                `Accessible`=:accessible, Module=:module, LAST_MODIFIED_BY=:lastModifiedBy
                where Designation=:designation and Page_Access=:pageAccess and `Type`=:type";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':designation', $accessControl->designation , PDO::PARAM_STR);
        $stmt->bindParam(':pageAccess', $accessControl->pageAccess, PDO::PARAM_STR);
        $stmt->bindParam(':accessible', $accessControl->accessible, PDO::PARAM_BOOL);
        $stmt->bindParam(':module', $accessControl->module, PDO::PARAM_STR);
        $stmt->bindParam(':type', $accessControl->type, PDO::PARAM_STR);
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
            foreach ($data as $obj) {
                update($obj, $eid);
            }

            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "Data updated successfully.");
            echo json_encode($json);
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