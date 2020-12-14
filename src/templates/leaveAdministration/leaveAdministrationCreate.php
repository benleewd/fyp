
<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<h2>Create New Leave</h2>

<form ng-submit="leaveCreation()">
    <table class="table table-striped table-bordered table-style">
        <tr>
            <th>Employee NRIC</th>
            <td><select required ng-model="newNRIC" ng-options="nric for nric in nricData"></td>
        </tr>
        <tr>
            <th>Start Date</th>
            <td><input type="date" ng-model="newFromDate" required></td>
        </tr>
        <tr>
            <th>End Date</th>
            <td><input type="date" ng-model="newToDate" required></td>
        </tr>
        <tr>
            <th>Leave Type</th>
            <td><select required ng-model="newLeaveType" ng-options="leaveTypeInfo for leaveTypeInfo in leaveTypeData"></td>
        </tr>
        <tr>
            <th>Remarks</th>
            <td><input type="textbox" ng-model="newRemarks"></td>
        </tr>
        <tr>
            <td colspan=2>
                <button type="submit" name="btnCreate" class="btn btn-dark">Create</button>
                <button ng-click="reset()" type="reset" name="btnCreate" class="btn btn-dark">Reset</button>
            </td>
        </tr>
    </table>
</form>
