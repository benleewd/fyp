<?php
    include "../../common/commonAPI.php";

    function update($newEmpID, $year, $month, $day, $siteID, $shift, $originalEmpID, $eid)
    {
        $sql = "UPDATE schedule set Employee_ID=:newEmpID, LAST_MODIFIED_BY=:lastModifiedBy 
                where Year=:year and Month=:month and Day=:day and Site_ID=:siteID and Shift=:shift and Employee_ID=:originalEmpID";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':newEmpID', $newEmpID , PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':day', $day, PDO::PARAM_INT);
        $stmt->bindParam(':siteID', $siteID, PDO::PARAM_INT);
        $stmt->bindParam(':shift', $shift, PDO::PARAM_STR);
        $stmt->bindParam(':originalEmpID', $originalEmpID, PDO::PARAM_INT);
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
            $newEmpID = $_PUT['newEmpID'];
            $year = $_PUT['year'];
            $month = $_PUT['month'];
            $day = $_PUT['day'];
            $siteID = $_PUT['siteID'];
            $shift = $_PUT['shift'];
            $originalEmpID = $_PUT['originalEmpID'];
            $eid = $_SESSION['eid'];
            $result = update($newEmpID, $year, $month, $day, $siteID, $shift, $originalEmpID, $eid);

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