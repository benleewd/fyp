<?php
    // setup bot functions as developer account
    session_start();
    $_SESSION['eid'] = 1;

    // to receive webhook data from telegram
    $update = json_decode(file_get_contents("php://input"), TRUE);

    //check if sending normal message or callback buttons pressed
    if (isset($update["message"]) && $update["message"] != null){
        $chatId = $update["message"]["chat"]["id"];
        $message = $update["message"]["text"];
        $user = $update['message']['from']['username'];
        $check = checkCreate($user);

        //check if username is in db
        if ($check !== -1){
            //registering username if in db and chatID not already stored
            if (strpos($message, "/start") === 0){
                if ($check){
                    sendMessage($chatId, "You have already started a chat with me!");
                } else{
                    //add chatID to db matched to username
                    update($chatId, $user); 
                }
            //to disallow any unauthorised access to bot functions
            } else if ($check) {
                //time out from site
                if (strpos($message, "Time out") === 0){
                    $siteID = explode("site", $message)[1];
                    $clockOut = clockInOut($user, $siteID, "out", $chatId);

                } else if (strpos($message, "Show my leave") === 0){
                    //show user's leave applications
                    $leaves = getLeave($user);
                    $count = 1;
                    foreach ($leaves as $leave) {
                        $msg = "Leave Application #" . $count . "\n" . "<b>From: </b>" . $leave['fromDate'] . "\n" . "<b>To: </b>" . $leave['toDate'] . "\n" . "<b>Status: </b>" . $leave['status'];
                        $msg .= "\n" . "<b>Type: </b>" . $leave['leaveType'];
                        if ($leave['remarks'] != "" || $leave['remarks'] != null){
                            $msg .= "\n" . "<b>Remarks: </b>" . $leave['remarks'];
                        }
                        sendMessage($chatId, $msg, "HTML");
                        $count += 1;
                    }

                } elseif (strpos($message, "Placeholder") === 0) {
                    sendMessage($chatId, "Function currently not available yet!");

                } else if ($update['message']['location'] != null){ 
                    //time in to site
                    $long = $update['message']['location']['longitude'];
                    $lat = $update['message']['location']['latitude'];
                    //get which site, do check if long lat is correct 
                    $site = getSite($long, $lat);
                    $clockIn = clockInOut($user, $site, "in", $chatId);

                } 
            }
        }
    } else {
        //callback buttons
        $chatId = $update["callback_query"]["from"]["id"];
        $msgId = $update["callback_query"]["message"]["message_id"];
        $reply = $update["callback_query"]["data"]; //"approve,1,20/05/20"
        $original_text = $update["callback_query"]["message"]["text"];

        $replies = ['approve' => "APPROVED", 'reject' => "REJECTED", ];

        $reply_arr = explode(",", $reply);
        $status = $reply_arr[0];
        $targetEID = $reply_arr[1];
        $fromDate = $reply_arr[2];

        if (leaveAction($status, $targetEID, $fromDate)){
            if ($status == 'approve'){
                $leaveType = $reply_arr[3];
                $numDays = $reply_arr[4];
                if (updateLeaveBalance($targetEID, $leaveType, $numDays)){
                    $reply_to_user = $replies[$status];
                    removeApproval($chatId, $msgId, $original_text, $reply_to_user, "leave");
                } else{
                    $reply_to_user = "Something went wrong, please contact your administrator with this <b>" . $reply . "</b>";
                    editMessage($chatId, $msgId, $reply_to_user);
                }
            }
        } else{
            $reply_to_user = "Something went wrong, please contact your administrator with this <b>" . $reply . "</b>";
            editMessage($chatId, $msgId, $reply_to_user);
        }

        

    }

