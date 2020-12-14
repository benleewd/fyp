var updateStatus = "";

leaveRequest.controller('LeaveRequestMainController', function ($scope, $http) {
    $scope.statusUpdate = updateStatus
    
});

leaveRequest.controller('LeaveRequestViewSingleController', function ($scope, $http, $routeParams) {
    var pk = $routeParams.pk;
    $scope.eid = pk.split("|")[0]
    $scope.fromDate = pk.split("|")[1]

    $http.get('services/leaveAdministration/retrieveByPK.php?empID=' + $scope.eid + '&fromDate=' + $scope.fromDate )
        .then(
            function (response) {
                var data = response.data.data
                $scope.toDate = data.toDate
                $scope.status = data.status
                $scope.leaveType = data.leaveType
                $scope.remarks = data.remarks
                $scope.createdBy = data.createdBy
                $scope.createdDT = data.createdDT
                $scope.lastModifiedBy = data.lastModBy
                $scope.lastModifiedDT = data.lastModDT
            },
            function (response) {
                $scope.error = response.data.message
            }
        );


    $scope.approve = function() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                updateStatus = JSON.parse(this.responseText);
                if (updateStatus.status == 200){
                    var xhttp2 = new XMLHttpRequest();
                    xhttp2.onreadystatechange = function () {
                        if (this.readyState == 4) {
                        }
                    };
                    xhttp2.open("POST", "services/firebaseCloudMessaging/sendMessage.php", true);
                    xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp2.send("eid=" + $scope.eid + "&title=Leave Application Successful&body=Leave application from " + $scope.fromDate + " to " + $scope.toDate + " is approved&type=Leave Outcome");

                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4) {
                        } 
                    };
                    xhttp.open("POST", "processes/telegramSendMsg.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    var toSend = JSON.stringify({'eid' : $scope.eid, 'message':["Leave application from " + $scope.fromDate + " to " + $scope.toDate + " is approved."], 'type':'basic'});
                    xhttp.send(toSend);

                    $fromDay = parseInt($scope.fromDate.split("-")[2])
                    $toDay = parseInt($scope.toDate.split("-")[2])
                    $daysUsed = $toDay - $fromDay + 1

                    var xhttp3 = new XMLHttpRequest();
                    xhttp3.onreadystatechange = function () {
                        if (this.readyState == 4) {
                            updateStatus = JSON.parse(this.responseText);
                        }
                    };
                    xhttp3.open("PUT", "services/leaveRequest/updateLeaveBalance.php", true);
                    xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp3.send("empID=" + $scope.eid + "&leaveType=" + $scope.leaveType + "&daysDeducted=" + $daysUsed);

                    $scope.statusUpdate = "<div class='alert alert-success' role='alert'>" + updateStatus.message + "</div>"; 
                } else {
                    $scope.statusUpdate = "<div class='alert alert-danger' role='alert'>" + updateStatus.message + "</div>"; 
                }
                updateStatus = $scope.statusUpdate;
                window.location = "#!";
            }
        };
        xhttp.open("PUT", "services/leaveRequest/updateLeaveStatus.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("empID=" + $scope.eid + "&fromDate=" + $scope.fromDate + "&status=Approved");
    }

    $scope.reject = function() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                updateStatus = JSON.parse(this.responseText);
                if (updateStatus.status == 200){
                    var xhttp2 = new XMLHttpRequest();
                    xhttp2.onreadystatechange = function () {
                        if (this.readyState == 4) {
                        }
                    };
                    xhttp2.open("POST", "services/firebaseCloudMessaging/sendMessage.php", true);
                    xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp2.send("eid=" + $scope.eid + "&title=Leave Application Successful&body=Leave application from " + $scope.fromDate + " to " + $scope.toDate + " is rejected&type=Leave Outcome");

                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4) {
                        } 
                    };
                    xhttp.open("POST", "processes/telegramSendMsg.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    var toSend = JSON.stringify({'eid' : $scope.eid, 'message':["Leave application from " + $scope.fromDate + " to " + $scope.toDate + " is rejected."], 'type':'basic'});
                    xhttp.send(toSend);

                    $scope.statusUpdate = "<div class='alert alert-success' role='alert'>" + updateStatus.message + "</div>"; 
                } else {
                    $scope.statusUpdate = "<div class='alert alert-danger' role='alert'>" + updateStatus.message + "</div>"; 
                }
                updateStatus = $scope.statusUpdate;
                window.location = "#!";
            }
        };
        xhttp.open("PUT", "services/leaveRequest/updateLeaveStatus.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("empID=" + $scope.eid + "&fromDate=" + $scope.fromDate + "&status=Rejected");
    }

    $scope.back = function() {
        updateStatus = "";
        deleteStatus = "";
        window.location = "#!";
    }

});