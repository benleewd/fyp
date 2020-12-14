<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<h2>Update Payment</h2>

<form ng-submit="paymentUpdate()">
    <table class="table table-striped table-bordered table-style">
        <tr>
            <th>Employee NRIC</th>
            <td>{{ idNo }}</td>
        </tr>
        <tr>
            <th>Payment Period</th>
            <td ng-bind-html="period"></td>
        </tr>
        <tr>
            <th>Payment Frequency</th>
            <td>{{ payFreq }}</td>
        </tr>
        <tr>
            <th>Number of Public Holidays</th>
            <td>{{ noOfPH }}</td>
        </tr>
        <tr>
            <th>Payment Amount</th>
            <td>{{ payAmount | currency}}</td>
        </tr>
        <tr>
            <th>Basic Hourly Rate</th>
            <td>{{ basicHourlyRate | currency }}</td>
        </tr>
        <tr>
            <th>OT Rate per Shift</th>
            <td>{{ OTPerShift | currency}}</td>
        </tr>
        <tr ng-class="transportInfo">
            <th>Transport Cost</th>
            <td><input type="number" min="0.00" step="0.05" ng-model="transportCost"></td>
        </tr>
        <tr ng-class="bonusInfo">
            <th>Bonus</th>
            <td><input type="number" min="0.00" step="0.05" ng-model="bonus"></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <select ng-model="status" ng-options="status for status in statusData"></select>
            </td>
        </tr>
        <tr>
            <td colspan=2><button type="submit" name="btnCreate" class="btn btn-dark">Update</button></td>
        </tr>
    </table>
</form>

{{ updateStatus }}
