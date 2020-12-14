<!DOCTYPE html>
<html lang="en" ng-app="profileModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Profile</title>
</head>

<body ng-controller="ProfileMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/profileController.js"></script>

</body>

</html>