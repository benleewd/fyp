<?php
//include connection file 
include "../../../common/common.php";
include '../../../static/libs/fpdf/fpdf.php';

if (!isset($_GET["eid"])) {
    echo "Please go back to the employee page and try again.";
    exit;
}

$empID = $_GET['eid'];
 
function retrieveBasicInfoByEID($EID) {
    $sql = "SELECT * from Emp_Basic_Information where Employee_ID=:eid";

    $connMgr = new connectionManager();
    $conn = $connMgr->getConnection();

    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(':eid', $EID, PDO::PARAM_INT);
    $stmt->execute();

    if ($row = $stmt->fetch()){
        return new empB($row['First_Name'], $row['Last_Name'], $row['Gender'], $row['Marital_Status'], $row['Date_Of_Birth'], 
        $row['Nationality'], $row['Religion'], $row['Race'], $row['Blood_Group'], $row['Place_Of_Birth'], $row['Identification_Type'], 
        $row['Identification_No'], $row['Pass_Type'], $row['Highest_Qualification'], $row['Mobile_No'], $row['Email'], $row['Employee_ID'], 
        $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
    }

    return null;
}

function retrieveAddressByEID($EID)
{
    $sql = "SELECT * from Emp_Address where Employee_ID=:eid";

    $connMgr = new connectionManager();
    $conn = $connMgr->getConnection();

    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(':eid', $EID, PDO::PARAM_INT);
    $stmt->execute();

    if($row = $stmt->fetch()){
        return new empA($row['Country'], $row['Block_No'], $row['Unit_No'], 
        $row['Street_Name'], $row['Postal_Code'], $row['Employee_ID'], $row['CREATED_DT'], $row['CREATED_BY'], 
        $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
    }

    return null;
}

function retrieveContactByEID($EID)
{
    $sql = "SELECT * from Emp_Emergency_Contact where Employee_ID=:eid";

    $connMgr = new connectionManager();
    $conn = $connMgr->getConnection();

    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(':eid', $EID, PDO::PARAM_INT);
    $stmt->execute();

    if($row = $stmt->fetch()){
        return new empC($row['Emergency_Contact_Name'], $row['Relationship'], $row['Emergency_Contact_No'], $row['Employee_ID'],
        $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
    }

    return null;
}

function retrieveEmploymentByEID($EID)
{
    $sql = "SELECT * from Emp_Employment_Details where Employee_ID=:eid";

    $connMgr = new connectionManager();
    $conn = $connMgr->getConnection();

    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(':eid', $EID, PDO::PARAM_INT);
    $stmt->execute();

    if($row = $stmt->fetch()){
        return new empE($row['Joining_Date'], $row['Employment_Type'], $row['Contract_Start_Date'], 
        $row['Contract_End_Date'], $row['Probation_Start_Date'], $row['Probation_End_Date'], $row['Confirmation_Date'], 
        $row['Designation'], $row['Department'], $row['Supervisor_ID'], $row['Employee_ID'], $row['CREATED_DT'], $row['CREATED_BY'], 
        $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
    }

    return null;
}

function retrieveLeaveByEID($EID)
{
    $sql = "SELECT * from Emp_Leave_Details where Employee_ID=:eid";

    $connMgr = new connectionManager();
    $conn = $connMgr->getConnection();

    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(':eid', $EID, PDO::PARAM_INT);
    $stmt->execute();

    $result = array();

    while ($row = $stmt->fetch()){
        $result[] = new empL($row['Employee_ID'], $row['Leave_Type'], $row['Days_Remaining'], 
        $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
    }

    return $result;
}

function retrievePayByEID($EID)
{
    $sql = "SELECT * from Emp_Pay_Details where Employee_ID=:eid";

    $connMgr = new connectionManager();
    $conn = $connMgr->getConnection();

    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(':eid', $EID, PDO::PARAM_INT);
    $stmt->execute();

    if($row = $stmt->fetch()){
        return new empP($row['Pay_Frequency'], $row['Pay_Type'], $row['Basic_Pay'], 
        $row['Day_Shift_Rate'], $row['Night_Shift_Rate'], $row['CPF_Entitled'], $row['Fund_Donation'], 
        $row['Pay_Mode'], $row['Employee_Bank'], $row['Account_No'], $row['Notice_Period'], $row['Remarks'], $row['Employee_ID'], 
        $row['CREATED_DT'], $row['CREATED_BY'], $row['LAST_MODIFIED_DT'], $row['LAST_MODIFIED_BY']);
    }

    return null;
}

class PDF extends FPDF {
    // Page header
    
    function Header() {
        
        if ( $this->PageNo() == 1 ) {
            // Logo
            // $this->Image('../../../img/employee.png',10,10,10);
            $this->SetFont('Arial','B',16);
            // Move to the right
            // $this->Cell(15);
            // Title
            $this->SetLeftMargin(15);
            $this->SetRightMargin(15);
            $this->Cell(0,20,'Key Employment Terms',0,0,'L');
            $this->SetFont('Arial','',12);
            $this->Cell(0,20,'Issued on:' . date("d/m/Y"),0,0,'R');
            // Line break
            $this->Ln(10);
            $this->SetFont('Arial','',10);
            $this->Cell(0,10,'All fields are mandatory, unless they are not applicable.',0,0,'L');
            $this->Cell(0,10,'All information accurate as of issurance date',0,1,'R');
            // Line break
            // $this->Ln(20);

        }
    }
 
    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function myCell($w, $h, $x, $t) {
        $height = $h/3;
        $first = $height + 2;
        $second = $height + $height + $height + 3;
        $len = strlen($t);
        if ($len>24) {
            $txt = str_split($t, 23);
            $this->SetX($x);
            $this->Cell(0, $first, $txt[0], "", "", "");
            $this->SetX($x);
            $this->Cell(0, $second, $txt[1], "", "", "");
            $this->SetX($x);
            $this->Cell($w, $h, "", "LTRB", 0, "L");
        } else {
            $this->SetX($x);
            $this->Cell($w, $h, $t, "LTRB", 0, "L");
        }
    }
}
 
$pdf = new PDF();
$pdf->SetAutoPageBreak(true, 9);
//header
$pdf->AddPage('P');
//foter page
$pdf->AliasNbPages();
$pdf->SetLeftMargin(15);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0, 10, 'Section A | Details of Employment',0, 2, 'L', true);
$pdf->SetTextColor(0,0,0);

// $pdf->Ln(10);

$w = 45;
$h = 10;
$counter = 0;

// Basic Page
$empBasicData = array("First Name" => "firstName", "Last Name" => "lastName", "Gender" => "gender", 
                    "Marital Status" => "maritalStatus", "Date of Birth" => "dob", "Nationality" => "nationality",
                    "Religion" => "religion", "Race" => "race", "Blood Group" => "bloodGroup", "Place of Birth" => "placeOfBirth",
                    "ID Type" => "idType", "ID No." => "idNo", "Pass Type" => "passType", "Highest Qualification" => "highestQual",
                    "Mobile No." => "mobileNo", "Email" => "email");
 
$resultB = retrieveBasicInfoByEID($empID);

$empAddressData = array("Country" => "country", "Block No." => "blockNo", "Unit No." => "unitNo", 
"Street Name" => "streetName", "Postal Code" => "postalCode");

$resultA = retrieveAddressByEID($empID);

$empContactData = array("Emergency Contact Person" => "emergencyCN", "Relationship" => "relationship",
"Emergency Contact No." => "emergencyCD");

$resultC = retrieveContactByEID($empID);

$empEmploymentData = array("Join Date" => "joinDate", "Employment Type" => "empType",
"Contract Start Date" => "contractSD", "Contract End Date" => "contractED",
"Probation Start Date" => "probationSD", "Probation End Date" => "probationED",
"Confirmed Date" => "confirmDate", "Designation" => "designation",
"Department" => "department", "Supervisor ID" => "supervisorID");

$resultE = retrieveEmploymentByEID($empID);

$empLeaveData = array("Leave Type" => "leaveType", "Days Remaining" => "daysRemaining");

$resultL = retrieveLeaveByEID($empID);

$empPayData = array("Pay Frequency" => "payFreq", "Pay Type" => "payType",
"Basic Pay" => "basicPay", "Day Shift Rate" => "dayShiftRate",
"Night Shift Rate" => "nightShiftRate", "CPF Entitled" => "cpfEntitled",
"Fund Donation" => "fundDonation", "Payment Mode" => "payMode",
"Bank" => "empBank", "Account No." => "accNo", "Notice Period" => "noticePeriod", 
"Remarks" => "remarks");

$resultP = retrievePayByEID($empID);



$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Company Name");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"K11 Security Engineering Pte Ltd");

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Job Title, Main Duties and Responibilities");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, $resultE->designation);

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Employee Name");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, $resultB->lastName . " " . $resultB->firstName);

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell(90,$h,$x, $resultE->empType);

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Employee NRIC/FIN");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, $resultB->idNo);

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
// $pdf->myCell($w,$h/2,$x, "Duration of Employment");
// $pdf->Cell($w, $h/4, '','LRT', 1, 'L');
$pdf->Cell($w, $h/3, 'Duration of Employment','LRT', 0, 'L');
$y = $pdf->GetY();
$pdf->SetY($y*1.08);
$x = $pdf->GetX();
$pdf->SetX($x*7);
$pdf->SetFont('Arial','',8);
$pdf->Cell($w, $h/4, '(only for employees on fixed term ','LR', 1, 'L');
$x = $pdf->GetX();
$pdf->SetX($x*7);
$pdf->Cell($w, $h/4, 'contract)','LRB', 0, 'L');
// $pdf->myCell($w,$h/2,$x, "(only for employees on fixed term contract)");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->SetY($y);
$pdf->myCell($w,$h,$x, "");

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Employee Start date");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, $resultE->contractSD);

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
// $pdf->myCell($w,$h/3,$x, "Place of Work");
$pdf->Cell($w, $h/3, 'Place of Work','LRT', 0, 'L');
$y = $pdf->GetY();
$pdf->SetY($y*1.075);
$x = $pdf->GetX();
$pdf->SetX($x*7);
$pdf->SetFont('Arial','',8);
$pdf->Cell($w, $h/4, "(if different from company's ",'LR', 1, 'L');
$x = $pdf->GetX();
$pdf->SetX($x*7);
$pdf->Cell($w, $h/4, 'registered address)','LRB', 0, 'L');

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->SetY($y);
$pdf->myCell($w,$h,$x, "");

// foreach($empBasicData as $heading => $value) {
//     if ($counter == 2) {
//         $pdf->Ln();
//         $counter = 0;
//     }
//     $counter += 1;
    
//     $pdf->SetDrawColor(199,199,197);

//     $pdf->SetFont('Arial','B',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$heading . ":");

//     $pdf->SetFont('Arial','',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$result->$value);

// }

//Basic Page end

//Address Page
// $pdf->AddPage('P');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0, 10, 'Section B | Working Hours and Rest Days',0, 2, 'L', true);
$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','B',11);
// $x = $pdf->GetX();
$pdf->Cell(90,$h,'Details of Working Hours','LRT',0,'L');

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "Number of Working      Days per week");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "7 Days per week");

$pdf->Ln();

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Cell(90,$h/3,'Start and End Time: ','LR',1,'L');
$pdf->Cell(90,$h/3,'Break: ','LR',1,'L');
$pdf->Cell(90,$h/3,'Start and End Time: ','LR',1,'L');
$pdf->Cell(90,$h/4,'','BLR',0,'L');

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->SetY($y);
// $pdf->Cell($w,$h,'Rest Days per week','LRTB',0,'L');
$pdf->myCell($w,$h,$x, "Rest Days per week");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->Cell($w,$h,'1 Day per week','LRTB',0,'L');
// $pdf->myCell($w,$h,$x, "1 Day per week");


// $counter = 0;


// foreach($empAddressData as $heading => $value) {
//     if ($counter == 2) {
//         $pdf->Ln();
//         $counter = 0;
//     }
//     $counter += 1;
    
//     $pdf->SetFont('Arial','B',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$heading);

//     $pdf->SetFont('Arial','',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$result->$value);

// }
//Address Page end

//Contact Page
// $pdf->AddPage('P');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0, 10, 'Section C | Salary',0, 2, 'L', true);
$pdf->SetTextColor(0,0,0);
// $pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h * 2,$x,"Salary Period");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h * 2,$x, $resultP->payFreq);

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Date(s) of Salary      Payment");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"");

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x*7, "Date(s) of Overtime    Payment");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"");

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h * 2,$x,"Overtime Payment       Period");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h * 2,$x, "");


