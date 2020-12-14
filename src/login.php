<!doctype html>
<html lang="en">
<?php 
    session_start();
    include 'header.php'; 
    include 'common/commonFunctions.php';
?>

<title>K11 SECURITY</title>

<body>
    <nav class="navbar black">
        <span class="navbar-brand mb-0 h1 orange">K11 SECURITY</span>
    </nav>

    <div class="container-fluid" id="bkgroundImg">
        <div class="row" >
            <div class="col">
                <div class="card mx-auto" id="rightLogin" >
                    <div class="card-body d-flex flex-column justify-content-center">
                    <h3 class="card-title text-center">Log In</h3>
                        <form action="processes/processLogin.php" method="POST">
                            <div class="form-group mt-4">
                                <input type="text" class="form-control" id="text" name="nric" aria-describedby="emailHelp" placeholder="NRIC" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <?php printErrors();?>
                            <div class="text-center" style="margin-top: 5%;">
                                <button type="submit" class="btn btn-dark buttonSize" >LOG IN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>