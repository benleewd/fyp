var deleteStatus = "";
var updateStatus = "";
var periodInfo = "";
var transportInfo = "";
var bonusInfo = "";

payment.controller('PaymentMainController', function ($scope, $http) {
    $scope.statusDelete = deleteStatus
    $scope.statusUpdate = updateStatus
    $scope.period = periodInfo
    $scope.transportInfo = transportInfo
    $scope.bonusInfo = bonusInfo;
});

payment.controller('PaymentUpdateController', function ($scope, $http, $routeParams) {
    var pk = $routeParams.pk;  
    $scope.eid = pk.split("|")[0]
    $scope.month = pk.split("|")[1]
    $scope.fromDate = pk.split("|")[2]
    $scope.toDate = pk.split("|")[3]
    var months    = ['', 'January','February','March','April','May','June','July','August','September','October','November','December'];

        $http.get('services/constants/retrieveByName.php?name=paymentStatus')
        .then(
            function (response) {
                $scope.statusData = response.data.data
            },
            function (response) {
                $scope.statusData = ["Do not create! Something went wrong"]
            }
        );

        $http.get('services/payment/retrieveByID.php?eid=' + $scope.eid + "&month=" + $scope.month + "&fromDate=" + $scope.fromDate + "&toDate=" + $scope.toDate)
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

        $scope.paymentUpdate = function () {
        
        var payAmount = parseFloat($scope.payAmount);

        if (parseFloat($scope.transportCost) > 0.0) {
            payAmount += parseFloat($scope.transportCost);
        }
         if (parseFloat($scope.bonus) > 0.0) {
            payAmount += parseFloat($scope.bonus);
        } 

        var data = JSON.stringify({
            eid: parseInt($scope.eid),
            month: $scope.month,
            year: $scope.year,
            payFreq: $scope.payFreq,
            payType: $scope.payType,
            noOfPH: $scope.noOfPH,
            payAmount: payAmount,
            basicHourlyRate: parseFloat($scope.basicHourlyRate),
            OTPerShift: parseFloat($scope.OTPerShift),
            fromDate: $scope.fromDate,
            toDate: $scope.toDate,
            transportCost: parseFloat($scope.transportCost),
            bonus: parseFloat($scope.bonus),
            status: $scope.status
        })

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                updateStatus = JSON.parse(this.responseText);
                if (updateStatus.status == 200){
                    $scope.statusUpdate = "<div class='alert alert-success' role='alert'>" + updateStatus.message + "</div>"; 
                } else {
                    $scope.statusUpdate = "<div class='alert alert-danger' role='alert'>" + updateStatus.message + "</div>"; 
                }
                updateStatus = $scope.statusUpdate;
                window.location = "#!viewSingle/" + pk;
            }
        };
        xhttp.open("PUT", "services/payment/update.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("data=" + data);
    }

    $scope.back = function() {
        window.location = "#!viewSingle/" + pk;
    }

});

payment.controller('PaymentViewSingleController', function ($scope, $http, $routeParams) {
    $scope.statusUpdate = updateStatus
    var pk = $routeParams.pk;  
    $scope.eid = pk.split("|")[0]
    $scope.month = pk.split("|")[1]
    $scope.fromDate = pk.split("|")[2]
    $scope.toDate = pk.split("|")[3]

    $http.get('services/payment/retrieveByID.php?eid=' + $scope.eid + "&month=" + $scope.month + "&fromDate=" + $scope.fromDate + "&toDate=" + $scope.toDate)
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