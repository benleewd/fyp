<span ng-bind-html="statusCreate" class="fixed-alert fadeout"></span>
<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Payment Display</h2>

<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Payment Frequency</th>
            <th>Year</th>
            <th>Status</th>
        </tr>
    </thead>
</table>

<script>
 $(document).ready(function() {
        $('#myTable').DataTable({
            "ajax": {
                "url": "services/paymentEmployee/retrieveAll.php",
                "dataSrc": "data"
            },
            "columns": [
                { 
                    "data": "payFreq",
                    "render":   function(data, type, row, meta){
                                    if(type === 'display'){
                                        data = '<a href="#!viewSingle/' + row.eid + "|" + row.month + "|" + row.fromDate + "|" + row.toDate + '">' + data + '</a>';
                                    }

                                    return data;
                                }

                },
                { "data": "year" },
                { "data": "status"}
            ],
        });
    });

    $(".fadeout").delay(3000).slideUp(200);
</script>