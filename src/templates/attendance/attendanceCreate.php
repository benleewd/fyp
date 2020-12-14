
<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<h2>Create New Attendance</h2>

<form ng-submit="attendanceCreation()">
    <table class="table table-striped table-bordered table-style">
        <tr>
            <th>Employee NRIC</th>
            <td><select required ng-model="newNRIC" ng-options="nric for nric in nricData"></td>
        </tr>
        <tr>
            <th>Project Name</th>
            <td>
                <select ng-model="projectName" ng-options="attendance for attendance in attendanceData"></select>
            </td>
        </tr>
        <tr>
        <th>Shift Name</th>
            <td>
                <select ng-model="shifts" ng-options="uniqueShift for uniqueShift in shiftData"></select>
            </td>
        </tr>
        <tr>
            <th>Date Completed</th>
            <td><input type="date" ng-model="dateCompletedShift" required></td>
        </tr>
        <tr>
            <th>Clock In</th>
            <td><input type="time" ng-model="clockIn" required></td>
        </tr>
        <tr>
            <th>Clock Out</th>
            <td><input type="time" ng-model="clockOut"></td>
        </tr>
        <tr>
            <td colspan=2>
                <button type="submit" name="btnCreate" class="btn btn-dark">Create</button>
            </td>
        </tr>
    </table>
</form>
