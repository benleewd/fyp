<!DOCTYPE html>
<html lang="en" ng-app="paymentModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Payment</title>
</head>

<body ng-controller="PaymentMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/paymentController.js"></script>

</body>

</html>