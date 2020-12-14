var createStatus = "";
var updateStatus = "";
var deleteStatus = "";

attendance.controller('AttendanceMainController', function ($scope, $http) {
    $scope.statusUpdate = updateStatus
    $scope.statusCreate = createStatus
    $scope.statusDelete = deleteStatus

    $(document).ready(function() {
        $('#myTable').DataTable({
            "ajax": {
                "url": "services/attendance/retrieveAll.php",
                "dataSrc": "data"
            },
            "columns": [
                { 
                    "data": "nric",
                    "render":   function(data, type, row, meta){
                                    if(type === 'display'){
                                        data = '<a href="#!viewSingle/' + row.eid + '|' + row.projectID + '|' + row.dateCompletedShift + '|' + row.shiftName + '|' + row.nric + '|' + row.projectName + '">' + data + '</a>';
                                    }

                                    return data;
                                }
                },
                { "data": "projectName" },
                { "data": "clockIn" },
                { "data": "clockOut" },
            ],
        });
    });

    $(".fadeout").delay(3000).slideUp(200);
});


attendance.controller('AttendanceCreateController', function ($scope, $http) {
    $http.get('services/shiftType/retrieveUniqueShiftName.php')
        .then(
            function (response) {
                $scope.shiftData = response.data.data
            },
            function (response) {
                $scope.shiftData = ["Do not create! Something went wrong"]
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

    $http.get('services/site/retrieveAll.php')
    .then(
        function (response) {
            var attendance = response.data.data
            var projectNameArray = Array();
            attendance.forEach(element => {
                projectNameArray.push(element.projectName);
            });
            $scope.attendanceData = projectNameArray;
            
        },
        function (response) {
            $scope.attendanceData = ["Do not create! Something went wrong"]
        }
    );


    $scope.attendanceCreation = function () {
        $http.get('services/employee/basic/retrieveByIC.php?ic=' + $scope.newNRIC)
            .then(
                function (response) {
                    var eid = response.data.data
                    var date = new Date($scope.dateCompletedShift)
                    date.setHours( date.getHours() + 8 )
                    var dateCompletedShift = date.toISOString().split("T")[0]

                    var clockInFullTime = new Date($scope.clockIn)
                    clockInFullTime.setHours( clockInFullTime.getHours() + 7 )
                    clockInFullTime.setMinutes( clockInFullTime.getMinutes() + 30 )
                    var clockIn = clockInFullTime.toISOString().split("T")[1].split(".")[0]

                    $http.get('services/site/retrieveByProjectName.php?projectName=' + $scope.projectName)
                    .then(
                        function (response) {
                            $scope.projectID = response.data.data

                            if ($scope.clockOut == null) {
                                var data = JSON.stringify({
                                    eid: parseInt(eid),
                                    dateCompletedShift: dateCompletedShift,
                                    shiftName: $scope.shifts,
                                    projectID: parseInt($scope.projectID),
                                    clockIn: clockIn
                                })
                            } else {
                                var clockOutFullTime = new Date($scope.clockOut)
                                clockOutFullTime.setHours( clockOutFullTime.getHours() + 7 )
                                clockOutFullTime.setMinutes( clockOutFullTime.getMinutes() + 30 )
                                var clockOut = clockOutFullTime.toISOString().split("T")[1].split(".")[0]
        
                                var data = JSON.stringify({
                                    eid: parseInt(eid),
                                    dateCompletedShift: dateCompletedShift,
                                    shiftName: $scope.shifts,
                                    projectID: $scope.projectID,
                                    clockIn: clockIn, 
                                    clockOut: clockOut
                                })
                            }
        
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
                                    window.location = "#!";
                                }
                            };
                            xhttp.open("POST", "services/attendance/create.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send("data=" + data);
                        },
                        function (response) {
                            $scope.projectID = ["Do not create! Something went wrong"]
                        }
                    );

                    
                }
            );

        

    }

    $scope.back = function() {
        window.location = "#!";
    }

    $scope.reset = function() {
        $scope.eid = ""
        $scope.shifts = ""
        $scope.dateCompletedShift = "",
        $scope.projectID = ""
        $scope.clockIn = ""
        $scope.clockOut = ""
    }
});


attendance.controller('AttendanceUpdateController', function ($scope, $http, $routeParams) {
    var pk = $routeParams.pk;
    $scope.eid = pk.split("|")[0]
    $scope.projectID = pk.split("|")[1]
    $scope.dateCompletedShift = pk.split("|")[2]
    $scope.shiftName = pk.split("|")[3]
    $scope.nric = pk.split("|")[4]
    $scope.projectName = pk.split("|")[5]

    $http.get('services/attendance/retrieveByPK.php?eid=' + $scope.eid + '&projectID=' + $scope.projectID + '&dateCompletedShift=' + $scope.dateCompletedShift + '&shiftName=' + $scope.shiftName )
        .then(
            function (response) {
                var data = response.data.data
                //Date in clock in and out are just placeholders
                $scope.clockIn = new Date("2020-01-01T" + data.clockIn + "")
                $scope.clockOut = new Date("2020-01-01T" + data.clockOut + "")
                $scope.createdBy = data.createdBy
                $scope.createdDT = data.createdDT
                $scope.lastModifiedBy = data.lastModBy
                $scope.lastModifiedDT = data.lastModDT
            },
            function (response) {
                $scope.error = response.data.message
            }
        );

    $scope.attendanceUpdate = function () {

        var clockInFullTime = new Date($scope.clockIn)
        clockInFullTime.setHours( clockInFullTime.getHours() + 7 )
        clockInFullTime.setMinutes( clockInFullTime.getMinutes() + 30 )
        var clockIn = clockInFullTime.toISOString().split("T")[1].split(".")[0]

        if ($scope.clockOut == null) {
            var data = JSON.stringify({
                eid: parseInt($scope.eid),
                dateCompletedShift: $scope.dateCompletedShift,
                shiftName: $scope.shiftName,
                projectID: parseInt($scope.projectID),
                clockIn: clockIn
            })
        } else {
            var clockOutFullTime = new Date($scope.clockOut)
            clockOutFullTime.setHours( clockOutFullTime.getHours() + 7 )
            clockOutFullTime.setMinutes( clockOutFullTime.getMinutes() + 30 )
            var clockOut = clockOutFullTime.toISOString().split("T")[1].split(".")[0]

            var data = JSON.stringify({
                eid: parseInt($scope.eid),
                dateCompletedShift: $scope.dateCompletedShift,
                shiftName: $scope.shiftName,
                projectID: parseInt($scope.projectID),
                clockIn: clockIn, 
                clockOut: clockOut
            })
        }
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
        xhttp.open("PUT", "services/attendance/update.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("data=" + data);
    
    }

    $scope.back = function() {
        window.location = "#!viewSingle/" + pk;
    }

    $scope.reset = function() {
        $scope.eid = ""
        $scope.shifts = ""
        $scope.dateCompletedShift = "",
        $scope.projectID = ""
        $scope.clockIn = ""
        $scope.clockOut = ""
    }
});

attendance.controller('AttendanceViewSingleController', function ($scope, $http, $routeParams) {
    $(".fadeout").delay(3000).slideUp(200);

    createStatus = "";
    $scope.statusUpdate = updateStatus
    var pk = $routeParams.pk;
    $scope.eid = pk.split("|")[0]
    $scope.projectID = pk.split("|")[1]
    $scope.dateCompletedShift = pk.split("|")[2]
    $scope.shiftName = pk.split("|")[3]
    $scope.nric = pk.split("|")[4]
    $scope.projectName = pk.split("|")[5]

    $http.get('services/attendance/retrieveByPK.php?eid=' + $scope.eid + '&projectID=' + $scope.projectID + '&dateCompletedShift=' + $scope.dateCompletedShift + '&shiftName=' + $scope.shiftName )
        .then(
            function (response) {
                var data = response.data.data
                $scope.clockIn = data.clockIn
                $scope.clockOut = data.clockOut
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
            xhttp.open("DELETE", "services/attendance/delete.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('eid=' + $scope.eid + '&projectID=' + $scope.projectID + '&dateCompletedShift=' + $scope.dateCompletedShift + '&shiftName=' + $scope.shiftName);
        } 
    }
});