<?php

class empB
{
    public $eid;
    public $firstName;
    public $lastName;
    public $gender;
    public $maritalStatus;
    public $dob;
    public $nationality;
    public $religion;
    public $race;
    public $bloodGroup;
    public $placeOfBirth;
    public $idType;
    public $idNo;
    public $passType;
    public $highestQual;
    public $mobileNo;
    public $email;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;
    public $address;
    public $contact;
    public $emp;
    public $pay;

    public function __construct($firstName="", $lastName="", $gender="", $maritalStatus="",
    $dob="", $nationality="", $religion="", $race="", $bloodGroup="", $placeOfBirth,
    $idType="", $idNo="", $passType="", $highestQual="", $mobileNo="", $email="", $eid="", 
    $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->eid = $eid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->maritalStatus = $maritalStatus;
        $this->dob = $dob;
        $this->nationality = $nationality;
        $this->religion = $religion;
        $this->race = $race;
        $this->bloodGroup = $bloodGroup;
        $this->placeOfBirth = $placeOfBirth;
        $this->idType = $idType;
        $this->idNo = $idNo;
        $this->passType = $passType;
        $this->highestQual = $highestQual;
        $this->mobileNo = $mobileNo;
        $this->email = $email; 
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }

    public function setEmployeeDetails($address="", $contact="", $emp="", $pay="")
    {
        $this->address = $address;
        $this->contact = $contact;
        $this->emp = $emp;
        $this->pay = $pay;
    }

}



?>