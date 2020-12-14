<!DOCTYPE html>
<html lang="en" ng-app="telegramModule">
<?php
include 'header.php';
include 'common/common.php';
?>

<head>
    <title>Telegram</title>
</head>

<body ng-controller="TelegramMainController">
    <?php include 'navStart.php'; ?>

    <div class="container" ng-view></div>
    
    <?php include 'navEnd.php'; ?>

    <script src="js/controllers/telegramController.js"></script>

</body>

</html>