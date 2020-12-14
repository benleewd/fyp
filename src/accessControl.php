<!DOCTYPE html>
<html lang="en" ng-app="accessControlModule">
<?php
include 'header.php';
include 'common/common.php';

// Special condition for this page
if ($_SESSION['designation'] != "Management") {
    header("Location: unauthorisedAccess.html"); 
}
?>

<head>
    <title>Access Control</title>
</head>

<body ng-controller="AccessControlMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/accessControlController.js"></script>

</body>

</html>