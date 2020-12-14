<h2>Profile</h2>
<div class="row d-block">
<img src="img/user.png" width=auto height=160rem class="d-block mx-auto"/>
<p class="text-center mt-1">{{ lastName }} {{ firstName }}<br/>{{email}}</p>
</div>
<div class="row">
<div class="col">
<table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
    <tr>
        <th>Employee ID</th>
        <td>{{ eid }}</td>
    </tr>
    <tr>
        <th>Gender</th>
        <td>{{ gender }}</td>
    </tr>
    <tr>
        <th>Marital Status</th>
        <td>{{ maritalStatus }}</td>
    </tr>
    <tr>
        <th>Date of Birth</th>
        <td>{{ dob }}</td>
    </tr>
    <tr>
        <th>Nationality</th>
        <td>{{ nationality }}</td>
    </tr>
    <tr>
        <th>Religion</th>
        <td>{{ religion }}</td>
    </tr>
    <tr>
        <th>Race</th>
        <td>{{ race }}</td>
    </tr>
    <tr>
        <th>Blood Group</th>
        <td>{{ bloodGroup }}</td>
    </tr>
    <tr>
        <th>Place Of Birth</th>
        <td>{{ placeOfBirth }}</td>
    </tr>
    <tr>
        <th>ID Number</th>
        <td>{{ idNo }}</td>
    </tr>
    <tr>
        <th>Pass Type</th>
        <td>{{ passType }}</td>
    </tr>
    <tr>
        <th>Highest Qualification</th>
        <td>{{ highestQual }}</td>
    </tr>
    <tr>
        <th>Mobile Number</th>
        <td>{{ mobileNo }}</td>
    </tr>
</table>

</div>



<div class="col">
<div id="accordion">
<div class="card">
  <div class="card-header" id="headingTwo">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Address
      </button>
    </h5>
  </div>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
    <div class="card-body">
    <table class="table table-striped table-bordered table-border">
        <tr>
            <th>Country</th>
            <td>{{ country }}</td>
            <th>Block Number</th>
            <td>{{ blockNo }}</td>
        </tr>
        <tr>
            <th>Unit Number</th>
            <td>{{ unitNo }}</td>
            <th>Street Name</th>
            <td>{{ streetName }}</td>
        </tr>
        <tr>
            <th>Postal Code</th>
            <td>{{ postalCode }}</td>
        </tr>
    </table>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header" id="headingThree">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Contact Details
      </button>
    </h5>
  </div>
  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
    <div class="card-body">
    <table class="table table-striped table-bordered table-border">
        <tr>
            <th>Emergency Contact Person</th>
            <td>{{ emergencyCN }}</td>
            <th>Relationship</th>
            <td>{{ relationship }}</td>
        </tr>
        <tr>
            <th>Emergency Contact Number</th>
            <td>{{ emergencyCD }}</td>
        </tr>
    </table>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header" id="headingFour">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
        Employment Details
      </button>
    </h5>
  </div>
  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
    <div class="card-body">
    <table class="table table-striped table-bordered table-border">
        <tr>
            <th>Join Date</th>
            <td>{{ joinDate }}</td>
            <th>Employment Type</th>
            <td>{{ empType }}</td>
        </tr>
        <tr>
            <th>Contract Start Date</th>
            <td>{{ contractSD }}</td>
            <th>Contract End Date</th>
            <td>{{ contractED }}</td>
        </tr>
        <tr>
            <th>Probation Start Date</th>
            <td>{{ probationSD }}</td>
            <th>Probation End Date</th>
            <td>{{ probationED }}</td>
        </tr>
        <tr>
            <th>Confirmed Date</th>
            <td>{{ confirmDate }}</td>
            <th>Designation</th>
            <td>{{ designation }}</td>
        </tr>
        <tr>
            <th>Department</th>
            <td>{{ department }}</td>
            <th>Supervisor ID</th>
            <td>{{ supervisorID }}</td>
        </tr>
    </table>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header" id="headingFive">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
        Leave
      </button>
    </h5>
  </div>
  <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
    <div class="card-body">
    <table class="table table-striped table-bordered table-border">
        <tr>
            <th>Leave Type</th>
            <th>Days Remaining</th>  
        </tr>
        <tr ng-repeat="data in data5">
            <td>{{ data.leaveType }}</td>
            <td>{{ data.daysRemaining }}</td>
        </tr>
    </table>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header" id="headingSix">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
        Payment
      </button>
    </h5>
  </div>
  <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
    <div class="card-body">
    <table class="table table-striped table-bordered table-border">
        <tr>
            <th>Payment Frequency</th>
            <td>{{ payFreq }}</td>
            <th>Payment Type</th>
            <td>{{ payType }}</td>
        </tr>
        <tr>
            <th>Basic Pay</th>
            <td>{{ basicPay | currency}}</td>
            <th>Day Shift Rate</th>
            <td>{{ dayShiftRate | currency}}</td>
        </tr>
        <tr>
            <th>Night Shift Rate</th>
            <td>{{ nightShiftRate | currency}}</td>
            <th>Cpf Entitled</th>
            <td>{{ cpfEntitled }}</td>
        </tr>
        <tr>
            <th>Fund Donation</th>
            <td>{{ fundDonation | currency}}</td>
            <th>Payment Mode</th>
            <td>{{ payMode }}</td>
        </tr>
        <tr>
            <th>Employee Bank</th>
            <td>{{ empBank }}</td>
            <th>Account Number</th>
            <td>{{ accNo }}</td>
        </tr>
        <tr>
            <th>Notice Period</th>
            <td>{{ noticePeriod }}</td>
            <th>Remarks</th>
            <td>{{ remarks }}</td>
        </tr>
    </table>
    </div>
  </div>
</div>
</div>

</div>