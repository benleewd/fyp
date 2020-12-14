<?php
    include '../common/commonProcesses.php';

    if (isset($_POST['nric']) && isset($_POST['password'])){
        $nric = $_POST['nric'];
        $pw = $_POST['password'];
        $loginAccess = new loginAccessDAO();
        $verification = $loginAccess->verifyLogin($nric, $pw);
        if ($verification != -1) {
            $_SESSION['eid'] = $verification;
            $_SESSION['designation'] = $loginAccess->getDesignation($verification);
            $_SESSION['sessionTimeout'] = time() + 60*60*12;
            $_SESSION['nric'] = $nric;
            if ($pw == "password") {
                $_SESSION['nric'] = $nric;
                header("Location: ../changePassword.php");
                exit;
            }
            if ($_SESSION['designation'] == "Management") {
                header("Location: ../index.php");
            } else {
                header("Location: ../indexEmployee.php");
            }
            
        } else {
            $_SESSION['errors'] = "Username/Password is wrong. Please re-enter.";
            header("Location: ../login.php");
        }
    }
?>