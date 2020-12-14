var createStatus = "";
var updateStatus = "";
var deleteStatus = "";

site.controller('SiteMainController', function ($scope, $http) {
    $scope.statusUpdate = updateStatus
    $scope.statusCreate = createStatus
    $scope.statusDelete = deleteStatus
});


site.controller('SiteCreateController', function ($scope, $http) {
    $http.get('services/shiftType/retrieveUniqueShiftName.php')
        .then(
            function (response) {
                $scope.shiftData = response.data.data
            },
            function (response) {
                $scope.shiftData = ["Do not create! Something went wrong"]
            }
        );

    $scope.siteCreation = function () {
        var address = $scope.address;
        var apiKey = "AIzaSyBCC0PZhAHqGmcWQDXcfraFgoIyONROQBU";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (JSON.parse(this.responseText).status == "ZERO_RESULTS") {
                    alert("Invalid address. Please try again")
                    document.getElementById("addressField").focus()
                } else {
                    var results = JSON.parse(this.responseText)
                    var outputAddress = results.results[0].formatted_address
                    var lat = results.results[0].geometry.location.lat
                    var long = results.results[0].geometry.location.lng
                    
                    if ($scope.publicHoliday) {
                        var publicHoliday = true;
                    } else {
                        var publicHoliday = false;
                    }
            
                    if ($scope.active) {
                        var active = true;
                    } else {
                        var active = false;
                    }
            
                    var data = JSON.stringify({
                        projectName: $scope.projectName,
                        shifts: $scope.shifts,
                        publicHoliday: publicHoliday,
                        siteAllowance: $scope.siteAllowance,
                        employeesRequired: $scope.employeesRequired,
                        qrCode: $scope.qrCode,
                        address: outputAddress,
                        lat: lat,
                        long: long,
                        active: active
                    })
            
                    var xhttp2 = new XMLHttpRequest();
                    xhttp2.onreadystatechange = function () {
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
                    xhttp2.open("POST", "services/site/create.php", true);
                    xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp2.send("data=" + data);
                }
            } 
        };

        xhttp.open("GET", "https://maps.googleapis.com/maps/api/geocode/json?address=" + encodeURI(address) + "&key=" + apiKey, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
        
    }

    $scope.back = function() {
        window.location = "#!";
    }

    $scope.reset = function() {
        $scope.projectName = ""
        $scope.shifts = ""
        $scope.publicHoliday = false,
        $scope.siteAllowance = ""
        $scope.employeesRequired = ""
        $scope.qrcode = ""
        $scope.active = false
    }
});