$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Basic Salary (Per Period) ");
$pdf->SetFont('Arial','',11);
$pdf->myCell($w,$h,$x * 1.43,$resultP->basicPay);

// $pdf->SetFont('Arial','',11);
// $x = $pdf->GetX();
// $pdf->myCell($w,$h,$x, $resultP->basicPay);
$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x * 7,"Overtime Rate of Pay: ");
$pdf->SetFont('Arial','',11);
$pdf->myCell($w,$h,$x * 1.43 * 7,"");

// $pdf->Ln();

// $pdf->SetFont('Arial','B',11);
// $x = $pdf->GetX();
// $pdf->myCell($w,$h,$x2,"Overtime Rate of Pay: ");

// $pdf->SetFont('Arial','',11);
// $x = $pdf->GetX();
// $pdf->myCell($w,$h,$x, "");


// $counter = 0;

// foreach($empContactData as $heading => $value) {
//     if ($counter == 2) {
//         $pdf->Ln();
//         $counter = 0;
//     }
//     $counter += 1;
    
//     $pdf->SetFont('Arial','B',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$heading);

//     $pdf->SetFont('Arial','',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$result->$value);

// }
//Contact Page end

//Employment Page
// $pdf->AddPage('P');
$pdf->Ln();
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0, 10, 'Fixed Allowance Per Salary Period',0, 0, 'L', true);
$pdf->Cell(0, 10, 'Fixed Deductions Per Salary Period',0, 2, 'R', true);
$pdf->SetTextColor(0,0,0);
// $pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
// $x = $pdf->SetX(15);
// $pdf->Cell($w, $h, 'Item','BL', 2, 'C');
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x/100*7.7, "Item");

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "Allowance($)");
// $pdf->Cell($w, $h, 'Allowance($)','BR', 2, 'C');

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "Item");

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "Deduction($)");

