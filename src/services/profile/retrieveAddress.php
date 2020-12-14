<?php
    include "../../common/commonAPI.php";

    function retrieveByEID($EID)
    {
        $sql = "SELECT * from Emp_Address where Employee_ID=:eid";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':eid', $EID, PDO::PARAM_INT);
        $stmt->execute();

        if($row = $stmt->fetch()){
            return new empA($row['Country'], $row['Block_No'], $row['Unit_No'], 
            $row['Street_Name'], $row['Postal_Code'], $row['Employee_ID'], $row['CREATED_DT'], $row['CREATED_BY'], 
            $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
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
            $data = $_SESSION['eid'];
            $result = retrieveByEID($data);

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