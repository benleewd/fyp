<?php
  
    class payment
    {
        public $eid;
        public $month;
        public $year;
        public $payFreq;
        public $payType;
        public $noOfPH;
        public $payAmount;
        public $basicHourlyRate;
        public $OTPerShift;
        public $fromDate;
        public $toDate;
        public $transportCost;
        public $bonus;
        public $status;
        public $createdDT;
        public $createdBy;
        public $lastModDT;
        public $lastModBy;
        public $nric;


        public function __construct($eid="", $month="", $year="", $payFreq="", $payType="", $noOfPH="", $payAmount="", $basicHourlyRate="",
        $OTPerShift="", $fromDate="", $toDate="", $transportCost="", $bonus="", $status="", $createdDT="", $createdBy="", $lastModDT="", $lastModBy="", $nric="")
        {
            $this->eid = $eid;
            $this->month = $month;
            $this->year = $year;
            $this->payFreq = $payFreq;
            $this->payType = $payType;
            $this->noOfPH = $noOfPH;
            $this->payAmount = $payAmount;
            $this->basicHourlyRate = $basicHourlyRate;
            $this->OTPerShift = $OTPerShift;
            $this->fromDate = $fromDate;
            $this->toDate = $toDate;
            $this->transportCost = $transportCost;
            $this->bonus = $bonus;
            $this->status = $status;
            $this->createdDT = $createdDT;
            $this->createdBy = $createdBy;
            $this->lastModDT = $lastModDT;
            $this->lastModBy = $lastModBy;
            $this->nric = $nric;

        }
    }

?>