<span ng-bind-html="statusCreate" class="fixed-alert fadeout"></span>
<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Employee Display</h2>

<a href="#!create" class="btn btn-dark">Create New Employee</a>
<a id="empForm" href="services/employee/basic/empExportToExcel.php" class="btn btn-dark ">Export To Excel</a>

<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Pass Type</th>
        </tr>
    </thead>
</table>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "ajax": {
                "url": "services/employee/basic/retrieveAll.php",
                "dataSrc": "data"
            },
            "columns": [
                { 
                    "data": "eid",
                    "render":   function(data, type, row, meta){
                                    if(type === 'display'){
                                        data = '<a href="#!viewSingle/' + data + '">' + data + '</a>';
                                    }

                                    return data;
                                }
                },
                { "data": "firstName" },
                { "data": "lastName" },
                { "data": "passType" }
            ],
        });
    });
</script>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>