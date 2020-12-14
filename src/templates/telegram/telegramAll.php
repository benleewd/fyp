<span ng-bind-html="statusCreate" class="fixed-alert fadeout"></span>
<span ng-bind-html="statusDelete" class="fixed-alert fadeout"></span>

<h2>Telegram Display</h2>

<a href="#!create" class="btn btn-dark">Create New Telegram</a>

<table id="myTable" class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Employee ID</th>
            <th>Telegram ID</th>
        </tr>
    </thead>
</table>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "ajax": {
                "url": "services/telegram/retrieveAllForSite.php",
                "dataSrc": "data"
            },
            "columns": [
                { 
                    "data": "nric",
                    "render":   function(data, type, row, meta){
                                    if(type === 'display'){
                                        data = '<a href="#!update/' + row.tid + '">' + data + '</a>';
                                    }

                                    return data;
                                }
                },
                { "data": "telegramID" }
            ],
        });
    });
</script>
<script>
    $(".fadeout").delay(3000).slideUp(200);
</script>