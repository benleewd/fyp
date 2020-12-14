<?php
    include "../../common/commonAPI.php";

    function delete($designation)
    {
        $sql = 'DELETE from Access_Right where Designation=:designation';
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':designation', $designation, PDO::PARAM_STR);
        
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    function retrieveUniqueDesignationsUsed()
    {
        $sql = "SELECT DISTINCT Designation from Emp_Employment_Details";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        while($row = $stmt->fetch()){
            $result[] = $row['Designation'] ;
        }

        return $result;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");

        //Connect DB and get data
        try {
            parse_str(file_get_contents("php://input"),$_DELETE);
            $data = $_DELETE['designation'];

            $designationArr = retrieveUniqueDesignationsUsed();

            if ($data == "Management" ) {
                //Set response code
                http_response_code(400);

                //Standard json to return
                $json = new json(400, "Bad request.");
                echo json_encode($json);
            } else if (in_array($data, $designationArr)) {
                //Set response code
                http_response_code(400);

                //Standard json to return
                $json = new json(400, "Bad request. This designation is still used by existing employees");
                echo json_encode($json);
            } else {
                $result = delete($data);
            
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