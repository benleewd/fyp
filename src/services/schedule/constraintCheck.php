<?php
    // error_reporting(E_ERROR | E_PARSE);
    include "../../common/commonAPI.php";

    function verifySchedule($year, $month, $day, $eid)
    {
        $sql = "SELECT * from Schedule where Year=:year and Month=:month and Day=:day and Employee_ID=:eid";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':day', $day, PDO::PARAM_INT);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->execute();

        if($row = $stmt->fetch()){
            return true;
        }

        return false;
    }

    function verifyLeave($dateCheck, $eid) {
        $sql = "SELECT * from leave_application where From_Date <= :dateCheck and To_Date >= :dateCheck and Employee_ID=:eid";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':dateCheck', $dateCheck, PDO::PARAM_INT);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->execute();

        if($row = $stmt->fetch()){
            return true;
        }

        return false;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");

        //Connect DB and get data
        try {
            $year = $_GET['year'];
            $month = $_GET['month'];
            $day = $_GET['day'];
            $eid = $_GET['eid'];
            $dateCheck = $year . "-" . $month . "-" . $day;
            $result = false;
            if (verifySchedule($year, $month, $day, $eid) || verifyLeave($dateCheck, $eid)) {
                $result = true;
            }

            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "All data retrieved successfully.", $result);
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