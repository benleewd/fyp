<?php
    include "../../common/commonAPI.php";

    function update($chatID, $telegramID, $eid)
    {
        $sql = "UPDATE telegram SET
                Chat_ID=:chatID, LAST_MODIFIED_BY=:lastModifiedBy
                where Telegram_ID=:telegramID";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':telegramID', $telegramID, PDO::PARAM_STR);
        $stmt->bindParam(':chatID', $chatID, PDO::PARAM_STR);
        $stmt->bindParam(':lastModifiedBy', $eid , PDO::PARAM_INT);

        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count > 0){
            return TRUE;
        }
        return FALSE;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");

        //Connect DB and get data
        try {
            $eid = 0;
            $chatID = $_GET['chatID'];
            $telegramID = $_GET['telegramID'];
            $result = update($chatID, $telegramID, $eid);

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