$(document).ready(function () {

    $('#display-list').click(function () {
        if ($('#display-list').hasClass("btn btn-primary")) {
            $.ajax({
                type: "POST",
                url: "listusers.php",
                cache: false,
                success: function (result) {
                    $("#table-users").append(result);
                    $('#display-list').removeClass().addClass("btn btn-danger");
                    $('#display-list').html("Clear the list");
                }
            });
        } else {
            $("#table-users").empty();
            $('#display-list').removeClass().addClass("btn btn-primary");
            $('#display-list').html("Display all users");
        }
    });

    $('#add-user').click(function () {
        $.ajax({
            type: "POST",
            url: "getroles.php",
            cache: false,
            success: function (result) {
                $('#select-role').empty();
                $('#select-role').append(result);
                $('#addUserModal').modal('show');
            }
        });
    });

    $("#add-errors-display").hide();

    var inputUsernameAddValid = false;
    var inputPasswordAddValid = false;
    var inputEmailAddValid = false;

    $("#add-username-group").keyup(function () {
        var contents = $('#add-username-group').val();
        if (/^[a-zA-Z0-9]{3,}$/.test(contents)) {
            if ($("#add-username-group").hasClass("is-invalid") || !$("#add-username-group").hasClass("is-valid")) {
                $("#add-username-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#add-username-group").addClass("is-valid");
            }
            inputUsernameAddValid = true;
        } else {
            if ($("#add-username-group").hasClass("is-valid") || !$("#add-username-group").hasClass("is-invalid")) {
                $("#add-username-group").removeClass("is-valid");
                $("#add-username-group").addClass("is-invalid");
            }
            inputUsernameAddValid = false;
        }
    });

    /* Check if email is really an email address */
    $("#add-email-group").keyup(function () {
        var contents = $('#add-email-group').val();
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(contents)) {
            if ($("#add-email-group").hasClass("is-invalid") || !$("#add-email-group").hasClass("is-valid")) {
                $("#add-email-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#add-email-group").addClass("is-valid");
            }
            inputEmailAddValid = true;
        } else {
            if ($("#add-email-group").hasClass("is-valid") || !$("#add-email-group").hasClass("is-invalid")) {
                $("#add-email-group").removeClass("is-valid");
                $("#add-email-group").addClass("is-invalid");
            }
            inputEmailAddValid = false;
        }
    });

    /* Check if password is 8 characters min. with at least 1 lowercase, 1 uppercase, 1 digit and 1 special char */
    $("#add-password-group").keyup(function () {
        var contents = $('#add-password-group').val();
        if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/.test(contents)) {
            if ($("#add-password-group").hasClass("is-invalid") || !$("#add-password-group").hasClass("is-valid")) {
                $("#add-password-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#add-password-group").addClass("is-valid");
                $('#add-confirm-password-group').prop('readonly', false);
            }
            inputPasswordAddValid = true;
        } else {
            if ($("#add-password-group").hasClass("is-valid") || !$("#add-password-group").hasClass("is-invalid")) {
                $("#add-password-group").removeClass("is-valid");
                $("#add-password-group").addClass("is-invalid");
                $('#add-confirm-password-group').prop('readonly', true);
            }
            inputPasswordAddValid = false;
        }
    });
    
    function enableSubmitButtonifAllInputAreCorrectInSignUpForm() {
        if (inputUsernameAddValid && inputPasswordAddValid && inputEmailAddValid) {
            return true;
        }
        return false;
    }

    $('#addAnUser').click(function () {
        var state = enableSubmitButtonifAllInputAreCorrectInSignUpForm();
        if (state) {

            var username = $('#add-username-group').val();
            var email = $('#add-email-group').val();
            var password = $('#add-password-group').val();
            var role = $('#select-role').val();

            var datas = 'username=' + username + "&email=" + email + "&password=" + password + "&role=" + role;
            $.ajax({
                type: "POST",
                url: "add_an_user.php",
                data: datas,
                cache: false,
                success: function (result) {
                    if ($.trim(result).length > 0) {
                        $("#add-errors-display").text("\"" + result + "\" already exists. Try an another username please.");
                        $("#add-errors-display").show();
                    } else {
                        location.reload();
                    }
                }
            })
        } else {
            $("#add-errors-display").text("User inputs are incorrect, fields must be filled correctly and not empty.");
            $("#add-errors-display").show();
        }
    });

});