<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>

<h2>Create New Employee</h2>
{{ error }}

<ul id="mytabs" class="breadcrumb">
    <li class="active"><a data-target="#basic" data-toggle="tab">Step 1: Basic Information</a></li>
    <li><a data-target="#address" data-toggle="tab">Step 2: Address</a></li>
    <li><a data-target="#contact" data-toggle="tab">Step 3: Contact Details</a></li>
    <li><a data-target="#emp" data-toggle="tab">Step 4: Employment Details</a></li>
    <li><a data-target="#leave" data-toggle="tab">Step 5: Leave</a></li>
    <li><a data-target="#payment" data-toggle="tab">Step 6: Payment</a></li>
</ul>
<form ng-submit="employeeCreation()">
<div class="tab-content">
  <div class="tab-pane active in cont" id="basic">
    <table class="table table-striped table-bordered table-style-emp" >
            <tr>
                <th>First Name</th>
                <td><input type="text" ng-model="firstName" required></td>
                <th>Last Name</th>
                <td><input type="text" ng-model="lastName" required></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><select required ng-model="gender" ng-options="genderInfo for genderInfo in genderData"></td>
                <th>Marital Status</th>
                <td><select required ng-model="maritalStatus" ng-options="maritalStatusInfo for maritalStatusInfo in maritalStatusData"></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><input type="date" ng-model="dob" required></td>
                <th>Nationality</th>
                <td><input type="text" ng-model="nationality" required></td>
            </tr>
            <tr>
                <th>Religion</th>
                <td><input type="text" ng-model="religion" required></td>
                <th>Race</th>
                <td><input type="text" ng-model="race" required></td>
            </tr>
            <tr>
                <th>Blood Group</th>
                <td><select required ng-model="bloodGroup" ng-options="bloodGroupInfo for bloodGroupInfo in bloodGroupData"></td>
                <th>Place Of Birth</th>
                <td><input type="text" ng-model="placeOfBirth" required></td>
            </tr>
            <tr>
                <th>ID Type</th>
                <td><select required ng-model="idType" ng-options="idTypeInfo for idTypeInfo in idTypeData"></td>
                <th>ID Number</th>
                <td><input type="text" ng-model="idNo" maxlength="9" required></td>
            </tr>
            <tr>
                <th>Pass Type</th>
                <td><select required ng-model="passType" ng-options="passTypeInfo for passTypeInfo in passTypeData"></td>
                <th>Highest Qualification</th>
                <td><input type="text" ng-model="highestQual" required></td>
            </tr>
            <tr>
                <th>Mobile Number</th>
                <td><input type="text" ng-model="mobileNo" required></td>
                <th>Email</th>
                <td><input type="email" ng-model="email" required></td>
            </tr>
           
        </table>
  </div>
  <div class="tab-pane fade cont" id="address" >
    <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Country</th>
            <td><input type="text" ng-model="country" required></td>
            <th>Block Number</th>
            <td><input type="text" ng-model="blockNo"></td>
        </tr>
        <tr>
            <th>Unit Number</th>
            <td><input type="text" ng-model="unitNo" required></td>
            <th>Street Name</th>
            <td><input type="text" ng-model="streetName" required></td>
        </tr>
        <tr>
            <th>Postal Code</th>
            <td><input type="text" ng-model="postalCode" required></td>
        </tr>
    </table>
  </div>
  <div class="tab-pane fade cont" id="contact" >
  <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Emergency Contact Person</th>
            <td><input type="text" ng-model="emergencyCN" required></td>
            <th>Relationship</th>
            <td><input type="text" ng-model="relationship" required></td>
        </tr>
        <tr>
            <th>Emergency Contact Number</th>
            <td><input type="text" ng-model="emergencyCD" required></td>
        </tr>
    </table>
  </div>
  <div class="tab-pane fade cont" id="emp" >
    <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Join Date</th>
            <td><input type="date" ng-model="joinDate" required></td>
            <th>Employment Type</th>
            <td><input type="text" ng-model="empType" required></td>
        </tr>
        <tr>
            <th>Contract Start Date</th>
            <td><input type="date" ng-model="contractSD"></td>
            <th>Contract End Date</th>
            <td><input type="date" ng-model="contractED"></td>
        </tr>
        <tr>
            <th>Probation Start Date</th>
            <td><input type="date" ng-model="probationSD"></td>
            <th>Probation End Date</th>
            <td><input type="date" ng-model="probationED"></td>
        </tr>
        <tr>
            <th>Confirmed Date</th>
            <td><input type="date" ng-model="confirmDate"></td>
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
  <div class="tab-pane fade cont" id="leave" >
    <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Leave Type</th>
            <td><select required ng-model="leaveType" ng-options="leaveTypeInfo for leaveTypeInfo in leaveTypeData"></td>
            <th>Days Remaining</th>
            <td><input type="number" ng-model="daysRemaining"></td>
        </tr>
    </table>
  </div>
  <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
    <table class="table table-striped table-bordered" style="border: 1px solid black; margin-top: 1%;">
        <tr>
            <th>Payment Frequency</th>
            <td><select required ng-model="payFreq" ng-options="payFrequencyInfo for payFrequencyInfo in payFrequencyData"></td>
            <th>Payment Type</th>
            <td><select required ng-model="payType" ng-options="highestQualificationInfo for highestQualificationInfo in highestQualificationData"></td>
        </tr>
        <tr>
            <th>Basic Pay</th>
            <td><input type="number" min="0.00" step="0.01" ng-model="basicPay" required></td>
            <th>Day Shift Rate</th>
            <td><input type="number" min="0.00" step="0.01" ng-model="dayShiftRate" required></td>
        </tr>
        <tr>
            <th>Night Shift Rate</th>
            <td><input type="number" min="0.00" step="0.01" ng-model="nightShiftRate" required></td>
            <th>Cpf Entitled</th>
            <td><input type="number" min="0.00" step="0.01" ng-model="cpfEntitled" required></td>
        </tr>
        <tr>
            <th>Fund Donation</th>
            <td><input type="number" min="0.00" step="0.01" ng-model="fundDonation" required></td>
            <th>Payment Mode</th>
            <td><select ng-model="payMode" ng-options="highestQualificationInfo for highestQualificationInfo in highestQualificationData"></td>
        </tr>
        <tr>
            <th>Employee Bank</th>
            <td><input type="text" ng-model="empBank" required></td>
            <th>Account Number</th>
            <td><input type="text" ng-model="accNo" required></td>
        </tr>
        <tr>
            <th>Notice Period</th>
            <td><input type="text" ng-model="noticePeriod" required></td>
            <th>Remarks</th>
            <td><input type="text" ng-model="remarks"></td>
        </tr>
        <tr>
            <td colspan=4><button type="submit" name="btnCreate" class="btn btn-dark" >Create</button></td>
        </tr>
    </table>
  </div>
