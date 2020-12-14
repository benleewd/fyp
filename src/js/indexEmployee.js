$("#calendar").hide();
$(".btn .fa-lg").on("click", function() {
  $("#calendar").toggle();
});

$(".alert-dismissible").hide();
var timeIn = document.getElementById("timeIn");
var timeOut = document.getElementById("timeOut");

var currentYear = new Date().getFullYear();
var currentMonth = new Date().getMonth();
var currentDay = new Date().getDate();
var currentTime = new Date().getHours();
var currentMinutesAndSeconds = new Date().getMinutes() + ":" + new Date().getSeconds();

var today = currentYear + "-" + currentMonth + "-" + currentDay;

var siteID = $('#siteID').val();
var shift = $('#shift').val();
var empID = $('#empID').val();

if (siteID != 0 && shift != "") {
  $.get("services/attendance/retrieveByPK.php?eid=" + empID + "&dateCompletedShift=" + today + "&shiftName=" + shift + "&projectID=" + siteID)
  .then(function(response) {
    if (response.data != null) {
      clockIn = response.data.clockIn;
      clockOut = response.data.clockOut;
    }
    if (response.data == null || clockIn == null){
      timeIn.disabled = false;
      timeOut.disabled = true;
    } else  {
      timeIn.disabled = true;
      timeOut.disabled = false;
    }
});
} else {
      timeIn.disabled = true;
      timeOut.disabled = true;
}




$("#close").on("click", function() {
  var video = document.getElementById('video');
  $(".alert-dismissible").toggle();
  stopStreamedVideo(video);
});

function videoCam(val) {
  var video = document.getElementById('video');

  if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      var myConstraints = {  video: { facingMode: { exact: 'environment' }} }; 
      navigator.mediaDevices.getUserMedia(myConstraints).then(function(stream) {
          video.srcObject = stream;
          video.play();
      }).catch(function(err) {
    });
  }
  
  snap(val);
}

function snap(val) {
  $('body').on('click', '#snap', function(){
    if (val == 1){
      takeASnap();
    } else {
      takeASnapTimeOut();
    }
  })
}

$("#timeIn").on("click", function() {
    $(".alert-dismissible").toggle();
    videoCam(1);
    
});

$('.close').click(function(){
    $(this).parent().hide();
});

$("#timeOut").on("click", function() {
  $(".alert-dismissible").toggle();
  videoCam(0);
  
});

function takeASnap() {
  var canvas = document.getElementById('canvas');
  var context = canvas.getContext('2d');
  var video = document.getElementById('video');

  document.getElementById("snap").addEventListener("click", function() {
    context.drawImage(video, 0, 0, 200, 200);
    canvas.toBlob(function(blob) {checkIn(blob, empID, siteID);});
    
  });
}

function takeASnapTimeOut() {
  var canvas = document.getElementById('canvas');
  var context = canvas.getContext('2d');
  var video = document.getElementById('video');

  document.getElementById("snap").addEventListener("click", function() {
    context.drawImage(video, 0, 0, 200, 200);
    canvas.toBlob(function(blob) {checkOut(blob, empID, siteID);});
    
  });
}

function stopStreamedVideo(videoElem) {
  let stream = videoElem.srcObject;
  let tracks = stream.getTracks();

  tracks.forEach(function(track) {
    track.stop();
  });

  videoElem.srcObject = null;
}
