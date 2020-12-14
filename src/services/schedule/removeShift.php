<?php
    include "../../common/commonAPI.php";

    function delete($year, $month, $siteID)
    {
        $sql = 'DELETE from Schedule where Year=:year and Month=:month and Site_ID=:siteID';
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':siteID', $siteID, PDO::PARAM_INT);
        
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");

        //Connect DB and get data
        try {
            parse_str(file_get_contents("php://input"),$_DELETE);
            $year = $_DELETE['year'];
            $month = $_DELETE['month'];
            $siteID = $_DELETE['siteID'];
            $result = delete($year, $month, $siteID);
            
            if ($result) {
                //Set response code
                http_response_code(200);

                //Standard json to return
                $json = new json(200, "Data deleted successfully.");
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
        header("Access-Control-Allow-Methods: DELETE");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>