<?php
    include "../../common/commonAPI.php";

    function update($data, $eid)
    {
        $sql = "UPDATE telegram SET
                Telegram_ID=:telegramID, Chat_ID=:chatID, LAST_MODIFIED_BY=:lastModifiedBy
                where TID=:tid";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $chatID = "";
        $stmt->bindParam(':telegramID', $data->telegramID, PDO::PARAM_STR);
        $stmt->bindParam(':chatID', $chatID, PDO::PARAM_STR);
        $stmt->bindParam(':tid', $data->tid, PDO::PARAM_INT);
        $stmt->bindParam(':lastModifiedBy', $eid , PDO::PARAM_INT);

        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count > 0){
            return TRUE;
        }
        return FALSE;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PUT");

        //Connect DB and get data
        try {
            parse_str(file_get_contents("php://input"),$_PUT);
            $eid = $_SESSION['eid'];
            $data = json_decode($_PUT['data']);
            $result = update($data, $eid);

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
        header("Access-Control-Allow-Methods: PUT");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>