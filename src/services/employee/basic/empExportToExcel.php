<?php

include "../../../common/common.php";
 
function retrieveAllBasic()
    {
        $sql = "SELECT * from Emp_Basic_Information";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] = new empB($row['First_Name'], $row['Last_Name'], $row['Gender'], $row['Marital_Status'], $row['Date_Of_Birth'], 
            $row['Nationality'], $row['Religion'], $row['Race'], $row['Blood_Group'], $row['Place_Of_Birth'], $row['Identification_Type'], 
            $row['Identification_No'], $row['Pass_Type'], $row['Highest_Qualification'], $row['Mobile_No'], $row['Email'], $row['Employee_ID'], 
            $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
        }

        return $result;
    }

    function retrieveAllAddress()
    {
        $sql = "SELECT * from Emp_Address";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] = new empA($row['Country'], $row['Block_No'], $row['Unit_No'], $row['Street_Name'], 
            $row['Postal_Code'], $row['Employee_ID'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
        }

        return $result;
    }

    function retrieveAllContact()
    {
        $sql = "SELECT * from Emp_Emergency_Contact";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] = new empC($row['Emergency_Contact_Name'], $row['Relationship'], $row['Emergency_Contact_No'], $row['Employee_ID'],
            $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
        }

        return $result;
    }

    function retrieveAllEmployment()
    {
        $sql = "SELECT * from Emp_Employment_Details";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] = new empE($row['Joining_Date'], $row['Employment_Type'], $row['Contract_Start_Date'], $row['Contract_End_Date'], 
            $row['Probation_Start_Date'], $row['Probation_End_Date'], $row['Confirmation_Date'], $row['Designation'], $row['Department'], 
            $row['Supervisor_ID'], $row['Employee_ID'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
        }

        return $result;
    }

    function retrieveAllLeave()
    {
        $sql = "SELECT * from Emp_Leave_Details";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] = new empL($row['Employee_ID'], $row['Leave_Type'], $row['Days_Remaining'], 
            $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
        }

        return $result;
    }

    function retrieveAllPayment()
    {
        $sql = "SELECT * from Emp_Pay_Details";

        $connMgr = new connectionManager();
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();

        while($row = $stmt->fetch())
        {
            $result[] = new empP($row['Pay_Frequency'], $row['Pay_Type'], $row['Basic_Pay'], $row['Day_Shift_Rate'], $row['Night_Shift_Rate'], 
            $row['CPF_Entitled'], $row['Fund_Donation'], $row['Pay_Mode'], $row['Employee_Bank'], $row['Account_No'], $row['Notice_Period'], 
            $row['Remarks'], $row['Employee_ID'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
        }

        return $result;
    }

$resultB = retrieveAllBasic();

$resultA = retrieveAllAddress();

$resultC = retrieveAllContact();

$resultE = retrieveAllEmployment();

$resultL = retrieveAllLeave();

$resultP = retrieveAllPayment();

function cleanData(&$str)
{
  $str = preg_replace("/\t/", "\\t", $str);
  $str = preg_replace("/\r?\n/", "\\n", $str);
  if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// filename for download

$filename = "K11_Security_Employee_Excel" . ".xlsx";

require '../../../static/libs/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

header("Content-Disposition: attachment; filename=\"$filename\"");  
header("Content-Type: application/ms-excel");
header('Cache-Control: max-age=0');

ob_clean();
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//Start of storing and writing headers to excel 
$dataBasic = $resultB[0];
$dataAddress = $resultA[0];
$dataContact = $resultC[0];
$dataEmployment = $resultE[0];
$dataLeave = $resultL[0];
$dataPay = $resultP[0];
$heading = [];
$unwantedHeadings = ['createdDT', 'createdBy', 'lastModDT', 'lastModBy'];
$unwantedHeadingsForBasicInfo = ['address', 'contact', 'emp', 'pay'];

foreach($dataBasic as $key=>$value){
    if (!(in_array($key, $unwantedHeadings)) && (!(in_array($key, $unwantedHeadingsForBasicInfo)))) {
        array_push($heading,$key);
    }
}  

foreach($dataAddress as $key=>$value){
    if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
        array_push($heading,$key);
    }
}

foreach($dataContact as $key=>$value){
    if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
        array_push($heading,$key);
    }
}

foreach($dataEmployment as $key=>$value){
    if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
        array_push($heading,$key);
    }
}

foreach($dataLeave as $key=>$value){
    if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
        array_push($heading,$key);
    }
}

foreach($dataPay as $key=>$value){
    if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
        array_push($heading,$key);
    }
}

$spreadsheet->getActiveSheet()->fromArray($heading,NULL,'A1');

// //End of storing and writing headers to excel 

//Start of writing data to excel 
$dataBasicAll = $resultB;
$dataAddressAll = $resultA;
$dataContactAll = $resultC;
$dataEmploymentAll = $resultE;
$dataLeaveAll = $resultL;
$dataPayAll = $resultP;
$empArr = [];
$storeEid = [];

foreach ($dataBasicAll as $arr){
    array_push($storeEid, $arr->eid);
}

foreach ($storeEid as $arr){
    $empVal = [];
    foreach($dataBasicAll as $add){
        if ($add->eid == $arr) {
            foreach($add as $key=>$value) {
                if (!(in_array($key, $unwantedHeadings)) && $value != null) {
                    array_push($empVal,$value);
                }
            }
        }
    }
    foreach($dataAddressAll as $add){
        if ($add->eid == $arr) {
            foreach($add as $key=>$value) {
                if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
                    array_push($empVal,$value);
                }
            }
        }
    }
    foreach($dataContactAll as $con){
        if ($con->eid == $arr) {
            foreach($con as $key=>$value) {
                if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
                    array_push($empVal,$value);
                }
            }
        }
    }
    foreach($dataEmploymentAll as $emp){
        if ($emp->eid == $arr) {
            foreach($emp as $key=>$value) {
                if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
                    array_push($empVal,$value);
                }
            }
        }
    }
    foreach($dataLeaveAll as $leave){
        if ($leave->eid == $arr) {
            foreach($leave as $key=>$value) {
                if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
                    array_push($empVal,$value);
                }
            }
        }
    }
    foreach($dataPayAll as $pay){
        if ($pay->eid == $arr) {
            foreach($pay as $key=>$value) {
                if (!(in_array($key, $unwantedHeadings)) && $key != 'eid') {
                    array_push($empVal,$value);
                }
            }
        }
    }
    array_push($empArr, $empVal);
}

$spreadsheet->getActiveSheet()->fromArray($empArr,NULL,'A2');

//End of writing data to excel 
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

exit();

?>