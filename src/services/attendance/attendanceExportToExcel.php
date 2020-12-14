<?php

include "../../common/common.php";

function retrieveAll() {
    $sql = "SELECT * from Attendance";

    $connMgr = new connectionManager();
    $conn = $connMgr->getConnection();

    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $result = array();

    while($row = $stmt->fetch())
    {
        $result[] = new attendance($row['Employee_ID'], $row['Date_Completed_Shift'], $row['Shift_Name'], $row['Project_ID'], $row['Clock_In'], $row['Clock_Out'], $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
    }

    return $result;
}

$result = retrieveAll();

function cleanData(&$str)
{
  $str = preg_replace("/\t/", "\\t", $str);
  $str = preg_replace("/\r?\n/", "\\n", $str);
  if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// filename for download
$filename = "K11_Security_Attendance_Excel" . ".xlsx";

require '../../static/libs/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

header("Content-Disposition: attachment; filename=\"$filename\"");  
header("Content-Type: application/ms-excel");
header('Cache-Control: max-age=0');

ob_clean();
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//Start of storing and writing headers to excel 
$data = $result[0];
$heading = [];
$unwantedHeadings = ['createdDT', 'createdBy', 'lastModDT', 'lastModBy', 'nric', 'projectName'];

foreach($data as $key=>$value){
    if (!(in_array($key, $unwantedHeadings))) {
        array_push($heading,$key);
    }
} 

$spreadsheet->getActiveSheet()->fromArray($heading,NULL,'A1');

//End of storing and writing headers to excel 

//Start of writing data to excel 
$dataAll = $result;
$output = [];

foreach($dataAll as $arr){
    $indRow = [];
    foreach ($arr as $key=>$value) {
        if (!(in_array($key, $unwantedHeadings))) {
            array_push($indRow, $value);
        }
    }
    array_push($output, $indRow);
}

$spreadsheet->getActiveSheet()->fromArray($output,NULL,'A2');

//End of writing data to excel 
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

exit();

?>