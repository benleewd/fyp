<!DOCTYPE html>
<html lang="en" ng-app="leaveRequestModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Leave Request</title>
</head>

<body ng-controller="LeaveRequestMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/leaveRequestController.js"></script>

</body>

</html>