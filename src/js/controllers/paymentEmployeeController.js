var periodInfo = "";
var transportInfo = "";
var bonusInfo = "";

paymentEmployee.controller('PaymentEmployeeMainController', function ($scope, $http) {
    $scope.period = periodInfo
    $scope.transportInfo = transportInfo
    $scope.bonusInfo = bonusInfo;
});

paymentEmployee.controller('PaymentEmployeeViewSingleController', function ($scope, $http, $routeParams) {
    var pk = $routeParams.pk;  
    $scope.eid = pk.split("|")[0]
    $scope.month = pk.split("|")[1]
    $scope.fromDate = pk.split("|")[2]
    $scope.toDate = pk.split("|")[3]

    $http.get('services/paymentEmployee/retrieveByID.php?eid=' + $scope.eid + "&month=" + $scope.month + "&fromDate=" + $scope.fromDate + "&toDate=" + $scope.toDate)
        .then(
            function (response) {
                $http.get('services/employee/basic/retrieve.php?eid=' + $scope.eid)
                .then(
                    function (response) {
                        $scope.idNo = response.data.data.idNo
                    },
                    function (response) {
                        $scope.idNo = ["Do not create! Something went wrong"]
                    }
                );

                var months    = ['', 'January','February','March','April','May','June','July','August','September','October','November','December'];

                var data = response.data.data
                $scope.month = data.month
                $scope.year = data.year
                $scope.payFreq = data.payFreq
                $scope.payType = data.payType
                $scope.noOfPH = data.noOfPH
                $scope.payAmount = data.payAmount
                $scope.basicHourlyRate = data.basicHourlyRate
                $scope.OTPerShift = data.OTPerShift
                $scope.fromDate = data.fromDate
                $scope.toDate = data.toDate
                if ($scope.fromDate != "1970-01-01") {
                    $scope.period = $scope.fromDate + " to " + $scope.toDate ; 
                } else {
                    $scope.period = months[$scope.month] + " " + $scope.year; 
                }
                $scope.transportCost = data.transportCost
                $scope.bonus = data.bonus
                if ($scope.payFreq == "Weekly"){
                    $scope.transportInfo = 'd-none';
                    $scope.bonusInfo = 'd-none';
                }
                $scope.status = data.status
                $scope.createdBy = data.createdBy
                $scope.createdDT = data.createdDT
                $scope.lastModifiedBy = data.lastModBy
                $scope.lastModifiedDT = data.lastModDT
            },
            function (response) {
                $scope.error = response
            }
        );

    $scope.back = function() {
        updateStatus = "";
        deleteStatus = "";
        window.location = "#!";
    }

    $scope.makeChanges = function() {
        window.location = "#!update/" + pk;
    }

    $scope.delete = function() {
        if (confirm("Are you sure you want to delete?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    deleteStatus = JSON.parse(this.responseText);
                    if (deleteStatus.status == 200){
                        $scope.statusDelete = "<div class='alert alert-success' role='alert'>" + deleteStatus.message + "</div>"; 
                    } else {
                        $scope.statusDelete = "<div class='alert alert-danger' role='alert'>" + deleteStatus.message + "</div>"; 
                    }
                    deleteStatus = $scope.statusDelete;
                    window.location = "#!";
                }
            };
            xhttp.open("DELETE", "services/payment/delete.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('eid=' + $scope.eid + "&month=" + $scope.month + "&fromDate=" + $scope.fromDate + "&toDate=" + $scope.toDate);
        } 
    }
   
});