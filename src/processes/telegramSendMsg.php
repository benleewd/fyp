<?php    
    //$update = {"eid" : 1, "message" : ["a", "b"], "type" : "basic" }
    $update = json_decode(file_get_contents("php://input"), TRUE);
    $eid = $update['eid'];
    $msgs = $update['message'];
    $type = $update['type']; // can be basic / approval
    $chatId = getTelegramUser($eid);

    if ($chatId != null) {
        if ($type == "basic"){
            foreach ($msgs as $msg) {
                sendMessage($chatId, $msg);
            }
        } elseif ($type == "approval") {
            $targetEID = $update['leaveEID'];
            $fromDate = $update['fromDate'];
            $leaveType = $update['leaveType'];
            $numDays = $update['numDays'];
            foreach ($msgs as $msg) {
                sendApprovalMsg($chatId, $msg, $targetEID, $fromDate, $leaveType, $numDays);
            }
            
        }
    }
 
    function sendApprovalMsg($chatId, $msg, $targetEID, $fromDate, $leaveType, $numDays){
        $path = "https://api.telegram.org/bot";
        $botId = "988474515:AAEY6161b-q5P1PykcxUyBb2jpBZWSU9Aac";
        
        $keyboard = array(
            'inline_keyboard' => array(
                array(
                    array(
                        'text' => "Approved",
                        'callback_data' => "approve," . $targetEID . "," . $fromDate . "," . $leaveType . "," . $numDays
                    ),
                    array(
                        'text' => "Rejected",
                        'callback_data' => "reject," . $targetEID . "," . $fromDate
                    )
                )
            )
        );

        $markup = json_encode($keyboard);

        // $data = array(
        //     'chat_id' => $chatId,
        //     'text' => $msg,
        //     'reply_markup' => 
        //     )
        // );

        //[[['text' => "Approved", 'callback_data' => "approve"], ['text' => "Rejected", 'callback_data' => "reject"]]];
        

        $data = [
            'chat_id' => $chatId,
            'text' => $msg,
            'reply_markup' => $markup
        ];
        
        $response = file_get_contents($path . $botId . "/sendMessage?" . http_build_query($data));
    }


    function sendMessage($chatId, $msg) {
        $path = "https://api.telegram.org/bot";
        $botId = "988474515:AAEY6161b-q5P1PykcxUyBb2jpBZWSU9Aac";

        $data = [
            'chat_id' => $chatId,
            'text' => $msg
        ];
        
        $response = file_get_contents($path . $botId . "/sendMessage?" . http_build_query($data));
    }

    function getTelegramUser($eid){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.k11hrclicks.com/services/telegram/retrieveByID.php?eid=".$eid . "&API=Error404",
        // CURLOPT_URL => "https://www.k11hrclicks.com/Error-404-FYP/HRClicks/src/services/telegram/retrieveByID.php?eid=". $eid . "&API=Error404",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
        ));
        
        $response = json_decode(curl_exec($curl), TRUE);
        $err = curl_error($curl);

        curl_close($curl);

        if ($response['data'] != null || $response['data'] != "") {
            return $response['data'];
        } 

        return null;
    }

?>