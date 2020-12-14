<!DOCTYPE html>
<html lang="en" ng-app="siteModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Site</title>
</head>

<body ng-controller="SiteMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/siteController.js"></script>

</body>

</html>