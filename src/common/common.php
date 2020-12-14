<?php

spl_autoload_register(function($class) {
 
    $path =  $class . ".php";
    require $path; 
  
});

session_start();

if (isset($_SESSION['sessionTimeout'])) {
    if (time() > $_SESSION['sessionTimeout']) {
        //Change when deploying
        header("Location: /Error-404-FYP/HRClicks/src/login.php");
    } else if ($_SESSION['sessionTimeout'] - time() <= 60*30) {
        //set about to timeout message. Prompt user to log in again
        $_SESSION['timeout'] = "Your session will end in 30 minutes. Click the 'Stay Connected' button to continue this session.";
    } 
} else {
    //Change when deploying
    header("Location: /Error-404-FYP/HRClicks/src/login.php");
}

if (isset($_SESSION['eid']) && isset($_SESSION['designation'])) {
    //Get Current file name
    $currentFileName = basename($_SERVER['PHP_SELF']);
    $accessControlDAO = new accessControlDAO;
    $allowAccess = $accessControlDAO->verifyAccess($_SESSION['designation'], $currentFileName, "Webpage");
    if (!$allowAccess) {
        //Change when deploying 
        header("Location: /Error-404-FYP/HRClicks/src/unauthorisedAccess.html");    
    }
} else {
    //Change when deploying
    header("Location: /Error-404-FYP/HRClicks/src/login.php");
}

include "commonFunctions.php"

?>