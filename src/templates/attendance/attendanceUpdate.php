<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<h2>Update Attendance</h2>

<form ng-submit="attendanceUpdate()">
    <table class="table table-striped table-bordered table-style">
        <tr>
            <th>Employee NRIC</th>
            <td>{{ nric }}</td>
        </tr>    
        <tr>
            <th>Employee ID</th>
            <td>{{ eid }}</td>
        </tr>
        <tr>
            <th>Project Name</th>
            <td>{{ projectName }}</td>
        </tr>
        <tr>
            <th>Project ID</th>
            <td>{{ projectID }}</td>
        </tr>
        <tr>
        <th>Shift Name</th>
            <td>{{shiftName}}</td>
        </tr>
        <tr>
            <th>Date Completed</th>
            <td>{{dateCompletedShift}}</td>
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
            <td colspan=2><button type="submit" name="btnCreate" class="btn btn-dark">Update</button></td>
        </tr>
    </table>
</form>

{{ updateStatus }}
