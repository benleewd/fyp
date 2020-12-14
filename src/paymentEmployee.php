<!DOCTYPE html>
<html lang="en" ng-app="paymentEmployeeModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Payment</title>
</head>

<body ng-controller="PaymentEmployeeMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/paymentEmployeeController.js"></script>

</body>

</html>