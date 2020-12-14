// This file must be called after all the FCM dependencies
function deleteNoti(nid) {
    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() {
        if (this.readyState == 4) {
        } 
    };
    xhttp3.open("DELETE", "services/notification/delete.php", true);
    xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp3.send("nid=" + nid)
}

function updateNoti() {
    document.getElementById('dashboardDropdown').innerHTML = ""
    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() {
        if (this.readyState == 4) {
            var node = document.createElement("span")
            node.classList.add("font-weight-bold")
            node.classList.add("pl-3")
            node.innerText = "Notifications"
            document.getElementById('dashboardDropdown').appendChild(node)
            node = document.createElement("div")
            node.classList.add("dropdown-divider")
            document.getElementById('dashboardDropdown').appendChild(node)
            var output = JSON.parse(this.responseText)
            output.data.forEach(noti => {
                node = document.createElement('a')
                if (noti.type == "Leave") {
                    node.href = "leaveRequest.php"
                } else if (noti.type == "Leave Outcome") {
                    node.href = "leaveManagement.php"
                }
                node.classList.add("dropdown-item")
                node.classList.add("text-wrap")
                node.onclick = function () {
                    deleteNoti(noti.nid)
                }
                node.innerText = noti.body
                document.getElementById('dashboardDropdown').appendChild(node)
            });
            

            if (output.data.length === 0) {
                document.getElementById('notificationNo').style.display = "none";
            } else {
                document.getElementById('notificationNo').innerHTML = output.data.length
            }
        } 
    };
    xhttp3.open("GET", "services/notification/retrieveAllByEID.php", true);
    xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp3.send()
}



$('document').ready(function() {
    updateNoti()
});


var firebaseConfig = {
    apiKey: "AIzaSyCHqhlWE_n4sQd1xmpVWlw_YKCOJnTOPx0",
    authDomain: "k11hrclicks-73709.firebaseapp.com",
    databaseURL: "https://k11hrclicks-73709.firebaseio.com",
    projectId: "k11hrclicks-73709",
    storageBucket: "k11hrclicks-73709.appspot.com",
    messagingSenderId: "615056611629",
    appId: "1:615056611629:web:4c8057c28be3697c775ba4",
    measurementId: "G-ZDT2XWNHTE"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();
messaging.usePublicVapidKey('BMWMmbAco5wk2j9tIG8Coqodyze3Iy6V3eb_4nZLfvmU7cVbDW7ku6bgzxNzH-spZ2TNiSHVpkxy2B17rquXXHE');
messaging.requestPermission()
.then(function() {
    messaging.getToken().then(function(currentToken) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
            } 
        };
        xhttp.open("POST", "services/firebaseCloudMessaging/createToken.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("token=" + currentToken);
    }).catch(function(err) {
        showToken('Error retrieving Instance ID token');
        setTokenSentToServer(false);
    })
}).catch(function(err) {
    console.log("Unable to get permission to notify")
})

messaging.onMessage(function(payload) {
    var obj = JSON.parse(payload.data.notification);
    var notification = new Notification(obj.title, {
        body: obj.body
    })

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            updateNoti()
            alert(obj.body)
            
        } 
    };
    xhttp.open("POST", "services/notification/create.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var data = JSON.stringify({'title': obj.title, "body":obj.body, "type":obj.type, "eid":obj.eid})
    xhttp.send("data=" + data);
})