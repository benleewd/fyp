<span ng-bind-html="statusUpdate" class="fixed-alert fadeout"></span>
<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Leave Request</h2>

<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>NRIC</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
    </thead>
</table>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "ajax": {
                "url": "services/leaveRequest/retrieveAllRequestToSupervisor.php",
                "dataSrc": "data"
            },
            "columns": [
                { 
                    "data": "nric",
                    "render":   function(data, type, row, meta){
                                    if(type === 'display'){
                                        data = '<a href="#!viewSingle/' + row.eid + '|' + row.fromDate + '">' + data + '</a>';
                                    }

                                    return data;
                                }
                },
                { "data": "fromDate" },
                { "data": "toDate" },
                { "data": "status" }
            ],
        });
    });
</script>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>