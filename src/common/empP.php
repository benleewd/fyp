<?php

class empP
{
    public $eid;
    public $payFreq;
    public $payType;
    public $basicPay;
    public $dayShiftRate;
    public $nightShiftRate;
    public $cpfEntitled;
    public $fundDonation;
    public $payMode;
    public $empBank;
    public $accNo;
    public $noticePeriod;
    public $remarks;
    public $createdDT;
    public $createdBy;
    public $lastModDT;
    public $lastModBy;


    public function __construct($payFreq="", $payType="", $basicPay="", $dayShiftRate="", $nightShiftRate="", $cpfEntitled="", 
    $fundDonation="", $payMode="", $empBank="", $accNo="", $noticePeriod="", $remarks="", $eid="", 
    $createdDT="", $createdBy="", $lastModDT="", $lastModBy="")
    {
        $this->eid = $eid;
        $this->payFreq = $payFreq;
        $this->payType = $payType;
        $this->basicPay = $basicPay;
        $this->dayShiftRate = $dayShiftRate;
        $this->nightShiftRate = $nightShiftRate;
        $this->cpfEntitled = $cpfEntitled;
        $this->fundDonation = $fundDonation;
        $this->payMode = $payMode;
        $this->empBank = $empBank;
        $this->accNo = $accNo;
        $this->noticePeriod = $noticePeriod;
        $this->remarks = $remarks;
        $this->createdDT = $createdDT;
        $this->createdBy = $createdBy;
        $this->lastModDT = $lastModDT;
        $this->lastModBy = $lastModBy;
    }

}




?>