$pdf->Ln();

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "Total Fixed Allowances");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "0.00");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "Total Fixed Deductions");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "0.00");

$pdf->Ln();

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "Other Salary Related   Components");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "CPF Contributions      Payable");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
if ($resultP->cpfEntitled > 0) {
    $pdf->myCell($w,$h,$x, "Yes");
} else {
    $pdf->myCell($w,$h,$x, "No");
}


// $counter = 0;

// $empEmploymentData = array("Join Date" => "joinDate", "Employment Type" => "empType",
//                     "Contract Start Date" => "contractSD", "Contract End Date" => "contractED",
//                     "Probation Start Date" => "probationSD", "Probation End Date" => "probationED",
//                     "Confirmed Date" => "confirmDate", "Designation" => "designation",
//                     "Department" => "department", "Supervisor ID" => "supervisorID");
 
// $result = retrieveEmploymentByEID($empID);

// foreach($empEmploymentData as $heading => $value) {
//     if ($counter == 2) {
//         $pdf->Ln();
//         $counter = 0;
//     }
//     $counter += 1;
    
//     $pdf->SetFont('Arial','B',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$heading);

//     $pdf->SetFont('Arial','',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$result->$value);

// }
//Employment Page end

//Leave Page
// $pdf->AddPage('P');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0, 10, 'Section D | Leave and Medical Bills',0, 2, 'L', true);
$pdf->SetTextColor(0,0,0);
// $pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Types of Leave");

