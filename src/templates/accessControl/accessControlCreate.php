<h2>Create new designation</h2>

<form ng-submit="designationCreation()">
    <table class="table table-striped table-bordered" style="width:50%; margin:auto; border: 2px solid black; ">
        <tr>
            <th>Designation</th>
            <td><input type="text" ng-model="newDesignationName"></td>
        </tr>
        <tr>
            <td colspan=2>
                <button type="submit" name="btnCreate" class="btn btn-dark">Create</button>
            </td>
        </tr>
    </table>
</form>

<p>* For security reasons, new designation will not have access to any page. Alter access in <a href="#!">main page</a> after creation</p>

<button ng-click="back()" name="btnCreate" class="btn btn-dark">Back</button>