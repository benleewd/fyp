function openQRCamera(node, siteID) {
    var reader = new FileReader();
    var output = "error";
    reader.onload = function() {
        node.value = "";
        qrcode.callback = function(res) {
            if(res instanceof Error) {
              alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
              return;
            } else {
                if (parseInt(res) == siteID) {
                    return res;
                }
                
            }
        };
        qrcode.decode(reader.result);
    };
    output = reader.readAsDataURL(node);
    return output;
}

function checkIn(q, eid, siteID) {
    var timeIn = document.getElementById("timeIn");
    var timeOut = document.getElementById("timeOut");
    if (siteID != "") {
        var result = openQRCamera(q, siteID);
    } else {
        alert("You have no site assigned today.")
        return;
    }

    if (result == "error") {
        alert("Please try and check in again.");
        return;
    } else {
        let check = checkQRCode(result, eid, 1, siteID);
    }
}

function checkOut(q, eid, siteID) {
    var timeIn = document.getElementById("timeIn");
    var timeOut = document.getElementById("timeOut");

    if (siteID != "") {
        var result = openQRCamera(q, siteID);
    } else {
        alert("You have no site assigned today.")
        return;
    }

    if (result == "error") {
        alert("Please try and check in again.");
        return;
    } else {
        let check = checkQRCode(result, eid, 0, siteID);
    }
}

function getData(eid, val, siteID) {
    var output = "";

    var timeIn = document.getElementById("timeIn");
    var timeOut = document.getElementById("timeOut");

    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth();
    var currentDay = new Date().getDate();
    var currentTime = new Date().getHours();
    var currentMinutesAndSeconds = new Date().getMinutes() + ":" + new Date().getSeconds();

    var today = currentYear + "-" + currentMonth + "-" + currentDay;
    if (currentTime <= 8 && (currentTime >= 7 && new Date().getMinutes() >= 30)) {
        shift = "day";
    } else {
        shift = "night";
    }

    time = currentTime + ":" + currentMinutesAndSeconds;

    if (val == 0) {
        //checkout
        $.get("services/attendance/retrieveByPK.php?eid=" + eid + "&dateCompletedShift=" + today + "&shiftName=" + shift + "&projectID=" + siteID)
        .then(function(response) {
            clockIn = response.data.clockIn;
            currentShift = response.data.shiftName;
            if (shift == "night"){
                today = new Date();
                tdday.setDate(d.getDate()-1);
            }

            var data = JSON.stringify({
                eid: parseInt(eid),
                dateCompletedShift: today,
                shiftName: currentShift,
                projectID: siteID,
                clockIn: clockIn,
                clockOut: time
            })

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    updateStatus = JSON.parse(this.responseText);
                    if (updateStatus.status == 200){
                        alert("Successfully Time Out");
                        timeIn.disabled = false;
                        timeOut.disabled = true;
                    } else {
                        alert("Got error. Please try again.")
                        
                    }
                }
            };
            xhttp.open("PUT", "services/attendance/update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("data=" + data);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    document.getElementById("txtHint").innerText = this.responseText;
                } 
            };
    
            xhttp.open("PUT", "services/schedule/updateScheduleRanking.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            xhttp.send("empID=" + eid + "&siteID=" + siteID );
        });
    } else {
        //checkin
        $.get("services/schedule/retrieveScheduleForTheDay.php?month=" + currentMonth + "&year=" + currentYear + "&day=" + currentDay + "&eid=" + eid + "&siteID=" + siteID)
        .then(function(response) {
            output = response;

            var data = JSON.stringify({
                eid: parseInt(eid),
                dateCompletedShift: today,
                shiftName: shift,
                projectID: siteID,
                clockIn: time
            })

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    createStatus = JSON.parse(this.responseText);
                    if (createStatus.status == 200){
                        alert("Successfully Time In");
                        timeIn.disabled = true;
                        timeOut.disabled = false;
                    } else {
                        alert("Got error. Please try again.")
                    }
                }
            };
            xhttp.open("POST", "services/attendance/create.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("data=" + data);
        });
    }
}

function checkQRCode(qrCode, eid, val,  siteID) {

    //check if the person attendance is marked today and the person is supposed to be at the right site
    check = getData(eid, val, siteID);
    if (check) {
        return true;
    } else {
        return false;
    }
}