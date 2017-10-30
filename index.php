<?php
    include_once("header.php");
?>

    <!-- Modal For Sign UP -->
    <div class="modal fade" id="SignUpModal" tabindex="-1" role="dialog" aria-labelledby="SignUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SignUpModalLabel">Create an account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="sr-only" for="create-username-group">Username</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">Username &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                            <input type="text" class="form-control" id="create-username-group" placeholder="Min 3 characters (special characters not allowed)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="create-password-group">Password</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">Password &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                            <input type="password" class="form-control" id="create-password-group" placeholder="Min 8 characters and need 1 digit, 1 uppercase, 1 lowercase, 1 special char" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="create-confirm-password-group">Confirm Password</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">Confirm Password</div>
                            <input type="password" class="form-control" id="create-confirm-password-group" placeholder="Type your password again" required>
                        </div>
                    </div>
                    <div class="alert alert-danger text-center" role="alert" id="signup-errors-display">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="createAnAccount">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal For Sign IN -->
    <div class="modal fade" id="SignInModal" tabindex="-1" role="dialog" aria-labelledby="SignInModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SignInModalLabel">Log in to your account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="sr-only" for="login-username-group">Username</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">Username</div>
                            <input type="text" class="form-control" id="login-username-group" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="login-password-group">Password</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">Password</div>
                            <input type="password" class="form-control" id="login-password-group" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="loginToAnAccount">Log in</button>
                </div>
            </div>
        </div>
    </div>

    <div id="display-title" class="text-center">
        <h1>Port Scanner</h1>
        <p class="lead">Network Security Project : Master 2 MIAGE</p>
    </div>

    <hr style="display: block; margin-top: 0.5em; margin-bottom: 0.5em; margin-left: auto; margin-right: auto; border-style: inset; border-width: 1px;">

    <div id="display-form" class="col-md-4 offset-md-4 border border-info">

        <!-- IP Address -->
        <h3 class="text-center"><small>Input Parameters</small></h3>
        <div class="form-group">
            <label class="sr-only" for="ip-group">IP Address</label>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon">IP Address</div>
                <input type="text" class="form-control" id="ip-group" placeholder="127.0.0.1" required>
            </div>
        </div>

        <!-- Port Min -->
        <div class="form-group">
            <label class="sr-only" for="min-port-group">Port Min.</label>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon">Port Min. &nbsp;</div>
                <input type="text" class="form-control" id="min-port-group" placeholder="1" required>
            </div>
        </div>

        <!-- Port Max -->
        <div class="form-group">
            <label class="sr-only" for="max-port-group">Port Max.</label>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon">Port Max. &nbsp;</div>
                <input type="text" class="form-control" id="max-port-group" placeholder="65535" required>
            </div>
        </div>

        <div class="alert alert-danger text-center" role="alert" id="errors-display">
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary" id="submit-form">Scan It Now !</button>
        </div>

    </div>

    <br/><br/>

    <!-- Display how many elements have been treated -->
    <div id="progress" class="col-md-12 text-center">
        <p class="lead" id="display-progress"></p>
    </div>
    <!-- Display a progress bar which shows a percentage of elements treated -->
    <div id="progress-bar-visibility" class="progress col-md-8 offset-md-2" style="padding: 0 0 0 0;">
        <div id="progress-bar-to-update" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
    </div>
    <br/>

    <div id="results" class="col-md-8 offset-md-2">
    </div>
    
<?php
    include_once("footer.php");
?>