foreach ($resultL as $leaveType) {
    foreach($empLeaveData as $heading => $value) {
        if ($heading == "Leave Type") {
            $pdf->SetFont('Arial','',11);
            $x = $pdf->GetX();
            $pdf->myCell($w,$h,$x,$leaveType->$value);
        }
    }
}

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Other Types of Leaves");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"");

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Paid Annual Leave Per  First Year");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"14 days");

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Paid Annual Leave Per  Second Year");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"14 days");

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Paid Outpatient Sick   Leave Per Year");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"14 days");

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Paid Medical           Examination Fee");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"0");

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();

$pdf->myCell($w,$h,$x,"Paid Hosipitalisation  Leave Per Year");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();

$pdf->myCell($w,$h,$x,"60 days");

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
// $pdf->SetY($y);
$pdf->Cell($w*2, $h, '','TLR', 0);
// $pdf->myCell($w*2,$h*2,$x,"");

// $pdf->SetFont('Arial','',11);
// $x = $pdf->GetX();

// $pdf->myCell($w,$h*2,$x,"");

$pdf->Ln();

$pdf->SetFont('Arial','I',8);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Cell(90, $h/3, '(note that paid hospitalisation per year is inclusive of outpatient sick','LR', 1, 'L');
$pdf->Cell(90, $h/3, 'leave. Leave entitlement for part time employees may be pro-rated','LR', 1, 'L');
$pdf->Cell(90, $h/3, 'based on hours.)','BLR', 0, 'L');

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->SetY($y);
$pdf->SetX($x);
$pdf->Cell($w*2, $h, '','BLR', 0);
// $pdf->Cell($w*2, $h, '','BLR', 0, 'L');
// $pdf->myCell($w*2,$h,$x,"");

