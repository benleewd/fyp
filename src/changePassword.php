<!doctype html>
<html lang="en">
<?php 
    session_start();
    include 'header.php'; 
    include 'common/commonFunctions.php';
?>

<title>K11 SECURITY</title>

<body id="backgroundColor">
    <nav class="navbar black">
        <span class="navbar-brand mb-0 h1 orange">K11 SECURITY</span>
    </nav>

    <div class="container-fluid" id="changePassword">
        <div class="row" >
            <div class="col ">
                <h3 class="text-center">Change Password</h3>
                <form action="processes/processPasswordChange.php" method="POST" id="formWidth" class="mx-auto d-flex flex-column justify-content-center">
                    <div class="form-group mt-4">
                        <label>Enter new password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm password:</label>
                        <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="Confirm New Password" required>
                    </div>
                    <?php printErrors();?>
                    <div class="text-center" style="margin-top: 5%;">
                        <button type="submit" class="btn btn-dark buttonSize" >Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>