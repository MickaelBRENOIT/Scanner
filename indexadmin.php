<?php
    include_once("header.php");
?>

<div class="container mt-3 mb-3">
    <div class="text-center">
        <h1>Manage users</h1>
    </div>
</div>

<hr style="display: block; margin-top: 0.5em; margin-bottom: 0.5em; margin-left: auto; margin-right: auto; border-style: inset; border-width: 1px;">
<div class="container mt-3 mb-3">
    <div class="text-center">
        <button class="btn btn-primary" id="display-list">Display all users</button>
    </div>
</div>

<div id="table-users" class="container">
    
</div>

<?php
    include_once("footer.php");
?>