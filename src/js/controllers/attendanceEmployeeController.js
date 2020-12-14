attendanceEmployee.controller('AttendanceEmployeeMainController', function ($scope, $http) {
    var table = $('#myTable').DataTable({
        "ajax": {
            "url": "services/attendanceEmployee/retrieveByCurrentMonth.php",
            "dataSrc": "data"
        },
        "columns": [
            { "data": "dateCompletedShift",
            },
            { "data": "projectID" },
            { "data": "clockIn" },
            { "data": "clockOut" }
        ],
    });

    var today = new Date();
    var currentMonth = today.getMonth() + 1;
    var currentYear = today.getFullYear();

    function checkVariable() {
        if (document.getElementById(currentMonth.toString()) != null) {
            document.getElementById(currentMonth.toString()).setAttribute("selected", "selected")
            let yearDropDownList = document.getElementById("year")
            for (let index = 0; index < yearDropDownList.options.length; index++) {
                if (yearDropDownList.options[index].text == currentYear.toString()) {
                    yearDropDownList.options[index].setAttribute("selected", "selected")
                    break
                }
            }
        }
    }
     
    setTimeout(checkVariable, 1000);
    
    $http.get('services/constants/retrieveByName.php?name=attendanceYearList')
        .then(
            function (response) {
                $scope.yearListData = response.data.data
            },
            function (response) {
                $scope.yearListData = ["Something went wrong"]
            }
        );


    $scope.displayData = function () {
        table.ajax.url( 'services/attendanceEmployee/retrieveByMonth.php?monthSelected=' + parseInt($scope.selectedMonth) + "&yearSelected=" + parseInt($scope.selectedYear) ).load();
    }
});

