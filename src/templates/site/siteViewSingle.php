<?php 
include '../../static/libs/phpqrcode/qrlib.php';
?>

<span ng-bind-html="statusUpdate" class="fixed-alert fadeout"></span>

<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<button ng-click="delete()" name="btnCreate" class="btn btn-dark float-right top">Delete</button>
<button ng-click="makeChanges()" name="btnCreate" class="btn btn-dark float-right top">Edit</button>
<a id="qrCode" href="" class="btn btn-dark float-right top" download="">Generate QRCode</a>

<h2>View</h2>

<table class="table table-striped table-bordered table-style">
    <tr>
        <th>Project ID</th>
        <td>{{ projectID }}</td>
    </tr>
    <tr>
        <th>Project Name</th>
        <td>{{ projectName }}</td>
    </tr>
    <tr>
        <th>Shifts</th>
        <td>{{ shifts }}</td>
    </tr>
    <tr>
        <th>Public Holidays</th>
        <td>{{ publicHoliday }}</td>
    </tr>
    <tr>
        <th>Site Allowance</th>
        <td>{{ siteAllowance }}</td>
    </tr>
    <tr>
        <th>Employees Required</th>
        <td>{{ employeesRequired }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ address }}</td>
    </tr>
    <tr>
        <th>Active</th>
        <td>{{ active }}</td>
    </tr>
</table>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>