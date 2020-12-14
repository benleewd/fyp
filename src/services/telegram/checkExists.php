<?php
    include "../../common/commonAPI.php";

    function retrieveByTelegramID($telegramID)
    {
        $sql = "SELECT * from telegram where Telegram_ID=:telegramID";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':telegramID', $telegramID, PDO::PARAM_STR);
        $stmt->execute();

        if($row = $stmt->fetch()){
            $tele = new telegram($row['Employee_ID'], $row['Telegram_ID'], $row['Chat_ID'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY'], $row['TID']);
            if ($tele->chatID != null){
                return $tele->chatID;
            } else {
                return 1;
            }
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
            $telegramID = $_GET['telegramID'];
            $result = retrieveByTelegramID($telegramID);

            if ($result == null){
                $output = -1;
            } else if ($result === 1){
                $output = 0;
            }else{
                $output = $result;
            }

            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "All data retrieved successfully.", $output);
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