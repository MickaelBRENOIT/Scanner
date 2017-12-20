$(document).ready(function () {
    $('#display-list').click(function() {
        $.ajax({
            type: "POST",
            url: "listusers.php",
            cache: false,
            success: function (result){
                // TODO
            }
        });
    });
});