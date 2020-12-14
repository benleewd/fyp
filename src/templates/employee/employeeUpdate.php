<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>

<h2>Update</h2>
{{ error }}

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

<form ng-submit="employeeUpdate()">
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
    <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
            <tr>
                <th>Employee ID</th>
                <td>{{ eid }}</td>
                <th>First Name</th>
                <td><input type="text" ng-model="firstName"></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><input type="text" ng-model="lastName"></td>
                <th>Gender</th>
                <td><select ng-model="gender" ng-options="genderInfo for genderInfo in genderData"></td>
            </tr>
            <tr>
                <th>Marital Status</th>
                <td><select ng-model="maritalStatus" ng-options="maritalStatusInfo for maritalStatusInfo in maritalStatusData"></td>
                <th>Date of Birth</th>
                <td><input type="text" ng-model="dob"></td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td><input type="text" ng-model="nationality"></td>
                <th>Religion</th>
                <td><input type="text" ng-model="religion"></td>
            </tr>
            <tr>
                <th>Race</th>
                <td><input type="text" ng-model="race"></td>
                <th>Blood Group</th>
                <td><select ng-model="bloodGroup" ng-options="bloodGroupInfo for bloodGroupInfo in bloodGroupData"></td>
            </tr>
            <tr>
                <th>Place Of Birth</th>
                <td><input type="text" ng-model="placeOfBirth"></td>
                <th>ID Type</th>
                <td><select ng-model="idType" ng-options="idTypeInfo for idTypeInfo in idTypeData"></td>
            </tr>
            <tr>
                <th>ID Number</th>
                <td><input type="text" ng-model="idNo"></td>
                <th>Pass Type</th>
                <td><select ng-model="passType" ng-options="passTypeInfo for passTypeInfo in passTypeData"></td>
            </tr>
            <tr>
                <th>Highest Qualification</th>
                <td><input type="text" ng-model="highestQual"></td>
                <th>Mobile Number</th>
                <td><input type="text" ng-model="mobileNo"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="email" ng-model="email"></td>
                <!-- <th>Created By</th>
                <td>{{ createdBy }}</td> -->
            </tr>
            <!-- <tr>
                <th>Created Date Time</th>
                <td>{{ createdDT }}</td>
                <th>Last Modified By</th>
                <td>{{ lastModifiedBy }}</td>
            </tr>
            <tr>
                <th>Last Modified Date Time</th>
                <td>{{ lastModifiedDT }}</td>
            </tr> -->
        </table>
  </div>
  <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
    <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Country</th>
            <td><input type="text" ng-model="country"></td>
            <th>Block Number</th>
            <td><input type="text" ng-model="blockNo"></td>
        </tr>
        <tr>
            <th>Unit Number</th>
            <td><input type="text" ng-model="unitNo"></td>
            <th>Street Name</th>
            <td><input type="text" ng-model="streetName"></td>
        </tr>
        <tr>
            <th>Postal Code</th>
            <td><input type="text" ng-model="postalCode"></td>
        </tr>
    </table>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Emergency Contact Person</th>
            <td><input type="text" ng-model="emergencyCN"></td>
            <th>Relationship</th>
            <td><input type="text" ng-model="relationship"></td>
        </tr>
        <tr>
            <th>Emergency Contact Number</th>
            <td><input type="text" ng-model="emergencyCD"></td>
        </tr>
    </table>
  </div>
  <div class="tab-pane fade" id="emp" role="tabpanel" aria-labelledby="emp-tab">
    <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Join Date</th>
            <td><input type="text" datetime="yyyy-MM-dd" ng-model="joinDate"></td>
            <th>Employment Type</th>
            <td><select required ng-model="empType" ng-options="empTypeInfo for empTypeInfo in empTypeData"></td>
        </tr>
        <tr>
            <th>Contract Start Date</th>
            <td><input type="text" datetime="yyyy-MM-dd" ng-model="contractSD"></td>
            <th>Contract End Date</th>
            <td><input type="text" datetime="yyyy-MM-dd" ng-model="contractED"></td>
        </tr>
        <tr>
            <th>Probation Start Date</th>
            <td><input type="text" datetime="yyyy-MM-dd" ng-model="probationSD"></td>
            <th>Probation End Date</th>
            <td><input type="text" datetime="yyyy-MM-dd" ng-model="probationED"></td>
        </tr>
        <tr>
            <th>Confirmed Date</th>
            <td><input type="text" datetime="yyyy-MM-dd" ng-model="confirmDate"></td>
            <th>Designation</th>
            <td><select required ng-model="designation" ng-options="designationInfo for designationInfo in designationData"></td>
        </tr>
        <tr>
            <th>Department</th>
            <td><select required ng-model="department" ng-options="departmentInfo for departmentInfo in departmentData"></td>
            <th>Supervisor ID</th>
            <td><select required ng-model="newNRIC" ng-options="nricInfo for nricInfo in nric"></td>
        </tr>
    </table>
  </div>
  <div class="tab-pane fade" id="leave" role="tabpanel" aria-labelledby="leave-tab">
    <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Leave Type</th>
            <td><input type="text" ng-model="leaveType"></td>
            <th>Days Remaining</th>
            <td><input type="number" ng-model="daysRemaining"></td>
        </tr>
        <tr ng-repeat="data in data5">
            <!-- <td>{{ data.leaveType }}</td> -->
            <td>{{ data.leaveType }}</td>
            <td>{{leaveType0}}</td>
            <!-- <td>{{ data.daysRemaining }}</td> -->
        </tr>
    </table>
  </div>
  <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
    <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Payment Frequency</th>
            <td><select required ng-model="payFreq" ng-options="payFreqInfo for payFreqInfo in payFreqData"></td>
            <th>Payment Type</th>
            <td><select required ng-model="payType" ng-options="payTypeInfo for payTypeInfo in payTypeData"></td>
        </tr>
        <tr>
            <th>Basic Pay</th>
            <td><input type="text" ng-model="basicPay"></td>
            <th>Day Shift Rate</th>
            <td><input type="text" ng-model="dayShiftRate"></td>
        </tr>
        <tr>
            <th>Night Shift Rate</th>
            <td><input type="text" ng-model="nightShiftRate"></td>
            <th>Cpf Entitled</th>
            <td><input type="text" ng-model="cpfEntitled"></td>
        </tr>
        <tr>
            <th>Fund Donation</th>
            <td><input type="text" ng-model="fundDonation"></td>
            <th>Payment Mode</th>
            <td><select ng-model="payMode" ng-options="highestQualificationInfo for highestQualificationInfo in highestQualificationData"></td>
        </tr>
        <tr>
            <th>Employee Bank</th>
            <td><input type="text" ng-model="empBank"></td>
            <th>Account Number</th>
            <td><input type="text" ng-model="accNo"></td>
        </tr>
        <tr>
            <th>Notice Period</th>
            <td><input type="text" ng-model="noticePeriod"></td>
            <th>Remarks</th>
            <td><input type="text" ng-model="remarks"></td>
        </tr>
    </table>
  </div>
</div>
<button type="submit" name="btnCreate" class="btn btn-dark" >Update</button>
</form>

{{ updateStatus }}
<script>
    $("#empDropdown2 a").on("click", function(){  
        $("#empDropdown2").find(".active").removeClass("active");  
        $(this).parent().addClass("active");

        $("#empDropdown a.btn").empty();
        $("#empDropdown a.btn").append($(this).text());
    });
</script>