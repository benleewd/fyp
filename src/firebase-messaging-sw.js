importScripts('static/js/firebase-app.js');
importScripts('static/js/firebase-messaging.js')

firebase.initializeApp({
    apiKey: "AIzaSyCHqhlWE_n4sQd1xmpVWlw_YKCOJnTOPx0",
    authDomain: "k11hrclicks-73709.firebaseapp.com",
    databaseURL: "https://k11hrclicks-73709.firebaseio.com",
    projectId: "k11hrclicks-73709",
    storageBucket: "k11hrclicks-73709.appspot.com",
    messagingSenderId: "615056611629",
    appId: "1:615056611629:web:4c8057c28be3697c775ba4",
    measurementId: "G-ZDT2XWNHTE"
});

const messaging = firebase.messaging();

async function postData(url = '', data) {
    const response = await fetch(url, {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data
    });
    return await response.json(); 
}

messaging.setBackgroundMessageHandler(function (payload) {
    var obj = JSON.parse(payload.data.notification);

    postData('services/notification/create.php', 'data=' + JSON.stringify({'title': obj.title, "body":obj.body, "type":obj.type, "eid":obj.eid}))
        .then((data) => {
            updateNoti()
        });

    var notificationTitle = obj.title;
    var notificationOptions = {
        body: obj.body
    };

    return self.registration.showNotification(notificationTitle, notificationOptions);
})