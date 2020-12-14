<?php
    include "../../common/commonAPI.php";

    function retrieveToken($eid)
    {
        $sql = "SELECT Token from FirebaseCM where Employee_ID=:eid";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();

        while ($row = $stmt->fetch()){
            array_push($result, $row['Token']);
        }

        return $result;
    }

    function sendMessage($token, $title, $body, $type, $eid) {
        $post_field = "{\"to\": \"" . $token . "\",\"data\": {\"notification\": {\"title\": \"" . $title . "\",\"body\": \"" . $body . "\"" . ",\"type\": \"" . $type . "\"" . ",\"eid\": " . $eid . "" . "}}}";
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>$post_field,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: key=AAAAjzQ7GS0:APA91bFWrG5TO8NW3RGpDRt_hSJN5Dg2WbX9sHrVXj6ZmzpaOsNSEJHDO3EtXyIdh7f0TmzsP0Yodaw1qOe_ft6kC1vB9Cp94cOEdRie4d6J1Kz0elr85HXJO1fT1FYOWdWJei_fjDsO"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");

        //Connect DB and get data
        try {
            $eid = $_POST['eid'];
            $title = $_POST['title'];
            $body = $_POST['body'];
            $type = $_POST['type'];

            $result = retrieveToken($eid);
            $failure = false;
            foreach ($result as $token) {
                $output = sendMessage($token, $title, $body, $type, $eid);
                if (!$output) {
                    $failure = true;
                }
            }
            
            if ($failure) {
                //Set response code
                http_response_code(500);

                //Standard json to return
                $json = new json(500, "Messages failed to send.", $test);
                echo json_encode($json);
            } else {
                //Set response code
                http_response_code(200);

                //Standard json to return
                $json = new json(200, "Messages sent successfully.", $test);
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