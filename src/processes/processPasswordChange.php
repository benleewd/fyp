<?php
    include '../common/commonProcesses.php';

    if (isset($_POST['password']) && isset($_POST['passwordConfirm'])){
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];

        if ($password == $passwordConfirm) {
            $sql = "UPDATE Login_Access SET
                Password_Hashed=:passwordHashed, LAST_MODIFIED_BY=:lastModifiedBy
                where Employee_ID=:employeeID";

            $connMgr = new connectionManager();
            $conn = $connMgr->getConnection();

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':employeeID', $_SESSION['eid'] , PDO::PARAM_INT);
            $stmt->bindParam(':passwordHashed', password_hash($password, PASSWORD_DEFAULT)  , PDO::PARAM_STR);
            $stmt->bindParam(':lastModifiedBy', $eid , PDO::PARAM_INT);

            $stmt->execute();

            $count = $stmt->rowCount();

            if ($_SESSION['designation'] == "Management") {
                header("Location: ../index.php");
            } else {
                header("Location: ../indexEmployee.php");
            }
        } else {
            $_SESSION['errors'] = "Passwords do not match. Please re-enter.";
            header("Location: ../changePassword.php");
        }
        
    }
?>