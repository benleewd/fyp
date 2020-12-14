var createStatus = "";
var deleteStatus = "";

leaveManagement.controller('LeaveManagementMainController', function ($scope, $http) {
    $scope.statusCreate = createStatus
    $scope.statusDelete = deleteStatus
});


leaveManagement.controller('LeaveManagementRequestController', function ($scope, $http) {

    $http.get('services/leaveType/retrieveUniqueLeaveType.php')
        .then(
            function (response) {
                $scope.leaveTypeData = response.data.data
            },
            function (response) {
                $scope.leaveTypeData = ["Do not create! Something went wrong"]
            }
        );

    $scope.leaveRequestCreation = function () {
        if ($scope.toDate < $scope.fromDate) {
            $scope.validationError = "<div class='alert alert-success' role='alert'>" + "Start date cannot be after end date" + "</div>"
        }

        var fromDatePlain = new Date($scope.fromDate)
        fromDatePlain.setHours( fromDatePlain.getHours() + 8 )
        var fromDate = fromDatePlain.toISOString().split("T")[0]

        var toDatePlain = new Date($scope.toDate)
        toDatePlain.setHours( toDatePlain.getHours() + 8 )
        var toDate = toDatePlain.toISOString().split("T")[0]

        var data = JSON.stringify({
            fromDate : fromDate,
            toDate : toDate,
            leaveType : $scope.leaveType,
            remarks : $scope.remarks,
        })

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                createStatus = JSON.parse(this.responseText);
                if (createStatus.status == 200){
                    $scope.statusCreate = "<div class='alert alert-success' role='alert'>" + createStatus.message + "</div>"; 
                } else {
                    $scope.statusCreate = "<div class='alert alert-danger' role='alert'>" + createStatus.message + "</div>"; 
                }
                createStatus = $scope.statusCreate;
                $http.get('services/leaveManagement/retrieveIC.php')
                .then(
                    function (response2) {
                        var icAndName = response2.data.data
                        var ic = icAndName.split("|")[0]
                        var firstName = icAndName.split("|")[1]
                        var lastName = icAndName.split("|")[2]
                        $http.get('services/firebaseCloudMessaging/retrieveSupervisorID.php')
                        .then(
                            function (response) {
                                var supervisorID = response.data.data[0]
                                var eID = response.data.data[1]
                                
                                var xhttp2 = new XMLHttpRequest();
                                xhttp2.onreadystatechange = function () {
                                    if (this.readyState == 4) {
                                    }
                                };
                                xhttp2.open("POST", "services/firebaseCloudMessaging/sendMessage.php", true);
                                xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhttp2.send("eid=" + supervisorID + "&title=Leave Application Request&body=Pending leave application request&type=Leave");
                                
                                $fromDay = parseInt(fromDate.split("-")[2])
                                $toDay = parseInt(toDate.split("-")[2])
                                $daysUsed = $toDay - $fromDay + 1
                                var teleMsgContent = "Hi, a new leave request is made.\n\nFrom: " + fromDate + "\nTo: " + toDate + "\nBy: " + firstName + " " + lastName + " (" + ic + "). \n\nPlease respond to the leave request here. Alternatively, you may log in to HRClicks at k11hrclicks.com to do so."
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4) {
                                    } 
                                };
                                xhttp.open("POST", "processes/telegramSendMsg.php", true);
                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                var toSend = JSON.stringify({'eid' : supervisorID, 'message':[teleMsgContent], 'type':'approval', 'leaveEID':eID, 'fromDate':fromDate, 'leaveType':$scope.leaveType,'numDays':$daysUsed});

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
            }
        };
        xhttp.open("POST", "services/leaveManagement/create.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("data=" + data);

    }
    
    $scope.back = function() {
        window.location = "#!";
    }

});

leaveManagement.controller('LeaveManagementViewSingleController', function ($scope, $http, $routeParams) {
    $scope.fromDate = $routeParams.fromDate;

    $http.get('services/leaveManagement/retrieveByFromDatePersonal.php?fromDate=' + $scope.fromDate)
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
                $scope.fromDate = "Something went wrong. Try again later."
            }
        );

    $scope.withdraw = function () {
        if (confirm("Are you sure you want to withdraw?")) {
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
                            xhttp3.send("leaveType=" + $scope.leaveType + "&daysIncrease=" + $daysUsed);
                        }
                        
                    } else {
                        $scope.statusDelete = "<div class='alert alert-danger' role='alert'>" + deleteStatus.message + "</div>"; 
                    }
                    deleteStatus = $scope.statusDelete;
                    window.location = "#!";
                }
            };
            xhttp.open("DELETE", "services/leaveManagement/delete.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("fromDate=" + $scope.fromDate);
        } 
    }
    
    $scope.back = function() {
        window.location = "#!";
    }

});