<?php
    include "../../../common/commonAPI.php";

    function delete($EID)
    {   
        $sql = 'delete from Emp_Basic_Information where Employee_ID=:eid';
        
        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':eid', $EID, PDO::PARAM_INT);
        
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");

        try {
            //Connect DB and get data
            parse_str(file_get_contents("php://input"),$_DELETE);
            $data = $_DELETE['employeeID'];
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
        catch (PDOException $e) {
            if ($e->errorInfo[1] == 1451) {
                //Set response code
                http_response_code(400);

                //Standard json to return
                $json = new json(400, "Employee ID is still being used. Unable to delete");
                echo json_encode($json);
            } else {
                //Set response code
                http_response_code(500);

                //Standard json to return
                $json = new json(500, $e->errorInfo[1]);
                echo json_encode($json);
            }
        } 
        catch (Exception $e) {
            //Set response code
            http_response_code(500);

            //Standard json to return
            $json = new json(500, "Something went wrong.");
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