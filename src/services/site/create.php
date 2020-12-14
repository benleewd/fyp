<?php
    include "../../common/commonAPI.php";

    function create($site, $eid)
    {
        $sql = "INSERT INTO Site
                (Project_Name, Shifts, Public_Holiday, Site_Allowance, Employees_Required, Address, Longitude, Latitude, Active, CREATED_BY)
                VALUES
                (:projectName, :shifts, :publicHoliday, :siteAllowance, :employeesRequired, :address, :long, :lat, :active, :createdBy)";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':projectName', $site->projectName, PDO::PARAM_STR);
        $stmt->bindParam(':shifts', $site->shifts, PDO::PARAM_STR);
        $stmt->bindParam(':publicHoliday', $site->publicHoliday, PDO::PARAM_BOOL);
        $stmt->bindParam(':siteAllowance', $site->siteAllowance, PDO::PARAM_STR);
        $stmt->bindParam(':employeesRequired', $site->employeesRequired, PDO::PARAM_INT);
        $stmt->bindParam(':address', $site->address, PDO::PARAM_STR);
        $stmt->bindParam(':long', $site->long, PDO::PARAM_STR);
        $stmt->bindParam(':lat', $site->lat, PDO::PARAM_STR);
        $stmt->bindParam(':active', $site->active, PDO::PARAM_BOOL);
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
            $eid = $_SESSION['eid'];
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
        header("Access-Control-Allow-Methods: POST");
        header("Content-Type: application/json; charset=UTF-8");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>