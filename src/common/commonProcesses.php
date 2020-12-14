<?php

spl_autoload_register(function($class) {
 
    $path =  $class . ".php";
    require $path; 
  
});

session_start();

include "commonFunctions.php";

?>