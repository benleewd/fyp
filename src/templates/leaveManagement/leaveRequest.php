<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<h2>New Leave Request</h2>

<form ng-submit="leaveRequestCreation()">
    <table class="table table-striped table-bordered table-style">
        <tr>
            <th>Start Date</th>
            <td><input type="date" ng-model="fromDate" required></td>
        </tr>
        <tr>
            <th>End Date</th>
            <td><input type="date" ng-model="toDate" required></td>
        </tr>
        <tr>
            <th>Leave Type</th>
            <td>
                <select ng-model="leaveType" ng-options="leave for leave in leaveTypeData"></select>
            </td>
        </tr>
        <tr>
            <th>Remarks</th>
            <td><input type="text" ng-model="remarks"></td>
        </tr>
        <tr>
            <td colspan=2>
                <button type="submit" name="btnCreate" class="btn btn-dark">Create</button>
            </td>
        </tr>
    </table>
</form>

<span ng-bind-html="validationError" class="fixed-alert fadeout"></span>