// ----------------------------------------------------------------------
// -------------------------Functions------------------------------------
// ----------------------------------------------------------------------
    function leaveAction($status, $targetEID, $fromDate){

        $data = array(
            'empID' => (int)$targetEID,
            'fromDate' => $fromDate,
            'status' => $status,
            'eid' => 1,
            'API' => "Error404"
        );

        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://www.k11hrclicks.com/services/leaveRequest/updateLeaveStatusTelegram.php?',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));


        // Execute curl and return result to $response
        $response = json_decode(curl_exec($ch), TRUE);
        // Close request
        curl_close($ch);

        if ($response['status'] == 200){
            return TRUE;
        }
        return FALSE;
    }

    function updateLeaveBalance($targetEID, $leaveType, $numDays){
        $data = array(
            'empID' => (int)$targetEID,
            'leaveType' => $leaveType,
            'daysDeducted' => (int)$numDays,
            'API' => "Error404"
        );

        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://www.k11hrclicks.com/services/leaveRequest/updateLeaveBalanceTelegram.php?',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));


        // Execute curl and return result to $response
        $response = json_decode(curl_exec($ch), TRUE);
        // Close request
        curl_close($ch);

        if ($response['status'] == 200){
            return TRUE;
        }
        return FALSE;
    }

    function getLeave($telegramId){
        $eid = retrieveEID($telegramId);

        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://www.k11hrclicks.com/services/leaveManagement/retrieveOngoingPersonalLeave.php?eid=' . $eid . "&API=Error404",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));


        // Execute curl and return result to $response
        $response = json_decode(curl_exec($ch), TRUE);
        // Close request
        curl_close($ch);

        return $response['data'];
    }

    function clockInOut($telegramId, $siteId, $type, $chatId){
        $eid = retrieveEID($telegramId);
        $today = date("Y-m-d");
        $time = date("H:i", strtotime("+8 hours"));

        if ($type == "out"){
            if ($time > "19:30"){
                $shift = "day";
            } else{
                $shift = "night";
            }

            $ch = curl_init();

            // Set curl options
            curl_setopt_array($ch, array(
                CURLOPT_URL => 'https://www.k11hrclicks.com/services/attendance/retrieveByPK.php?eid=' . $eid . "&dateCompletedShift=" . $today . "&shiftName=" . $shift . "&projectID=" . $siteId ."&API=Error404",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache"
                ),
            ));
    

            // Execute curl and return result to $response
            $response = json_decode(curl_exec($ch), TRUE);
            // Close request
            curl_close($ch);

            if ($response['data'] != null){
                updateAttendance($eid, $date, $shift, $siteId, date("H:i:s"), $response['data']['clockIn']);
                removeKeyboard($chatId, "You have clocked out!");
                setupFunctions($chatId, "Thank you for your hard work today!", TRUE);
                updateRanking($eid, $siteId);
            } else{
                removeKeyboard($chatId, "There is some issues with your attendance");
                setupFunctions($chatId, "Please inform your supervisor!", TRUE);
            }
        } else if ($type == "in"){
            if ($time > "19:30"){
                $shift = "night";
                $datetime = new DateTime('tomorrow');
                $currentDay = $datetime->format("d");
                $currentMonth = $datetime->format("m");
                $currentYear = $datetime->format("Y");
                $date = $datetime->format("Y-m-d");
            } else{
                $shift = "day";
                $currentDay = date("d");
                $currentMonth = date("m");
                $currentYear = date("Y");
                $date = date("Y-m-d");
            }
            
            $ch = curl_init();

            // Set curl options
            curl_setopt_array($ch, array(
                CURLOPT_URL => 'https://www.k11hrclicks.com/services/schedule/retrieveScheduleForTheDay.php?month=' . $currentMonth . "&year=" . $currentYear . "&day=" . $currentDay . "&eid=" . $eid . "&siteID=" . $siteId . "&API=Error404",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache"
                ),
            ));
    

            // Execute curl and return result to $response
            $response = json_decode(curl_exec($ch), TRUE);
            // Close request
            curl_close($ch);

            if ($response['data'] != null){
                createAttendance($eid, $date, $shift, $siteId, date("H:i:s"));
                removeKeyboard($chatId, "Welcome!");
                setupFunctions($chatId, "You have clocked in!", FALSE, $siteId);
            } else{
                global $chatId;
                sendMessage($chatId, "You are not scheduled for today!");
                sendMessage($chatId, "If you believe this is a mistake, please contact your supervisor.");
            }
        }
    } 
    
    function updateAttendance($eid, $date, $shift, $siteID, $time, $prevTime){
        $data = array(
            'eid' => $eid,
            'dateCompletedShift' => $date,
            'shiftName' => $shift,
            'projectID' => $siteID,
            'clockIn' => $prevTime,
            'clockOut' => $time,
            'API' => "Error404"
        );
        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://www.k11hrclicks.com/services/attendance/updateTelegram.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));


        // Execute curl and return result to $response
        $response = json_decode(curl_exec($ch), TRUE);
        // Close request
        curl_close($ch);
    }

    function createAttendance($eid, $date, $shift, $siteID, $time){
        $data = array(
            'eid' => $eid,
            'dateCompletedShift' => $date,
            'shiftName' => $shift,
            'projectID' => $siteID,
            'clockIn' => $time,
            'API' => "Error404"
        );
        

        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://www.k11hrclicks.com/services/attendance/create.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));


        // Execute curl and return result to $response
        $response = json_decode(curl_exec($ch), TRUE);
        // Close request
        curl_close($ch);
    }

    function getSite($long, $lat){
        global $chatId;
        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://www.k11hrclicks.com/services/site/retrieveByLongLat.php?long=' . $long . "&lat=" . $lat . "&API=Error404",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));
    

        // Execute curl and return result to $response
        $response = json_decode(curl_exec($ch), TRUE);
        // Close request
        curl_close($ch);
        return $response['data']['projectID'];

    }

    function updateRanking($eid, $siteId){
        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://www.k11hrclicks.com/services/schedule/updateScheduleRanking.php?empID=' . $eid . "&siteID= " . $siteId . "&API=Error404",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
    

        // Execute curl and return result to $response
        $response = json_decode(curl_exec($ch), TRUE);
        // Close request
        curl_close($ch);
    }

    function retrieveEID($telegramId){
        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://www.k11hrclicks.com/services/telegram/retrieveByTID.php?telegramID=' . $telegramId . "&API=Error404",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));
    

        // Execute curl and return result to $response
        $response = json_decode(curl_exec($ch), TRUE);
        // Close request
        curl_close($ch);

        return $response['data']['eid'];
    }

    function getLocation($chatId){
        $path = "https://api.telegram.org/bot";
        $botId = "988474515:AAEY6161b-q5P1PykcxUyBb2jpBZWSU9Aac";
        
        $keyboard = array(
            'keyboard' => array(
                array(
                    array(
                        'text' => "Time In",
                        'request_location' => TRUE
                    )
                )
            )
        );

        $markup = json_encode($keyboard);

        $data = [
            'chat_id' => $chatId,
            'text' => "Please ensure that you are at/near the site, then press the button below.",
            'reply_markup' => $markup
        ];
        
        $response = file_get_contents($path . $botId . "/sendMessage?" . http_build_query($data));
    }
    function removeKeyboard($chatId, $reply_to_user){
        $path = "https://api.telegram.org/bot";
        $botId = "988474515:AAEY6161b-q5P1PykcxUyBb2jpBZWSU9Aac";

        $markup = json_encode(
            array(
                "remove_keyboard" => TRUE
            )
        );

        $data = [
            'chat_id' => $chatId,
            'text' => $reply_to_user,
            'parse_mode' => 'HTML',
            'reply_markup' => $markup
        ];
        
        $response = file_get_contents($path . $botId . "/sendMessage?" . http_build_query($data));
    }

    function removeApproval($chatId, $msgId, $original_text, $reply_to_user, $type){
        $path = "https://api.telegram.org/bot";
        $botId = "988474515:AAEY6161b-q5P1PykcxUyBb2jpBZWSU9Aac";

        $msg = "You have <b>" . $reply_to_user . "</b> this " . $type . " application" . "\n" . $original_text;

        $data = [
            'chat_id' => $chatId,
            'message_id' => $msgId,
            'text' => $msg,
            'parse_mode' => 'HTML'
        ];
        
        $response = file_get_contents($path . $botId . "/editMessageText?" . http_build_query($data));
    }

    function editMessage($chatId, $msgId, $reply_to_user){
        $path = "https://api.telegram.org/bot";
        $botId = "988474515:AAEY6161b-q5P1PykcxUyBb2jpBZWSU9Aac";

        $data = [
            'chat_id' => $chatId,
            'message_id' => $msgId,
            'text' => $reply_to_user,
            'parse_mode' => 'HTML'
        ];
        
        $response = file_get_contents($path . $botId . "/editMessageText?" . http_build_query($data));
    }


    function update($chatId, $user){
        $ch = curl_init();

        // Set curl options
        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://www.k11hrclicks.com/services/telegram/update.php?chatID=' . $chatId . "&telegramID=" . $user . "&API=Error404",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
            ));
    

        // Execute curl and return result to $response
        $response = json_decode(curl_exec($ch), TRUE);
        // Close request
        curl_close($ch);

        if ($response['status'] == 200){
            sendMessage($chatId, "Hi, Welcome to K11SecurityBot");
            sendMessage($chatId, "I will be sending you notifications on things you need to know!");
            setupFunctions($chatId, "Use the button options below for their different functions.", TRUE);
        }
    }

    function checkCreate($user){
        global $chatId;
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.k11hrclicks.com/services/telegram/checkExists.php?telegramID=".$user . "&API=Error404",
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

        if ($response['data'] === -1){
            sendMessage($chatId, "You are not registered in my database, please contact your manager!");
            return -1;
        } else if ($response['data'] !== 0) {
            return true;
        } 

        return false;
    }

    function sendMessage($chatId, $msg, $type="basic") {
        $path = "https://api.telegram.org/bot";
        $botId = "988474515:AAEY6161b-q5P1PykcxUyBb2jpBZWSU9Aac";

        if ($type == "basic"){
            $data = [
                'chat_id' => $chatId,
                'text' => $msg
            ];
        } else if ($type == "HTML"){
            $data = [
                'chat_id' => $chatId,
                'text' => $msg,
                'parse_mode' => 'HTML'
            ];
        }
        
        $response = file_get_contents($path . $botId . "/sendMessage?" . http_build_query($data));
    }


    function setupFunctions($chatId, $text, $timein, $siteId=0){
        $path = "https://api.telegram.org/bot";
        $botId = "988474515:AAEY6161b-q5P1PykcxUyBb2jpBZWSU9Aac";
        
        if ($timein){
            $keyboard = array(
                'keyboard' => array(
                    array(
                        array(
                            'text' => "Show my leave"
                        )
                    ),
                    array(
                        array(
                            'text' => "Time in", 
                            'request_location' => TRUE
                        )
                    ),
                    array(
                        array(
                            'text' => "Placeholder"
                        )
                    )
                )
            );
        } else {
            $keyboard = array(
                'keyboard' => array(
                    array(
                        array(
                            'text' => "Show my leave"
                        )
                    ),
                    array(
                        array(
                            'text' => "Time out from site" . $siteId
                        )
                    ),
                    array(
                        array(
                            'text' => "Placeholder"
                        )
                    )
                )
            );
        }

        

        $markup = json_encode($keyboard);

        $data = [
            'chat_id' => $chatId,
            'text' => $text,
            'reply_markup' => $markup
        ];
        
        $response = file_get_contents($path . $botId . "/sendMessage?" . http_build_query($data));
    }

    // function createNew($data) {
    //     $ch = curl_init();

    //     // Create post data
    //     $data = array(
    //         "telegram" => $data
    //     );
        
    //     // Set curl options
    //     curl_setopt_array($ch, array(
    //         CURLOPT_RETURNTRANSFER => 1, // Return information from server
    //         CURLOPT_URL => 'https://www.k11hrclicks.com/services/telegram/create.php',
    //         // CURLOPT_URL => 'https://www.k11hrclicks.com/Error-404-FYP/HRClicks/src/services/telegram/create.php',
    //         CURL_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => $data
    //     ));

    //     // Execute curl and return result to $response
    //     $response = curl_exec($ch);
    //     // Close request
    //     curl_close($ch);
        
        

    //     return false;
    // }


?>

