<span ng-bind-html="statusCreate" class="fixed-alert fadeout"></span>
<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Attendance Display</h2>

Select Month: 
<select ng-model="selectedMonth" ng-change="displayData()">
    <option id="1" value="1">January</option>
    <option id="2" value="2">February</option>
    <option id="3" value="3">March</option>
    <option id="4" value="4">April</option>
    <option id="5" value="5">May</option>
    <option id="6" value="6">June</option>
    <option id="7" value="7">July</option>
    <option id="8" value="8">August</option>
    <option id="9" value="9">September</option>
    <option id="10" value="10">October</option>
    <option id="11" value="11">November</option>
    <option id="12" value="12">December</option>
</select>
<br>
Select Year: 
<select id="year" ng-model="selectedYear" ng-options="year for year in yearListData" ng-change="displayData()"></select>

<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Date Completed</th>
            <th>Project ID</th>
            <th>Time In</th>
            <th>Time Out</th>
        </tr>
    </thead>
</table>

<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>