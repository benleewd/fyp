<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<h2>Update Telegram</h2>

<form ng-submit="telegramUpdate()">
    <table class="table table-striped table-bordered table-style">
        <tr>
            <th>NRIC</th>
            <td>{{ nric }}</td>
        </tr>
        <tr>
            <th>Employee ID</th>
            <td>{{ eid }}</td>
        </tr>
        <tr>
            <th>Telegram ID</th>
            <td><input type="text" ng-model="telegramID" required></td>
        </tr>
        <tr>
            <th>Chat ID</th>
            <td>{{ chatID }}</td>
        </tr>
        <tr>
            <td colspan=2><button type="submit" name="btnCreate" class="btn btn-dark">Update</button></td>
        </tr>
    </table>
</form>

{{ updateStatus }}



