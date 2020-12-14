var createStatus = ""

accessControl.controller('AccessControlMainController', function ($scope, $http) {
    $scope.createStatus = createStatus

    $http.get('services/accessControl/retrieveUniqueDesignation.php')
        .then(
            function (response) {
                $scope.designationData = response.data.data
            },
            function (response) {
                $scope.designationData = ["Do not create! Something went wrong"]
            }
        );

    $scope.displayData = function () {
        $http.get('services/accessControl/retrieveByDesignation.php?designation=' + $scope.designation)
            .then(
                function (response) {
                    $scope.accessControlData = response.data.data

                    var uniqueModule = []
                    $scope.accessControlData.forEach(element => {
                        if (!uniqueModule.includes(element.module)) {
                            uniqueModule.push(element.module)
                        }
                        
                        if (element.accessible == 1) {
                            element.accessible = true
                        } else {
                            element.accessible = false
                        }
                        
                    });
                    $scope.uniqueModule = uniqueModule

                },
                function (response) {
                    $scope.accessControlData = ["Do not create! Something went wrong"]
                }
            );
    }

    $scope.update = function () {
        if (confirm("Are you sure you want to make the changes?")) {
            var data = JSON.stringify($scope.accessControlData)

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    alert(JSON.parse(this.responseText).message);
                }
            };
            xhttp.open("PUT", "services/accessControl/update.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("data=" + data);
        } 
    }

    $scope.delete = function () {
        if (confirm("Are you sure you want to delete?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    alert(JSON.parse(this.responseText).message);
                    window.location = "#!";
                }
            };
            xhttp.open("DELETE", "services/accessControl/delete.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("designation=" + $scope.designation);
        } 
    }

    $scope.createDesignation = function () {
        window.location = "#!create/";
    }
});

accessControl.controller('AccessControlCreateController', function ($scope, $http) {
    $scope.designationCreation = function() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                createStatus = JSON.parse(this.responseText).message;
                window.location = "#!";
            }
        };
        xhttp.open("POST", "services/accessControl/create.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("designation=" + $scope.newDesignationName);
    }

    $scope.back = function() {
        window.location = "#!";
    }
});