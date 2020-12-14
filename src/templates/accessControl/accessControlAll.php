<h2>Access Control</h2>

<a href="#!create" class="btn btn-dark">Create New Designation</a>
<button ng-show="accessControlData != undefined && designation != 'Management'" ng-click="delete()" class="btn btn-dark float-rightx">Delete</button>
<br><br>

View existing designation: 
<select ng-model="designation" ng-options="uniqueDesignation for uniqueDesignation in designationData" ng-change="displayData()"></select>

<form ng-submit="update()">
    <div ng-repeat="module in uniqueModule">
    <br/>
        <h5 class="text-center">{{ module }}</h5>       
        <table class="table table-striped border">
        <tr>
            <td class="w-50">
                <h6 class="font-weight-bold">Webpage</h6>
                <div ng-repeat="obj in accessControlData" class="text-left pl-5">
                    <div ng-if="module == obj.module && obj.type == 'Webpage' ">
                        <input type="checkbox" ng-model="obj.accessible">  
                        {{ obj.pageAccess }}
                    </div>
                </div>
            </td>
            <td class="w-50 border-left">
                <h6 class="font-weight-bold">API</h6>
                <div ng-repeat="obj in accessControlData" class="text-left pl-5">
                    <div ng-if="module == obj.module && obj.type == 'API' ">
                        <input type="checkbox" ng-model="obj.accessible">  
                        {{ obj.pageAccess }}
                    </div>
                </div>
            </td>
        </tr>
        </table>
        
    </div>
    <button ng-show="accessControlData != undefined" type="submit" class="btn btn-dark d-inline-block">Update</button>
</form>


{{ createStatus }}
