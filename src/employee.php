<!DOCTYPE html>
<html lang="en" ng-app="employeeModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Employee</title>
</head>

<body ng-controller="EmployeeMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/employeeController.js"></script>

</body>

</html>