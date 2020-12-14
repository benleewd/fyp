<?php

function printErrors() {
    if (isset($_SESSION['errors'])) {
        print "<div class='alert alert-danger' role='alert'>";
        print "<span style='font-size:0.8em;'>" . $_SESSION['errors'] . "</span>";
        print "</div>";
        unset($_SESSION['errors']);
    } else if (isset($_SESSION['response'])) {
        print "<div class='alert alert-success' role='alert'>";
        print "<span>" . $_SESSION['response'] . "</span>";
        print "</div>";
        unset($_SESSION['response']);
    } else if (isset($_SESSION['timeout'])){
        echo "<div class='modal mt-4' tabindex='-1' role='dialog' id='myModal'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title'>Session Expiring Soon!</h5>
            </div>
            <div class='modal-body'>
              <p>" . $_SESSION['timeout'] . "</p>
            </div>
            <div class='modal-footer'>
              <form method='POST' action='common/common.php'>
                <button type='submit' class='btn btn-info' data-dismiss='modal' name='connected' value='yes'>Stay Connected</button>
              </form>
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";
    }
}

?>