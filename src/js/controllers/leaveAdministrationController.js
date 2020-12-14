var createStatus = "";
var updateStatus = "";
var deleteStatus = "";

leaveAdministration.controller('LeaveAdministrationMainController', function ($scope, $http) {
    $scope.statusUpdate = updateStatus
    $scope.statusCreate = createStatus
    $scope.statusDelete = deleteStatus
});

leaveAdministration.controller('LeaveAdministrationHistoryController', function ($scope, $http) {
    $scope.statusUpdate = updateStatus
    $scope.statusCreate = createStatus
    $scope.statusDelete = deleteStatus
});


leaveAdministration.controller('LeaveAdministrationCreateController', function ($scope, $http) {
    $http.get('services/leaveType/retrieveUniqueLeaveType.php')
        .then(
            function (response) {
                $scope.leaveTypeData = response.data.data
            },
            function (response) {
                $scope.leaveTypeData = ["Do not create! Something went wrong"]
            }
        );

    $http.get('services/employee/basic/retrieveAllNRIC.php')
        .then(
            function (response) {
                $scope.nricData = response.data.data
            },
            function (response) {
                $scope.nricData = ["Do not create! Something went wrong"]
            }
        );

    $scope.leaveCreation = function () {
        var fromDatePrior = new Date($scope.newFromDate)
        fromDatePrior.setHours( fromDatePrior.getHours() + 8 )
        var fromDate = fromDatePrior.toISOString().split("T")[0]

        var toDatePrior = new Date($scope.newToDate)
        toDatePrior.setHours( toDatePrior.getHours() + 8 )
        var toDate = toDatePrior.toISOString().split("T")[0]

        if ($scope.newRemarks == undefined) {
            var remarks = ""
        } else {
            var remarks = $scope.newRemarks
        }

        $http.get('services/employee/basic/retrieveByIC.php?ic=' + $scope.newNRIC)
            .then(
                function (response) {
                    var eid = response.data.data
                    var data = JSON.stringify({
                        eid: eid,
                        fromDate: fromDate,
                        toDate: toDate,
                        leaveType: $scope.newLeaveType, 
                        remarks: remarks
                    })
            
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4) {
                            createStatus = JSON.parse(this.responseText);
                            if (createStatus.status == 200){
                                $scope.statusCreate = "<div class='alert alert-success' role='alert'>" + createStatus.message + "</div>"; 


                                $http.get('services/leaveAdministration/retrieveName.php?eid=' + eid)
                                .then(
                                    function (response2) {
                                        var name = response2.data.data
                                        $http.get('services/firebaseCloudMessaging/retrieveSupervisorID.php')
                                        .then(
                                            function (response) {
                                                var supervisorID = response.data.data[0]
                                                var xhttp2 = new XMLHttpRequest();
                                                xhttp2.onreadystatechange = function () {
                                                    if (this.readyState == 4) {
                                                    }
                                                };
                                                xhttp2.open("POST", "services/firebaseCloudMessaging/sendMessage.php", true);
                                                xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                                xhttp2.send("eid=" + supervisorID + "&title=Leave Application Request&body=Pending leave application request&type=Leave");
                                                
                                                var teleMsgContent = "Hi, a new leave request is made.\n\nFrom: " + fromDate + "\nTo: " + toDate + "\nBy: " + name + " (" + $scope.newNRIC + "). \n\nPlease respond to the leave request here. Alternatively, you may log in to HRClicks at k11hrclicks.com to do so."

                                                $fromDay = parseInt(fromDate.split("-")[2])
                                                $toDay = parseInt(toDate.split("-")[2])
                                                $daysUsed = $toDay - $fromDay + 1
                                                var xhttp = new XMLHttpRequest();
                                                xhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4) {
                                                    } 
                                                };
                                                xhttp.open("POST", "processes/telegramSendMsg.php", true);
                                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                                var toSend = JSON.stringify({'eid' : supervisorID, 'message':[teleMsgContent], 'type':'approval', 'leaveEID':eid, 'fromDate':fromDate, 'leaveType':$scope.leaveType,'numDays':$daysUsed});

                                                xhttp.send(toSend);

                                                window.location = "#!";
                                            },
                                            function (response) {
                                            }
                                        );
                                    },
                                    function (response2) {
                                    }
                                );




                                
                            } else {
                                $scope.statusCreate = "<div class='alert alert-danger' role='alert'>" + createStatus.message + "</div>"; 
                            }
                            createStatus = $scope.statusCreate;
                            window.location = "#!";
                        }
                    };
                    xhttp.open("POST", "services/leaveAdministration/create.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("data=" + data);
                },
            );
    }

    $scope.back = function() {
        window.location = "#!";
    }

    $scope.reset = function() {
        $scope.newNRIC = ""
        $scope.newFromDate = ""
        $scope.newToDate = "",
        $scope.newLeaveType = ""
        $scope.newRemarks = ""
    }
});

leaveAdministration.controller('LeaveAdministrationViewSingleController', function ($scope, $http, $routeParams) {
    createStatus = "";
    $scope.statusUpdate = updateStatus

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

    $scope.back = function() {
        updateStatus = "";
        deleteStatus = "";
        window.location = "#!";
    }

    $scope.delete = function() {
        if (confirm("Are you sure you want to delete?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    deleteStatus = JSON.parse(this.responseText);
                    if (deleteStatus.status == 200){
                        $scope.statusDelete = "<div class='alert alert-success' role='alert'>" + deleteStatus.message + "</div>"; 

                        if ($scope.status == "Approved") {
                            $fromDay = parseInt($scope.fromDate.split("-")[2])
                            $toDay = parseInt($scope.toDate.split("-")[2])
                            $daysUsed = $toDay - $fromDay + 1
                            var xhttp3 = new XMLHttpRequest();
                            xhttp3.onreadystatechange = function () {
                                if (this.readyState == 4) {

                                }
                            };
                            xhttp3.open("PUT", "services/leaveManagement/increaseLeaveBalance.php", true);
                            xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp3.send("empID=" + $scope.eid + "&leaveType=" + $scope.leaveType + "&daysIncrease=" + $daysUsed);
                        }
                        
                    } else {
                        $scope.statusDelete = "<div class='alert alert-danger' role='alert'>" + deleteStatus.message + "</div>"; 
                    }
                    deleteStatus = $scope.statusDelete;
                    window.location = "#!";
                }
            };
            xhttp.open("DELETE", "services/leaveAdministration/delete.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('eid=' + $scope.eid + '&fromDate=' + $scope.fromDate);
        } 
    }
});