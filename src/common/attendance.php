<?php
  
    class attendance
    {
        public $eid;
        public $dateCompletedShift;
        public $shiftName;
        public $projectID;
        public $clockIn;
        public $clockOut;
        public $createdDT;
        public $createdBy;
        public $lastModDT;
        public $lastModBy;
        public $nric;
        public $projectName;

        public function __construct($eid="", $dateCompletedShift="", $shiftName="", $projectID="", 
        $clockIn="", $clockOut="", $createdDT="", $createdBy="", $lastModDT="", $lastModBy="", $nric="", $projectName="")
        {
            $this->eid = $eid;
            $this->dateCompletedShift = $dateCompletedShift;
            $this->shiftName = $shiftName;
            $this->projectID = $projectID;
            $this->clockIn = $clockIn;
            $this->clockOut = $clockOut;
            $this->createdDT = $createdDT;
            $this->createdBy = $createdBy;
            $this->lastModDT = $lastModDT;
            $this->lastModBy = $lastModBy;
            $this->nric = $nric;
            $this->projectName = $projectName;
        }
    }

?>