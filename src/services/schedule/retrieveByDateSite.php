<?php
    include "../../common/commonAPI.php";

    function retrieveByDateSite($startDate, $endDate, $siteID) {
        $sql = "SELECT Year, Month, Day, Shift, Schedule.Employee_ID, First_Name, Last_Name 
            from Schedule inner join emp_basic_information on Schedule.Employee_ID = emp_basic_information.Employee_ID 
            where Site_ID=:siteID and (";

        while (date('Y-m-d', strtotime($startDate. ' - 1 days')) != $endDate) {
            if ($sql[strlen($sql) - 1] == ")") {
                $sql .= " or ";
            }
            $startDateArr = explode("-", $startDate); 
            $startYear = $startDateArr[0];
            $startMonth = $startDateArr[1];
            $startDay = $startDateArr[2];
            $sql .= " (Year=" . $startYear . " and Month=" . $startMonth . " and Day=" . $startDay . ")";  
            $startDate = date('Y-m-d', strtotime($startDate. ' + 1 days'));
        }

        $sql .= ")";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':siteID', $siteID, PDO::PARAM_INT);
        $stmt->execute();

        $toReturn = array();
        while($row = $stmt->fetch()){
            $month = $row['Month'];
            if (strlen($row['Month']) == 1) {
                $month = "0" . $row['Month'];
            }

            $day = $row['Day'];
            if (strlen($row['Day']) == 1) {
                $day = "0" . $row['Day'];
            }
            $date = $row['Year'] . "-" . $month . "-" . $day;
            if (!isset($toReturn[$row['Shift']])) {
                $toReturn[$row['Shift']] = array();
            }
            if (!isset($toReturn[$row['Shift']][$date])) {
                $toReturn[$row['Shift']][$date] = array();
            }
            array_push($toReturn[$row['Shift']][$date], array("firstName" => $row['First_Name'], "lastName" => $row['Last_Name']));
        }

        return $toReturn;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");

        //Connect DB and get data
        try {
            $startDate = $_GET['startDate'];
            $endDate = $_GET['endDate'];
            $siteID = $_GET['siteID'];
            $result = retrieveByDateSite($startDate, $endDate, $siteID);

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