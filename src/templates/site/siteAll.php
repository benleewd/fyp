<span ng-bind-html="statusCreate" class="fixed-alert fadeout"></span>
<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Sites Display</h2>

<a href="#!create" class="btn btn-dark">Create New Site</a>

<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Project ID</th>
            <th>Project Name</th>
            <th>Employees Required</th>
            <th>Active</th>
        </tr>
    </thead>
</table>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "ajax": {
                "url": "services/site/retrieveAll.php",
                "dataSrc": "data"
            },
            "columns": [
                { 
                    "data": "projectID",
                    "render":   function(data, type, row, meta){
                                    if(type === 'display'){
                                        data = '<a href="#!viewSingle/' + data + '">' + data + '</a>';
                                    }

                                    return data;
                                }
                },
                { "data": "projectName" },
                { "data": "employeesRequired" },
                { 
                    "data": "active",
                    "render":   function(data, type, row, meta){
                                    if(data){
                                        data = 'Yes';
                                    } else {
                                        data = 'No';
                                    }

                                    return data;
                                }
                }
            ],
        });
    });
</script>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>