<?php
    include "../../common/commonAPI.php";
    include '../../static/libs/phpqrcode/qrlib.php';
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Set headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");

        //Connect DB and get data
        try {
            
            $data = $_POST['projectID'];
            if (!file_exists("../../templates/site/img/$data.png")) {
                QRcode::png($data, "../../templates/site/img/$data.png", "L", 4, 4);
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