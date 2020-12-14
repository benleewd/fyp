<?php
    include "../../common/commonAPI.php";

    function create($notification, $eid)
    {
        $sql = "INSERT INTO Notification
                (Title, Body, Type, Employee_ID, CREATED_BY)
                VALUES
                (:title, :body, :type, :eid, :createdBy)";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':title', $notification->title, PDO::PARAM_STR);
        $stmt->bindParam(':body', $notification->body, PDO::PARAM_STR);
        $stmt->bindParam(':type', $notification->type, PDO::PARAM_STR);
        $stmt->bindParam(':eid', $notification->eid, PDO::PARAM_INT);
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
            $eid = 1;
            try {
                $eid = $_SESSION['eid'];
            } catch (Exception $e) {
                $eid = 1;
            }
            
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
                $json = new json(500, "Something went wrong1.");
                echo json_encode($json);
            }
        } catch (Exception $e) {
            //Set response code
            http_response_code(500);
    
            //Standard json to return
            $json = new json(500, "Something went wrong3.");
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