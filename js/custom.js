$(document).ready(function () {

    $("#errors-display").hide();
    var inputAddressValid = false;
    var inputPortMinValid = false;
    var inputPortMaxValid = false;

    /* check if the regex match with the ip user input */
    $("#ip-group").keyup(function () {
        var contents = $('#ip-group').val();

        if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(contents)) {
            if ($("#ip-group").hasClass("is-invalid") || !$("#ip-group").hasClass("is-valid")) {
                $("#ip-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#ip-group").addClass("is-valid");
            }
            inputAddressValid = true;
        } else {
            if ($("#ip-group").hasClass("is-valid") || !$("#ip-group").hasClass("is-invalid")) {
                $("#ip-group").removeClass("is-valid");
                $("#ip-group").addClass("is-invalid");
            }
            inputAddressValid = false;
        }
    });

    /* check if the regex match with the min port user input */
    $("#min-port-group").keyup(function () {
        var contents = $('#min-port-group').val();

        if (/^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$/.test(contents)) {
            if ($("#min-port-group").hasClass("is-invalid") || !$("#min-port-group").hasClass("is-valid")) {
                $("#min-port-group").removeClass("is-invalid");
                $("#min-port-group").addClass("is-valid");
            }
            inputPortMinValid = true;
        } else {
            if ($("#min-port-group").hasClass("is-valid") || !$("#min-port-group").hasClass("is-invalid")) {
                $("#min-port-group").removeClass("is-valid");
                $("#min-port-group").addClass("is-invalid");
            }
            inputPortMinValid = false;
        }
    });

    /* check if the regex match with the max port user input */
    $("#max-port-group").keyup(function () {
        var contents = $('#max-port-group').val();

        if (/^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$/.test(contents)) {
            if ($("#max-port-group").hasClass("is-invalid") || !$("#max-port-group").hasClass("is-valid")) {
                $("#max-port-group").removeClass("is-invalid");
                $("#max-port-group").addClass("is-valid");
            }
            inputPortMaxValid = true;
        } else {
            if ($("#max-port-group").hasClass("is-valid") || !$("#max-port-group").hasClass("is-invalid")) {
                $("#max-port-group").removeClass("is-valid");
                $("#max-port-group").addClass("is-invalid");
            }
            inputPortMaxValid = false;
        }
    });

    /* check if all user inputs are correct */
    function enableSubmitButtonifAllInputAreCorrect() {
        if (inputAddressValid && inputPortMaxValid && inputPortMinValid) {
            return true;
        }
        return false;
    }

    /* called when the submit button is pressed */
    $("#submit-form").click(function () {
        var mini = $('#min-port-group').val();
        var maxi = $('#max-port-group').val();

        /* check if port min < max ohterwise an error is displayed and the click event is disabled */
        if (mini >= maxi) {
            $("#errors-display").text("The (Port Max.) must be greater than (Port Min.)");
            $("#errors-display").show();
            event.preventDefault();
        } else {
            /* check if our 3 inputs are disabled */
            var state = enableSubmitButtonifAllInputAreCorrect();
            if (state) {
                $("#errors-display").hide();
            } else {
                $("#errors-display").text("User inputs are incorrect, fields must be filled correctly and not empty.");
                $("#errors-display").show();
                event.preventDefault();
            }
        }
    });
});