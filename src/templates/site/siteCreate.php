<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<h2>Create New Site</h2>

<form ng-submit="siteCreation()">
    <table class="table table-striped table-bordered table-style">
        <tr>
            <th>Project Name</th>
            <td><input type="text" ng-model="projectName" required></td>
        </tr>
        <tr>
            <th>Shifts</th>
            <td>
                <select ng-model="shifts" ng-options="uniqueShift for uniqueShift in shiftData"></select>
            </td>
        </tr>
        <tr>
            <th>Public Holidays</th>
            <td><input type="checkbox" ng-model="publicHoliday"></td>
        </tr>
        <tr>
            <th>Site Allowance</th>
            <td><input type="number" min="0.00" step="0.01" ng-model="siteAllowance" required></td>
        </tr>
        <tr>
            <th>Employees Required</th>
            <td><input type="number" ng-model="employeesRequired" required></td>
        </tr>
        <tr>
            <th>Address/Postal Code</th>
            <td><input id="addressField" type="text" ng-model="address" required></td>
        </tr>
        <tr>
            <th>Active</th>
            <td><input type="checkbox" ng-model="active"></td>
        </tr>
        <tr>
            <td colspan=2>
                <button type="submit" name="btnCreate" class="btn btn-dark">Create</button>
            </td>
        </tr>
    </table>
</form>



