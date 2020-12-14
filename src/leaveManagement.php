<!DOCTYPE html>
<html lang="en" ng-app="leaveManagementModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Leave Management</title>
</head>

<body ng-controller="LeaveManagementMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/leaveManagementController.js"></script>

</body>

</html>