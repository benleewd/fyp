<span ng-bind-html="statusUpdate" class="fixed-alert fadeout"></span>

<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<button ng-click="delete()" name="btnCreate" class="btn btn-dark float-right top">Delete</button>
<button ng-click="makeChanges()" name="btnCreate" class="btn btn-dark float-right top">Edit</button>

<h2>View</h2>

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
        <th>Shifts</th>
        <td>{{ shiftName }}</td>
    </tr>
    <tr>
        <th>Date Completed</th>
        <td>{{ dateCompletedShift }}</td>
    </tr>
    <tr>
        <th>Clock In</th>
        <td>{{ clockIn }}</td>
    </tr>
    <tr>
        <th>Clock Out</th>
        <td>{{ clockOut }}</td>
    </tr>
</table>

