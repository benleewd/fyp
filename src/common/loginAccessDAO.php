<?php

class loginAccessDao
{

    public function verifyLogin($username, $pw)
    {
        $sql = "SELECT * FROM Login_Access where Username=:username";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $success = -1;

        while($row = $stmt->fetch()){
            if (password_verify($pw, $row['Password_Hashed'])){
                $success = $row['Employee_ID'];
            }
        }
        
        return $success;
    }

    public function getDesignation($eid)
    {
        $sql = "SELECT Designation FROM Emp_Employment_Details where Employee_ID=:eid";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $success = -1;

        while($row = $stmt->fetch()){
            $designation = $row['Designation'];
        }
        
        return $designation;
    }

    public function getNRIC($eid)
    {
        $sql = "SELECT * from Emp_Basic_Information where Employee_ID=:eid";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
        $stmt->execute();

        if($row = $stmt->fetch()){
            return $row['Identification_No'];
        }

        return null;
    }

    
}


?>