</div>
</form>


<button type="button" id="changetabbutton" class="btn btn-dark float-right">Next</button>
<button type="button" id="changetabbuttonback" class="btn btn-dark ">Previous</button>
<script>
    
jQuery.noConflict(); 

if ($('#mytabs a:first-child')){
    $('#changetabbuttonback').hide();
    $('#changetabbutton').css('margin-bottom', '2rem');
} 

jQuery('#changetabbutton').click(function(e) {
    e.preventDefault();
    if ($('#mytabs .active').children('a').attr('data-target') == "#leave"){
        $('#changetabbutton').hide();
    }
    $('#changetabbuttonback').show();
    var link = $('#mytabs .active').next().children('a').attr('data-target');   
    $('#mytabs a[data-target="' + link + '"]').tab('show');
    $('#mytabs .active').removeClass('active');
    $('#mytabs a[data-target="' + link + '"]').parent().addClass('active');  
});

jQuery('#changetabbuttonback').click(function(e) {
    e.preventDefault();
    if ($('#mytabs .active').children('a').attr('data-target') == "#address"){
        $('#changetabbuttonback').hide();
    }
    $('#changetabbutton').show();
    var link = $('#mytabs .active').prev().children('a').attr('data-target');
    $('#mytabs a[data-target="' + link + '"]').tab('show');
    $('#mytabs .active').removeClass('active');
    $('#mytabs a[data-target="' + link + '"]').parent().addClass('active'); 
});

jQuery('#mytabs a').click(function(e) {
    e.preventDefault();
    return false;
})


</script>