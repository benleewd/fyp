<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Payment Display</h2>

<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>NRIC</th>
            <th>Payment Frequency</th>
            <th>Status</th>
        </tr>
    </thead>
</table>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "ajax": {
                "url": "services/payment/retrieveAll.php",
                "dataSrc": "data"
            },
            "columns": [
                { 
                    "data": "nric",
                    "render":   function(data, type, row, meta){
                                    if(type === 'display'){
                                        data = '<a href="#!viewSingle/' + row.eid + "|" + row.month + "|" + row.fromDate + "|" + row.toDate + '">' + data + '</a>';
                                    }

                                    return data;
                                }

                },
                { "data": "payFreq" },
                { "data": "status"}
            ],
        });
    });
</script>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>