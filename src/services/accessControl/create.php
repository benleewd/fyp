<?php
    include "../../common/commonAPI.php";

    function create($designation, $accessible, $accessControl, $eid)
    {
        $sql = "INSERT into Access_Right 
                (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY)
                values 
                (:designation, :pageAccess, :type, :accessible, :module, :createdBy)";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':designation', $designation , PDO::PARAM_STR);
        $stmt->bindParam(':pageAccess', $accessControl->pageAccess, PDO::PARAM_STR);
        $stmt->bindParam(':accessible', $accessible, PDO::PARAM_BOOL);
        $stmt->bindParam(':module', $accessControl->module, PDO::PARAM_STR);
        $stmt->bindParam(':type', $accessControl->type, PDO::PARAM_STR);
        $stmt->bindParam(':createdBy', $eid , PDO::PARAM_INT);

        $stmt->execute();

        $count = $stmt->rowCount();

        return $count;
    }

    function retrieveUniqueCombinations()
    {
        $sql = "SELECT DISTINCT Page_Access, `Type`, Module from Access_Right";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        while($row = $stmt->fetch()){
            $result[] = new accessControl("", $row['Page_Access'], false, $row['Module'], $row['Type']) ;
        }

        return $result;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");

        //Connect DB and get data
        try {
            $designation = $_POST['designation'];
            $accessible = false;
            $data = retrieveUniqueCombinations();
            $eid = $_SESSION['eid'];
            foreach ($data as $obj) {
                create($designation, $accessible, $obj, $eid);
            }

            //Set response code
            http_response_code(200);

            //Standard json to return
            $json = new json(200, "Data created successfully.");
            echo json_encode($json);
        } catch (Exception $e) {
            //Set response code
            http_response_code(500);

            //Standard json to return
            $json = new json(500, "You might have created a designation with the same name. If not, something went wrong, try again later.");
            echo json_encode($json);
        }
             
    } else {
        header("Access-Control-Allow-Methods: POST");

        //Set response code
        http_response_code(405);

        //Standard json to return
        $json = new json(405, "HTTP request method not allowed.");
        echo json_encode($json);
    }
    
    
?>