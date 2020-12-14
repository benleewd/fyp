$(document).ready(function () {
    $('#myTable').DataTable({
        "scrollY": $(document).height() * 0.40,
        "scrollX": true,
        "language": {
            "emptyTable": "No data available. Do generate the schedule for this month"
        }
    });
});

$(".fadeout").delay(3000).slideUp(200);


var focusValue = 1

function updateToSystem(obj) {
    var valueArr = obj.value.split("|")
    var newEmpID = valueArr[0]
    var year = valueArr[1]
    var month = valueArr[2]
    var day = valueArr[3]
    var siteID = valueArr[4]
    var shift = valueArr[5]

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (JSON.parse(this.responseText).status != 200) {
                alert("Something went wrong. Unable to update changes")
            } else {
                document.activeElement.blur()
            }
        } 
    };

    xhttp.open("PUT", "services/schedule/update.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var toSend = 'newEmpID=' + newEmpID + '&year=' + year + '&month=' + month + '&day=' + day + '&siteID=' + siteID + '&shift=' + shift + '&originalEmpID=' + focusValue;
    xhttp.send(toSend);
}


function update(obj) {
    var valueArr = obj.value.split("|")
    var newEmpID = valueArr[0]
    var year = valueArr[1]
    var month = valueArr[2]
    var day = valueArr[3]
    var siteID = valueArr[4]
    var shift = valueArr[5]

    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (JSON.parse(this.responseText).data) {
                if (confirm("Employee is scheduled to other sites, is on leave or have 24 shifts allocated already. Are you sure you want to overwrite?")) {
                    updateToSystem(obj)
                } else {
                    obj.value = focusValue + "|" + year + "|" + month + "|" + day + "|" + siteID + "|" + shift
                    document.activeElement.blur()
                }
            } else {
                updateToSystem(obj)
            }
        } 
    };

    xhttp2.open("GET", "services/schedule/constraintCheck.php?year=" + year + "&month=" + month + "&day=" + day + "&eid=" + newEmpID, true);
    xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp2.send();

    
}

function currentFocus(obj) {
    var valueArr = obj.value.split("|")
    focusValue = valueArr[0]
}

function generateNewSchedule() {
    var year = document.getElementById('generateYear').value
    var month = document.getElementById('generateMonth').value

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            
            var continueGeneration = true;
            if (JSON.parse(this.responseText).data) {
                continueGeneration =  confirm("Schedule for " + month + "/" + year + " exists. Are you sure you want to overwrite existing schedule?")
            } 
            if (continueGeneration) {
                var xhttp2 = new XMLHttpRequest();
                xhttp2.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        window.location.replace("scheduleAdministration.php?month=" + month + "&year=" + year)
                    } 
                };

                xhttp2.open("GET", "services/schedule/generateSchedule.php?year=" + year + "&month=" + month, true);
                xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp2.send();
            }
        } 
    };

    xhttp.open("GET", "services/schedule/checkIfScheduleExists.php?year=" + year + "&month=" + month, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

function add() {
    var siteToAdd = document.getElementById('toAdd').value
    var year = document.getElementById('year').value
    var month = document.getElementById('month').value
    
    // 
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (this.readyState == 4 && this.status==200) {
            document.location.reload();
        }
    };
    xhttp2.open("POST", "services/schedule/addShift.php", false);
    xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp2.send("year=" + year + "&month=" + month + "&siteID=" + siteToAdd);
}

function remove() {
    var siteToAdd = document.getElementById('toRemove').value
    var year = document.getElementById('year').value
    var month = document.getElementById('month').value
    
    // 
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (this.readyState == 4 && this.status==200) {
            document.location.reload();
        }
    };
    xhttp2.open("DELETE", "services/schedule/removeShift.php", false);
    xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp2.send("year=" + year + "&month=" + month + "&siteID=" + siteToAdd);
}

$("#generateSchedule").on("click", function(){
    generateNewSchedule();
})

$("#addButton").on("click", function(){
    add();
})

$("#removeButton").on("click", function(){
    remove();
})

$(".selectEmp").on("focus", function(){
    currentFocus(this);
})

$(".selectEmp").on("change", function(){
    update(this);
})
