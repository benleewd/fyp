<span ng-bind-html="statusCreate" class="fixed-alert fadeout"></span>
<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Personal Leave</h2>

<a href="#!request" class="btn btn-dark">New Leave Request</a>

<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
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
                "url": "services/leaveManagement/retrieveOngoingPersonalLeave.php",
                "dataSrc": "data"
            },
            "columns": [
                { 
                    "data": "fromDate",
                    "render":   function(data, type, row, meta){
                                    if(type === 'display'){
                                        data = '<a href="#!viewSingle/' + data + '">' + data + '</a>';
                                    }

                                    return data;
                                }
                },
                { "data": "toDate" },
                { "data": "status" }                
            ],
        });
    });
</script>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>