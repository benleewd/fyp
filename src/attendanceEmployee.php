<!DOCTYPE html>
<html lang="en" ng-app="attendanceEmployeeModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Attendance</title>
</head>

<body ng-controller="AttendanceEmployeeMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/attendanceEmployeeController.js"></script>

</body>

</html>