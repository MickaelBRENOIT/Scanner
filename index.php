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
                        <label class="sr-only" for="create-email-group">Email</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">Email &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                            <input type="text" class="form-control" id="create-email-group" placeholder="example@gmail.com" required>
                        </div>
                    </div>
                    <div class="alert alert-warning text-center" role="alert">
                        Once your account created, you need to validate it !
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
                    <div class="alert alert-danger text-center" role="alert" id="signin-errors-display">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="loginToAnAccount">Log in</button>
                </div>
            </div>
        </div>
    </div>

	
	<!-- Modal for diagram -->
	<div class="modal fade" id="DiagramModal" tabindex="-1" role="dialog" aria-labelledby="DiagramModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">View Diagram</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<canvas id="doughnut-chart" width="800" height="450"></canvas>
			<br/>
			<div id="open"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                <?php if(!isset($_SESSION) || !isset($_SESSION['loggedin'])) { ?>
                    <input type="text" class="form-control" id="ip-group" placeholder="127.0.0.1" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" readonly>
                <?php } else { ?>
                    <input type="text" class="form-control" id="ip-group" placeholder="127.0.0.1" required>
                <?php } ?>
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

        <!-- Select a port type to scan -->
        <div class="form-group">
            <label class="sr-only" for="max-port-group">Port Type</label>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon">Port Type &nbsp;</div>
                <select class="custom-select w-100" id="typeport">
                    <option value="TCP">TCP</option>
                    <option value="UDP">UDP</option>
                </select>
            </div>
        </div>

        <div class="alert alert-danger text-center" role="alert" id="errors-display">
        </div>

		<div class="container-fluid">
			<div class="row">
			
			<div class="form-group col-md-6 text-left" >
				<button type="submit" class="btn btn-danger mb-3" id="view-diagram" data-toggle="modal" data-target="#DiagramModal">View Diagram</button>
                <?php if(isset($_SESSION) && isset($_SESSION['loggedin'])) { ?>
                <br/><button type="submit" class="btn btn-danger" id="save-ports">Save Diagram</button>
                <?php } ?>
			</div>
			
			<div class="form-group col-md-6 text-right">
				<button type="submit" class="btn btn-primary" id="submit-form">Scan It Now !</button>
			</div>
			
			</div>
		</div>

    </div>

    <br/><br/>

    <!-- Display how many elements have been treated -->
    <div id="progress" class="col-md-12 text-center">
        <p class="lead" id="display-progress"></p>
    </div>
    <!-- Display a progress bar which shows a percentage of elements treated -->
    <div id="progress-bar-visibility" >
        <img src="css/loading.gif" alt="loading animated gif" class="img-responsive center-block" style="display:block;margin:0 auto;" />
    </div>
    <br/>

    <div id="results" class="col-md-8 offset-md-2">
    </div>

    <!-- Display a modal to display if an account was activated successfully or not -->
    <?php if(isset($_GET["action"])) { ?>
    <div class="modal" tabindex="-1" role="dialog" id="accountActivatedOrNot">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account activation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <div class="modal-body">
                   <?php if($_GET["action"] == 'activated') { ?>
                   <div class="alert alert-success text-center" role="alert">
                        Your account is now activated !
                    </div>
                    <?php } elseif($_GET["action"] == 'notactivated') { ?>
                    <div class="alert alert-danger text-center" role="alert">
                        Your account couldn't be activated. Maybe you already have activated it or something unexpected happened.
                    </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
	
	<!-- Modal about user's vulnerabilities considering the open ports he has -->
	<div class="modal fade" id="VulModal" tabindex="-1" role="dialog" aria-labelledby="VulModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Your vulnerabilities</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div id="vulResponse"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<!-- Modal that is used as an alert, here to tell the user he successfully saved his scan -->
	<div class="modal fade" id="successSaveModal" tabindex="-1" role="dialog" aria-labelledby="VulModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Success</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div><h1>Your scan has been successfully saved</h1></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>

    <?php
    include_once("footer.php");
?>