site.controller('SiteUpdateController', function ($scope, $http, $routeParams) {
    $scope.projectID = $routeParams.projectID;
    var addressChange = false

    $http.get('services/shiftType/retrieveUniqueShiftName.php')
        .then(
            function (response) {
                $scope.shiftData = response.data.data
            },
            function (response) {
                $scope.shiftData = ["Do not create! Something went wrong"]
            }
        );

    $http.get('services/site/retrieveByID.php?projectID=' + $scope.projectID)
        .then(
            function (response) {
                var data = response.data.data
                $scope.projectName = data.projectName
                $scope.shifts = data.shifts
                $scope.qrCode = data.qrCode
                if (data.publicHoliday == 1) {
                    $scope.publicHoliday = true
                } else {
                    $scope.publicHoliday = false
                }
                $scope.siteAllowance = parseFloat(data.siteAllowance)
                $scope.employeesRequired = parseInt(data.employeesRequired)
                $scope.address = data.address
                $scope.lat = data.lat
                $scope.long = data.long
                if (data.active == 1) {
                    $scope.active = true
                } else {
                    $scope.active = false
                }
                $scope.createdBy = data.createdBy
                $scope.createdDT = data.createdDT
                $scope.lastModifiedBy = data.lastModBy
                $scope.lastModifiedDT = data.lastModDT
            },
            function (response) {
                $scope.error = response.data.message
            }
        );

    $scope.addressChange = function () {
        addressChange = true
    }

    $scope.siteUpdate = function () {
        if ($scope.publicHoliday) {
            var publicHoliday = true;
        } else {
            var publicHoliday = false;
        }

        if ($scope.active) {
            var active = true;
        } else {
            var active = false;
        }

        var data = JSON.stringify({
            projectID: $scope.projectID,
            projectName: $scope.projectName,
            shifts: $scope.shifts,
            publicHoliday: publicHoliday,
            siteAllowance: $scope.siteAllowance,
            employeesRequired: $scope.employeesRequired,
            qrCode: $scope.qrCode,
            address: $scope.address,
            lat: $scope.lat,
            long: $scope.long,
            active: active
        })

        if (addressChange) {
            var address = $scope.address;
            var apiKey = "AIzaSyBCC0PZhAHqGmcWQDXcfraFgoIyONROQBU";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var results = JSON.parse(this.responseText)
                    var outputAddress = results.results[0].formatted_address
                    var lat = results.results[0].geometry.location.lat
                    var long = results.results[0].geometry.location.lng
                    data = JSON.stringify({
                        projectID: $scope.projectID,
                        projectName: $scope.projectName,
                        shifts: $scope.shifts,
                        publicHoliday: publicHoliday,
                        siteAllowance: $scope.siteAllowance,
                        employeesRequired: $scope.employeesRequired,
                        qrCode: $scope.qrCode,
                        address: outputAddress,
                        lat: lat,
                        long: long,
                        active: active
                    })

                } 
            };

            xhttp.open("GET", "https://maps.googleapis.com/maps/api/geocode/json?address=" + encodeURI(address) + "&key=" + apiKey, false);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();
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
                window.location = "#!viewSingle/" + $scope.projectID;
            }
        };
        xhttp.open("PUT", "services/site/update.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("data=" + data);
    }

    $scope.back = function() {
        updateStatus = "";
        window.location = "#!viewSingle/" + $scope.projectID;
    }

    $scope.reset = function() {
        $scope.projectName = ""
        $scope.shifts = ""
        $scope.publicHoliday = false,
        $scope.siteAllowance = ""
        $scope.employeesRequired = ""
        $scope.qrCode = ""
        $scope.active = false
    }
});

site.controller('SiteViewSingleController', function ($scope, $http, $routeParams) {
    createStatus = "";
    $scope.statusUpdate = updateStatus
    $scope.projectID = $routeParams.projectID;

    $http.get('services/site/retrieveByID.php?projectID=' + $scope.projectID)
        .then(
            function (response) {
                var data = response.data.data
                $scope.projectName = data.projectName
                $scope.shifts = data.shifts
                $scope.qrCode = data.qrCode
                if (data.publicHoliday == 1) {
                    $scope.publicHoliday = "Yes"
                } else {
                    $scope.publicHoliday = "No"
                }
                $scope.siteAllowance = data.siteAllowance
                $scope.employeesRequired = data.employeesRequired
                $scope.address = data.address
                if (data.active == 1) {
                    $scope.active = "Yes"
                } else {
                    $scope.active = "No"
                }
                $scope.createdBy = data.createdBy
                $scope.createdDT = data.createdDT
                $scope.lastModifiedBy = data.lastModBy
                $scope.lastModifiedDT = data.lastModDT

                //generate QR code
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        updateStatus = JSON.parse(this.responseText);
                        if (updateStatus.status != 200) {
                            alert("Error creating QR code. Try again later. Please alert admin if problem persists.")
                        } else {
                            document.getElementById('qrCode').href = "templates/site/img/" + $scope.projectID + ".png"
                            document.getElementById('qrCode').download = $scope.projectName + ".png"
                        }
                    }
                };
                xhttp.open("POST", "services/site/generateQRCode.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("projectID=" + $scope.projectID);
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
        window.location = "#!update/" + $scope.projectID;
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
            xhttp.open("DELETE", "services/site/delete.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("projectID=" + $scope.projectID);
        } 
    }
   
});