var createStatus = "";
var updateStatus = "";
var deleteStatus = "";

telegram.controller('TelegramMainController', function ($scope, $http) {
    $scope.statusUpdate = updateStatus
    $scope.statusCreate = createStatus
    $scope.statusDelete = deleteStatus
});


telegram.controller('TelegramCreateController', function ($scope, $http) {

    var idList = {}

    $http.get('services/telegram/retrieveNoTelegramID.php')
        .then(
            function (response) {
                var output = response.data.data
                var display = []
                output.forEach(element => {
                    idList[element.idNo] = element.eid
                    display.push(element.idNo)
                });

                if (display.length > 0) {
                    $scope.teleData = display
                } else {
                    $scope.teleData = ["All telegram IDs are registered"]
                }
                
            },
            function (response) {
                $scope.teleData = ["Do not create! Something went wrong"]
            }
        );

    $scope.telegramCreation = function () {
        var data = JSON.stringify({
            eid: idList[$scope.nric],
            telegramID: $scope.teleID,
            chatID: ""
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
        xhttp2.open("POST", "services/telegram/create.php", true);
        xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp2.send("telegram=" + data);
        
    }

    $scope.back = function() {
        window.location = "#!";
    }
});


telegram.controller('TelegramUpdateController', function ($scope, $http, $routeParams) {
    $scope.tid = $routeParams.tid;

    $http.get('services/telegram/retrieveByTIDForSite.php?tid=' + $scope.tid)
        .then(
            function (response) {
                var data = response.data.data
                $scope.nric = data.nric
                $scope.eid = data.eid
                $scope.telegramID = data.telegramID
                $scope.chatID = data.chatID
            },
            function (response) {
                $scope.error = response.data.message
            }
        );

    $scope.telegramUpdate = function () {
        var data = JSON.stringify({
            tid: $scope.tid,
            telegramID: $scope.telegramID,
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
                window.location = "#!";
            }
        };
        xhttp.open("PUT", "services/telegram/updateForSite.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("data=" + data);
    }

    $scope.back = function() {
        updateStatus = "";
        window.location = "#!";
    }
});
