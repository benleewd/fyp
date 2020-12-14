function populateSchedule() {
    var scheduleBody = document.getElementById('scheduleBody');
    scheduleBody.innerHTML = ""

    var headerTR = document.createElement('tr')
    var headers = [" ", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
    for (let index = 0; index < headers.length; index++) {
        var headerTH = document.createElement('th')
        headerTH.innerText = headers[index]
        headerTR.appendChild(headerTH)
    }
    scheduleBody.appendChild(headerTR);

    var selectedSite = document.getElementById('siteSelected').value.split('|')
    var siteID = selectedSite[0]
    var startDate = selectedSite[1]
    var endDate = selectedSite[2]


    $.ajax({
        'async': true,
        'type': "GET",
        'url': "services/schedule/retrieveByDateSite.php?startDate=" + startDate + "&endDate=" + endDate + "&siteID=" + siteID,
        'success': function (data) {
            if (data.data.length == 0) {
                var tr = document.createElement("tr");
                tr.classList.add("text-wrap");
                var th = document.createElement("th");
                th.classList.add("text-center");
                th.innerText = "No schedule between " + startDate + " to " + endDate;
                th.colSpan = 8
                tr.appendChild(th);
                scheduleBody.appendChild(tr);
            } else {
                var tempStartDate = new Date(startDate)

                var datesArr = [startDate]
                for (let index = 0; index < 6; index++) {
                    tempStartDate.setHours(tempStartDate.getHours() + 24)
                    var dateToHandle = tempStartDate.toISOString().split("T")[0]
                    datesArr.push(dateToHandle)
                }

                for (var shift in data.data) {
                    var tr = document.createElement("tr");
                    tr.classList.add("text-wrap");
                    var th = document.createElement("th");
                    th.classList.add("text-left");
                    th.innerText = shift;
                    tr.appendChild(th);
                    for (let index = 0; index < datesArr.length; index++) {
                        var dateToHandle = datesArr[index]
                        var nameData = data.data[shift][dateToHandle]
                        var fullName = nameData[0]['firstName'] + " " + nameData[0]['lastName']
                        var td = document.createElement('td');
                        td.innerText = fullName;
                        tr.appendChild(td);
                    }
                    scheduleBody.appendChild(tr);
                }
            }
        }
    });


}

$(document).ready(function () {
    populateSchedule()

});

$('option').each(function () {
    var optionText = this.text;
    var newOption = optionText.substring(0, 16);
    $(this).text(newOption + '...');
});

var onLeave = function () {
    var tmp = null;
    $.ajax({
        'async': false,
        'type': "GET",
        'url': "services/leaveAdministration/retrieveAllTodayLeave.php",
        'success': function (data) {
            tmp = data.data.length;
        }
    });
    return tmp;
}();

var onSite = function () {
    var tmp = null;
    $.ajax({
        'async': false,
        'type': "GET",
        'url': "services/attendance/retrieveDailySiteAttendance.php",
        'success': function (data) {
            tmp = data.data.length;
        }
    });
    return tmp;
}();

var colors = ['#9b1c31', '#88d8c0'];

var chDonutData1 = {
    labels: ['On Leave', 'On Site'],
    datasets: [{
        backgroundColor: colors,
        borderWidth: 1,
        data: [onLeave, onSite]
    }]
};

var chDonut1 = document.getElementById("chDonut1");
if (chDonut1) {
    new Chart(chDonut1, {
        type: 'doughnut',
        data: chDonutData1,
        options: {
            legend: {
                position: 'bottom'
            },
            cutoutPercentage: 65
        }
    });
}

$("#siteSelected").on("change", function(){
    populateSchedule();
})
