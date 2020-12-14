<?php
spl_autoload_register(function($class) {
 
    $path =  $class . ".php";
    require $path; 
  
});

session_start();

$doNotHandle = false;
if ((isset($_GET['API']) && $_GET['API'] == "Error404") || (isset($_POST['API']) && $_POST['API'] == "Error404")) {
    $doNotHandle = true;
}

if (!$doNotHandle) {
    if (!isset($_SESSION['eid']) || !isset($_SESSION['designation']) ) {
        header("Access-Control-Allow-Methods: GET");
    
        //Set response code
        http_response_code(403);
    
        //Standard json to return
        $json = new json(403, "Forbidden.");
        echo json_encode($json);
        exit();
    } else {
        //Get Current file name
        $currentFileName = basename($_SERVER['PHP_SELF']);
        $directoryArr = explode("\\", getcwd());
        $module = end($directoryArr);
        $filetype = $module . "/" . $currentFileName;
        $accessControlDAO = new accessControlDAO;
        $allowAccess = $accessControlDAO->verifyAccess($_SESSION['designation'], $filetype, "API");
        if (!$allowAccess) {
            //Set response code
            http_response_code(403);
    
            //Standard json to return
            $json = new json(403, "Forbidden.");
            echo json_encode($json);
            exit();   
        }
    }
}



?>