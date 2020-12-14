<?php 
    include "../../common/commonAPI.php";
 
    function retrieveScheduleByMonth($month, $year, $day, $eid, $siteID) {
        $sql = "SELECT * from Schedule where Month=:month and Year=:year and Day=:day and Employee_ID=:eid and Site_ID=:siteID";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':day', $day, PDO::PARAM_INT);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->bindParam(':siteID', $siteID, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();

        while ($row = $stmt->fetch()) {
            $result[] = new schedule($row['Year'], $row['Month'], $row['Day'], $row['Site_ID'], $row['Shift'], $row['Employee_ID'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
        }

        return $result;
    }

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");

        //Connect DB and get data
        try {
            // $month = 2;
            // $year = 2020;
            // $data = json_decode($_GET['data']);
            $month = $_GET['month'];
            $year = $_GET['year'];
            $day = $_GET['day'];
            $eid = $_GET['eid'];
            $siteID = $_GET['siteID'];
            // $month = $data->month;
            // $year = $data->year;
            // $day = $data->day;
            // $eid = $data->eid;
            // $siteID = $data->siteID;

            $result = retrieveScheduleByMonth($month, $year, $day, $eid, $siteID);
           
            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "Schedule generated successfully.", $result);
            echo json_encode($json);
        } catch (Exception $e) {
            //Set response code
            http_response_code(500);
    
            //Standard json to return
            $json = new json(500, "Something went wrong. Perform admin check");
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