<?php
    include "../../common/commonAPI.php";

    function update($site, $eid)
    {
        $sql = "UPDATE Site SET
                Project_Name=:projectName, Shifts=:shifts, Public_Holiday=:publicHoliday, Site_Allowance=:siteAllowance, Employees_Required=:employeesRequired, Address=:address, Longitude=:long, Latitude=:lat, Active=:active, LAST_MODIFIED_BY=:lastModifiedBy
                where Project_ID=:projectID";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':projectID', $site->projectID , PDO::PARAM_INT);
        $stmt->bindParam(':projectName', $site->projectName, PDO::PARAM_STR);
        $stmt->bindParam(':shifts', $site->shifts, PDO::PARAM_STR);
        $stmt->bindParam(':publicHoliday', $site->publicHoliday, PDO::PARAM_BOOL);
        $stmt->bindParam(':siteAllowance', $site->siteAllowance, PDO::PARAM_STR);
        $stmt->bindParam(':address', $site->address, PDO::PARAM_STR);
        $stmt->bindParam(':long', $site->long, PDO::PARAM_STR);
        $stmt->bindParam(':lat', $site->lat, PDO::PARAM_STR);
        $stmt->bindParam(':employeesRequired', $site->employeesRequired, PDO::PARAM_INT);
        $stmt->bindParam(':active', $site->active, PDO::PARAM_BOOL);
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
            $data = json_decode($_PUT['data']);
            $eid = $_SESSION['eid'];
            $result = update($data, $eid);

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