<?php

include "../common/commonProcesses.php";
session_destroy();
header("Location: ../login.php");
?>