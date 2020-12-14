<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>

<h2>View</h2>

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
        <td>{{ transportCost | currency}}</td>
    </tr>
    <tr ng-class="bonusInfo">
        <th>Bonus</th>
        <td>{{ bonus | currency}}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{ status }}</td>
    </tr>
</table>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>
