<?php
    include "../../../common/commonAPI.php";

    function retrieveByIC($ic)
    {
        $sql = "SELECT * from Emp_Basic_Information where Identification_No=:ic";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':ic', $ic, PDO::PARAM_STR);
        $stmt->execute();

        if($row = $stmt->fetch()){
            return $row['Employee_ID'];
        }

        return null;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");

        try {
            //Connect DB and get data
            $data = $_GET['ic'];
            $result = retrieveByIC($data);

            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "Data retrieved successfully.", $result);
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