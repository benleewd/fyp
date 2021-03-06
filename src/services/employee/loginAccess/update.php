<?php
    include "../../../common/commonAPI.php";

    function update($employeeID, $username, $passwordHashed, $eid)
    {
        $sql = "UPDATE Login_Access SET
                Username=:username, Password_Hashed=:passwordHashed, LAST_MODIFIED_BY=:lastModifiedBy
                where Employee_ID=:employeeID";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':employeeID', $employeeID , PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':passwordHashed', $passwordHashed, PDO::PARAM_STR);
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
            $employeeID = $_PUT['employeeID'];
            $username = $_PUT['username'];
            $passwordHashed = password_hash($_PUT['password'], PASSWORD_DEFAULT) ;
            $eid = $_SESSION['eid'];
            $result = update($employeeID, $username, $passwordHashed, $eid);

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