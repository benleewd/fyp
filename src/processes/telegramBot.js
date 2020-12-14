var update = document.getElementById('json');
var botId = "placeholder";
var path = "https://api.telegram.org/bot";
if (typeof update !== 'undefined' || update === null){
    var chatId = update['message']['chat']['id'];
    var msg = update['message']['text'];

    if (msg.indexOf("/start") == 0) {
        var user = update['message']['from']['username'];
        if (!checkCreate(user)){
            sendCreated(chatId);
        }
    }
}

function test() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            console.log(this.responseText)
            document.getElementById("txtHint").innerText = this.responseText;
        } 
    };

    xhttp.open("POST", path + botId + "/sendMessage");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var text = 'This is a test message sent to Telegram bot';
    var toSend = "chat_id=" + chatId + "&text=" + text;
    xhttp.send(toSend);
}

function update(data) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            return this.responseText
        }
    }
    xhttp.open("POST", "services/telegram/update.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("telegram=" + data);
}

function checkCreate(user) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            var data = this.responseText;

            if (data !== null) {
                update(data)
                sendMessage(chatId, "Hi, Welcome to K11SecurityBot. I will be sending you notifications on things you need to know!")
                return true
            }

            return false
        }
    }
    xhttp.open("GET", "services/telegram/checkExists.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("telegramID=" + user);
}

function sendCreated(user) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            return this.responseText
        }
    }
    xhttp.open("POST", path + botId + "/sendMessage");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var text = 'You have already started a chat with me!';
    var toSend = "chat_id=" + chatId + "&text=" + text;
    xhttp.send(toSend);
}

function sendMessage(chatId, message) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            return this.responseText
        }
    }
    xhttp.open("POST", path + botId + "/sendMessage");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var toSend = "chat_id=" + chatId + "&text=" + message;
    xhttp.send(toSend);
}