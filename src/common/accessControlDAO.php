<?php

class accessControlDAO
{
    public function verifyAccess($designation, $page, $type)
    {
        try {
            $sql = "SELECT `Accessible` from Access_Right 
            where Designation=:designation and Page_Access=:pageAccess and `Type`=:type";

            $connMgr = new connectionManager();
            $conn = $connMgr->getConnection();

            $stmt = $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':designation', $designation, PDO::PARAM_STR);
            $stmt->bindParam(':pageAccess', $page, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->execute();

            if($row = $stmt->fetch()){
                return $row["Accessible"];
            }

            return false;
        } catch (Exception $e) {
            return false;
        }
        
    }
    
    
}

?>