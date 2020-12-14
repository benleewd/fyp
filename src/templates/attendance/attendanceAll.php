<span ng-bind-html="statusCreate" class="fixed-alert fadeout"></span>
<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Attendance Display</h2>

<a href="#!create" class="btn btn-dark">Create New Attendance</a>
<a id="attendanceForm" href="services/attendance/attendanceExportToExcel.php" class="btn btn-dark">Export To Excel</a>

<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Employee NRIC</th>
            <th>Project Name</th>
            <th>Time In</th>
            <th>Time Out</th>
        </tr>
    </thead>
</table>
