<!DOCTYPE html>
<html lang="en" ng-app="leaveAdministrationModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Leave Administration</title>
</head>

<body ng-controller="LeaveAdministrationMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/leaveAdministrationController.js"></script>

</body>

</html>