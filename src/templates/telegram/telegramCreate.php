<button ng-click="back()" name="btnCreate" class="btn btn-dark top">Back</button>
<h2>Create New Telegram</h2>

<form ng-submit="telegramCreation()">
    <table class="table table-striped table-bordered table-style">
        <tr>
            <th>Employee</th>
            <td>
                <select ng-model="nric" ng-options="tele for tele in teleData"></select>
            </td>
        </tr>
        <tr>
            <th>Telegram ID</th>
            <td><input type="text" ng-model="teleID"></td>
        </tr>
        <tr>
            <td colspan=2>
                <button type="submit" name="btnCreate" class="btn btn-dark">Create</button>
            </td>
        </tr>
    </table>
</form>



