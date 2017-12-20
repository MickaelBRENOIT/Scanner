<?php
    include_once("header.php");
?>

<!-- Modal add user -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="SignUpModalLabel" aria-hidden="true">
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
                    <label class="sr-only" for="add-username-group">Username</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Username &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                        <input type="text" class="form-control" id="add-username-group" placeholder="Min 3 characters (special characters not allowed)" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="add-email-group">Email</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Email &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                        <input type="text" class="form-control" id="add-email-group" placeholder="example@gmail.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="add-password-group">Password</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Password &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                        <input type="password" class="form-control" id="add-password-group" placeholder="Min 8 characters and need 1 digit, 1 uppercase, 1 lowercase, 1 special char" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="add-confirm-password-group">Choose a role</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Choose a role &nbsp; &nbsp; &nbsp;</div>
                        <select id="select-role" class="form-control"></select>
                    </div>
                </div>
                <div class="alert alert-danger text-center" role="alert" id="add-errors-display"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addAnUser">Add an user</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3 mb-3">
    <div class="text-center">
        <h1>Manage users</h1>
    </div>
</div>

<hr style="display: block; margin-top: 0.5em; margin-bottom: 0.5em; margin-left: auto; margin-right: auto; border-style: inset; border-width: 1px;">
<div class="container mt-3 mb-3">
    <div class="text-center">
        <button class="btn btn-success" id="add-user">Add an user</button>
        <button class="btn btn-primary" id="display-list">Display all users</button>
    </div>
</div>

<div id="table-users" class="container"> 
</div>

<?php
    include_once("footer.php");
?>