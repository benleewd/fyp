<!DOCTYPE html>
<html lang="en" ng-app="attendanceModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Attendance</title>
</head>

<body ng-controller="AttendanceMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/attendanceController.js"></script>

</body>

</html>