// $pdf->SetFont('Arial','',11);
// $x = $pdf->GetX();
// $pdf->myCell($w,$h,$x,"");

// $w = 45;
// $h = 10;

// $empLeaveData = array("Leave Type" => "leaveType", "Days Remaining" => "daysRemaining");
 
// $result = retrieveLeaveByEID($empID);

// foreach($empLeaveData as $heading => $value) {
//     $pdf->SetFont('Arial','B',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$heading);
// }

// foreach ($resultL as $leaveType) {
//     foreach($empLeaveData as $heading => $value) {
//         if ($heading == "Leave Type") {
//             $pdf->SetFont('Arial','',11);
//             $x = $pdf->GetX();
//             $pdf->myCell($w,$h,$x,$leaveType->$value);
//         }
//     }
// }

//Leave Page end

//Payment Page
// $pdf->AddPage('P');
$pdf->Ln();
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0, 10, 'Section E | Others',0, 2, 'L', true);
$pdf->SetTextColor(0,0,0);
// $pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Probation Start Date");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, $resultE->probationSD);

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->Cell(90, $h, 'Notice Period for Termination of Employment','TLRB', 0, 'L');
// $pdf->myCell($w*2,$h,$x,"Notice Period for Termination of Employment");

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Probation End Date");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, $resultE->probationED);

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell(90,$h,$x,$resultP->noticePeriod);

$pdf->Ln();

$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,"Length of Probation");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x, "");

$pdf->SetFont('Arial','',11);
$x = $pdf->GetX();
$pdf->myCell(90,$h,$x, "");

// $w = 45;
// $h = 10;
// $counter = 0;

// $empPayData = array("Pay Frequency" => "payFreq", "Pay Type" => "payType",
//                     "Basic Pay" => "basicPay", "Day Shift Rate" => "dayShiftRate",
//                     "Night Shift Rate" => "nightShiftRate", "CPF Entitled" => "cpfEntitled",
//                     "Fund Donation" => "fundDonation", "Payment Mode" => "payMode",
//                     "Bank" => "empBank", "Account No." => "accNo", "Notice Period" => "noticePeriod", 
//                     "Remarks" => "remarks");
 
// $result = retrievePayByEID($empID);

// foreach($empPayData as $heading => $value) {
//     if ($counter == 2) {
//         $pdf->Ln();
//         $counter = 0;
//     }
//     $counter += 1;
    
//     $pdf->SetFont('Arial','B',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$heading);

//     $pdf->SetFont('Arial','',11);
//     $x = $pdf->GetX();
//     $pdf->myCell($w,$h,$x,$result->$value);

// }
//Contact Page end

$pdf->Output();
?>