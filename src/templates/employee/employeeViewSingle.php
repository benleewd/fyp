<span ng-bind-html="statusUpdate" class="fixed-alert fadeout"></span>

<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<button ng-click="delete()" name="btnCreate" class="btn btn-dark float-right top">Delete</button>
<button ng-click="makeChanges()" name="btnCreate" class="btn btn-dark float-right top">Edit</button>
<button ng-click="passwordChange()" name="btnCreate" class="btn btn-dark float-right top">Change password</button>
<a id="pdfForm" href="services/employee/basic/generateAllDataPDF.php?" class="btn btn-dark float-right top">Generate PDF</a>
<div class="dropdown float-right top" id="payroll">
  <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Generate Payroll
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <button class="dropdown-item" data-toggle="modal" data-target="#paymentWeeklyModal" id="paymentFormWeekly">Weekly</button>
    <button class="dropdown-item" data-toggle="modal" data-target="#paymentWeeklyModal" id="paymentFormWeekly">Bi-Weekly</button>
    <button class="dropdown-item" data-toggle="modal" data-target="#paymentMonthlyModal" id="paymentFormMonthly">Monthly</button>
  </div>
</div>

<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

<!-- Modal for Weekly and Bi-Weekly payment -->
<div class="modal fade" id="paymentWeeklyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Select Payment Duration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="services/payment/create.php" method="GET" target="dummyframe">
        <input type="hidden" id="eid" name="eid" value="{{eid}}">
        <div class="form-row">
            <div class="col">
                <label>Start Date</label>
            </div>
            <div class="col">
                <label>End Date</label>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <input type="date" class="form-control" placeholder="From-Date" name="fromDate" id="fromDate">
            </div>
            <div class="col">
                <input type="date" class="form-control" placeholder="To-Date" name="toDate" id="toDate">
            </div>
        </div>
        <button type="submit" class="btn btn-success mx-auto d-block mt-2" id="paymentWeekly">Generate Payroll</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Monthly payment -->
<div class="modal fade" id="paymentMonthlyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Select Payment Duration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="services/payment/create.php" method="GET" target="dummyframe">
        <div class="form-row">
        <input type="hidden" id="eid" name="eid" value="{{eid}}">
            <div class="col text-right">
                <label>Select Month: </label>
            </div>
            <div class="col">
                <select id="selectedMonth" name="selectedMonth">
                    <option id="1" value="1">January</option>
                    <option id="2" value="2">February</option>
                    <option id="3" value="3">March</option>
                    <option id="4" value="4">April</option>
                    <option id="5" value="5">May</option>
                    <option id="6" value="6">June</option>
                    <option id="7" value="7">July</option>
                    <option id="8" value="8">August</option>
                    <option id="9" value="9">September</option>
                    <option id="10" value="10">October</option>
                    <option id="11" value="11">November</option>
                    <option id="12" value="12">December</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success mx-auto d-block mt-2" id="paymentMonthly">Generate Payroll</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal" id="close">Close</button>
      </div>
    </div>
  </div>
</div>

<h2 id="empView">View</h2>

<!-- For mobile view to replace navtabs -->
<div class="dropdown show" id="empDropdown">
  <a class="btn btn-secondary btn-block dropdown-toggle" role="tab" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Basic Information
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="empDropdown2">
    <a class="dropdown-item" data-target="#basic" role="tab" data-toggle="tab">Basic Information</a>
    <a class="dropdown-item" data-target="#address" role="tab" data-toggle="tab">Address</a>
    <a class="dropdown-item" data-target="#contact" role="tab" data-toggle="tab">Contact Details</a>
    <a class="dropdown-item" data-target="#emp" role="tab" data-toggle="tab">Employment Details</a>
    <a class="dropdown-item" data-target="#leave" role="tab" data-toggle="tab">Leave</a>
    <a class="dropdown-item" data-target="#payment" role="tab" data-toggle="tab">Payment</a>
  </div>
</div>

<ul class="nav nav-tabs navbar-fixed-top" id="nav-tab" >
  <li><a class="nav-item nav-link active"  id="basic-tab" role="tab" data-toggle="tab" data-target="#basic">Basic Information</a></li>
  <li><a class="nav-item nav-link" id="address-tab" role="tab" data-toggle="tab" data-target="#address">Address</a></li>
  <li><a class="nav-item nav-link" id="contact-tab" role="tab" data-toggle="tab" data-target="#contact">Contact Details</a></li>
  <li><a class="nav-item nav-link" id="emp-tab" role="tab" data-toggle="tab" data-target="#emp">Employment Details</a></li>
  <li><a class="nav-item nav-link" id="leave-tab" role="tab" data-toggle="tab" data-target="#leave">Leave</a></li>
  <li><a class="nav-item nav-link" id="payment-tab" role="tab" data-toggle="tab" data-target="#payment">Payment</a></li>
</ul>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
    <table class="table table-striped table-bordered table-style-emp">
            <tr>
                <th>Employee ID</th>
                <td>{{ eid }}</td>
                <th>First Name</th>
                <td>{{ firstName }}</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>{{ lastName }}</td>
                <th>Gender</th>
                <td>{{ gender }}</td>
            </tr>
            <tr>
                <th>Marital Status</th>
                <td>{{ maritalStatus }}</td>
                <th>Date of Birth</th>
                <td>{{ dob }}</td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td>{{ nationality }}</td>
                <th>Religion</th>
                <td>{{ religion }}</td>
            </tr>
            <tr>
                <th>Race</th>
                <td>{{ race }}</td>
                <th>Blood Group</th>
                <td>{{ bloodGroup }}</td>
            </tr>
            <tr>
                <th>Place Of Birth</th>
                <td>{{ placeOfBirth }}</td>
                <th>ID Type</th>
                <td>{{ idType }}</td>
            </tr>
            <tr>
                <th>ID Number</th>
                <td>{{ idNo }}</td>
                <th>Pass Type</th>
                <td>{{ passType }}</td>
            </tr>
            <tr>
                <th>Highest Qualification</th>
                <td>{{ highestQual }}</td>
                <th>Mobile Number</th>
                <td>{{ mobileNo }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ email }}</td>
            </tr>
        </table>
  </div>
  <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
    <table class="table table-striped table-bordered table-style-emp">
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
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  <table class="table table-striped table-bordered table-style-emp">
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
  <div class="tab-pane fade" id="emp" role="tabpanel" aria-labelledby="emp-tab">
    <table class="table table-striped table-bordered table-style-emp">
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
  <div class="tab-pane fade" id="leave" role="tabpanel" aria-labelledby="leave-tab">
    <table class="table table-striped table-bordered table-style-emp">
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
  <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
    <table class="table table-striped table-bordered table-style-emp">
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
<script>
    $(".fadeout").delay(3000).slideUp(200);

    $("#empDropdown2 a").on("click", function(){  
        $("#empDropdown2").find(".active").removeClass("active");  
        $(this).parent().addClass("active");

        $("#empDropdown a.btn").empty();
        $("#empDropdown a.btn").append($(this).text());
    });

    $("#paymentMonthly").on("click", function(){
        alert("Payroll generated");
    })

    $("#paymentWeekly").on("click", function(){
        alert("Payroll generated");
    })

    

</script>
