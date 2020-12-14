<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<h2>Leave Details</h2>

<table class="table table-striped table-bordered table-style">
    <tr>
        <th>Start Date</th>
        <td>{{ fromDate }}</td>
    </tr>
    <tr>
        <th>End Date</th>
        <td>{{ toDate }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{ status }}</td>
    </tr>
    <tr>
        <th>Leave Type</th>
        <td>{{ leaveType }}</td>
    </tr>
    <tr>
        <th>Remarks</th>
        <td>{{ remarks }}</td>
    </tr>
    <tr>
        <td colspan=2>
            <button ng-click="withdraw()" name="btnCreate" class="btn btn-dark">Withdraw</button>
        </td>
    </tr>
</table>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>