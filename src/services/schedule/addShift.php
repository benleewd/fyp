<?php
    include "../../common/commonAPI.php";

    function create($year, $month, $siteID, $eid)
    {
        $defaultEID = 1;
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $sql = "SELECT Shifts from Site where Project_ID=:siteID";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':siteID', $siteID, PDO::PARAM_INT);
        $stmt->execute();

        $siteShift = "";

        if($row = $stmt->fetch()){
            $siteShift = $row['Shifts'];
        }

        $siteShiftArr = explode(" and ", $siteShift);

        $noOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $somethingWentWrong = FALSE;
        foreach($siteShiftArr as $siteShift) {
            for ($day = 1; $day <= $noOfDaysInMonth; $day++) {
                $sql = "INSERT INTO schedule (Year, Month, Day, Site_ID, Shift, Employee_ID, CREATED_BY)
                    VALUES
                    (:year, :month, :day, :siteID, :shift, :empID, :createdBy)";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':year', $year, PDO::PARAM_INT);
                $stmt->bindParam(':month', $month, PDO::PARAM_INT);
                $stmt->bindParam(':day', $day, PDO::PARAM_INT);
                $stmt->bindParam(':siteID', $siteID, PDO::PARAM_INT);
                $stmt->bindParam(':shift', $siteShift, PDO::PARAM_STR);
                $stmt->bindParam(':empID', $defaultEID, PDO::PARAM_INT);
                $stmt->bindParam(':createdBy', $eid, PDO::PARAM_INT);

                $success = FALSE;

                if($stmt->execute()){
                    $success = TRUE;
                }

                if (!$success) {
                    $somethingWentWrong = TRUE;
                }
            }
        }

        return $somethingWentWrong;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");

        //Connect DB and get data
        try {
            $year = $_POST['year'];
            $month = $_POST['month'];
            $siteID = $_POST['siteID'];
            $eid = $_SESSION['eid'];
            $result = create($year, $month, $siteID, $eid);

            if (!$result) {
                //Set response code
                http_response_code(200);
    
                //Standard json to return
                $json = new json(200, "Data added successfully.");
                echo json_encode($json);
            } else {
                //Set response code
                http_response_code(500);
    
                //Standard json to return
                $json = new json(500, "Something went wrong.", $year);
                echo json_encode($json);
            }
        } catch (Exception $e) {
            //Set response code
            http_response_code(500);
    
            //Standard json to return
            $json = new json(500, "Something went wrong.", $year);
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