$(document).ready(function () {

    /************************************************************************
     *                                                                      *
     *    SECTION : Check if account was successfully created               *
     *                                                                      *
     ************************************************************************/

    try {
        $('#accountActivatedOrNot').modal('show');
    } catch(err) {
        console.log("Account couldn't be activated : " + err.message);
    }

    /************************************************************************
     *                                                                      *
     *    SECTION : Scanner Form                                            *
     *                                                                      *
     ************************************************************************/

    $("#errors-display").hide();
    $("#progress-bar-visibility").hide();
	$('#view-diagram').hide();
	$('#save-ports').hide();
    var inputAddressValid = false;
    var inputPortMinValid = false;
    var inputPortMaxValid = false;
	var array = [];
	var arrayOpenedPorts = [];
	var total_ports = 0;
	var count_ajax_calls = 0;

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
		
		//Reinitialisation of the array of opened ports
		arrayOpenedPorts = [];
		array = [];
		
		var bouton = this;
        var mini = parseInt($('#min-port-group').val());
        var maxi = parseInt($('#max-port-group').val());
        var type = $('#typeport').val();
		

        /* check if port min < max ohterwise an error is displayed and the click event is disabled */
        if (mini >= maxi) {
            $("#errors-display").text("The (Port Max.) must be greater than (Port Min.)");
            $("#errors-display").show();
        } else {
            /* check if our 3 inputs are disabled */
            if($('#ip-group').is('[readonly]')){
                inputAddressValid = true;
            }
            var state = enableSubmitButtonifAllInputAreCorrect();
            if (state) {
				$("#results").empty();
				bouton.disabled=true;
                var count = 0;
                total_ports = (maxi - mini + 1);

				$('#view-diagram').hide();
				$('#save-ports').hide();
                $("#errors-display").hide();
                $("#progress-bar-visibility").show();
                $('#progress-bar-to-update').attr('aria-valuemax', total_ports);

                /* start displaying the progress bar and result table */
                $("#display-progress").text("Number of elements treated : " + count + " on " + total_ports);
                $("#results").append("<table class='table table-striped'>" +
                    "<thead class='thead-dark'>" +
                    "<tr>" +
                    "<th scope='col'>#</th>" +
                    "<th scope='col'>Port Number</th>" +
                    "<th scope='col'>Port Code</th>" +
                    "<th scope='col'>Port Message</th>" +
                    "</tr>" +
                    "</thread>" +
                    "<tbody id='display-item-each-row'>" +
                    "</tbody>" +
                    "</table>");


                /* processing tests on every port between mini and maxi */
                var ip = $('#ip-group').val();
                for (var i = mini; i <= maxi; i++) {
                    var datas = 'ip=' + ip + "&port=" + i + "&type=" + type;
                    $.ajax({
                        type: "POST",
                        url: "check_status_port.php",
                        data: datas,
                        cache: false,
                        success: function (result) {
                            count = count + 1;
                            result = result.split("&");
                            var code = result[0];
                            var mess = result[1];
                            var port = result[2];
							
							if(code == 0) {
								arrayOpenedPorts.push(port);
							}
							
							if(array.hasOwnProperty(mess)){
                                var value = array[mess];
                                value+=1;
                                array[mess] = value;
                                //console.log(array[code] + " => " + value);
                            } else {
                                array[mess] = 1;
                                //console.log("Array -> " + Object.keys(array));
                            }

                            //console.log("=> " + Object.entries(array));
                            /*Object.entries(array).forEach(([key, value]) => {
                                console.log(`${key} ${value}`); 
                            });*/
                            

                            // update number of items treated
                            $("#display-progress").text("Number of elements treated : " + count + " on " + total_ports);

                            // update the progress bar
                            var percent = ((count / total_ports) * 100);
                            $('#progress-bar-to-update').attr('aria-valuenow', count).css('width', percent + '%');

                            // update the result table
                            $("#display-item-each-row").append("<tr>" +
                                "<th  scope='row'>" + count + "</th>" +
                                "<td class='portNumber'>" + port + "</td>" +
                                "<td>" + code + "</td>" +
                                "<td>" + mess + "</td>" +
                                "</tr>");
                        },
						complete : function () {
							count_ajax_calls += 1;
							if(count_ajax_calls === total_ports){
								bouton.disabled=false;
								count_ajax_calls = 0;
								$('#view-diagram').show();
								$('#save-ports').show();
							}
						}
                    })
                }
            } else {
                $("#errors-display").text("User inputs are incorrect, fields must be filled correctly and not empty.");
                $("#errors-display").show();
            }
        }
    });

    /************************************************************************
     *                                                                      *
     *    SECTION : SignUp Form                                             *
     *                                                                      *
     ************************************************************************/


    $("#signup-errors-display").hide();
    var inputUsernameSignUpValid = false;
    var inputPasswordSignUpValid = false;
    var inputConfirmPasswordSignUpValid = false;
    var inputEmailSignUpValid = false;
    $('#create-confirm-password-group').prop('readonly', true);

    /* Check if username is only composed with lowercase/uppercase and digits */
    $("#create-username-group").keyup(function () {
        var contents = $('#create-username-group').val();
        if (/^[a-zA-Z0-9]{3,}$/.test(contents)) {
            if ($("#create-username-group").hasClass("is-invalid") || !$("#create-username-group").hasClass("is-valid")) {
                $("#create-username-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#create-username-group").addClass("is-valid");
            }
            inputUsernameSignUpValid = true;
        } else {
            if ($("#create-username-group").hasClass("is-valid") || !$("#create-username-group").hasClass("is-invalid")) {
                $("#create-username-group").removeClass("is-valid");
                $("#create-username-group").addClass("is-invalid");
            }
            inputUsernameSignUpValid = false;
        }
    });

    /* Check if email is really an email address */
    $("#create-email-group").keyup(function () {
        var contents = $('#create-email-group').val();
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(contents)) {
            if ($("#create-email-group").hasClass("is-invalid") || !$("#create-email-group").hasClass("is-valid")) {
                $("#create-email-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#create-email-group").addClass("is-valid");
            }
            inputEmailSignUpValid = true;
        } else {
            if ($("#create-email-group").hasClass("is-valid") || !$("#create-email-group").hasClass("is-invalid")) {
                $("#create-email-group").removeClass("is-valid");
                $("#create-email-group").addClass("is-invalid");
            }
            inputEmailSignUpValid = false;
        }
    });

    /* Check if password is 8 characters min. with at least 1 lowercase, 1 uppercase, 1 digit and 1 special char */
    $("#create-password-group").keyup(function () {
        var contents = $('#create-password-group').val();
        if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/.test(contents)) {
            if ($("#create-password-group").hasClass("is-invalid") || !$("#create-password-group").hasClass("is-valid")) {
                $("#create-password-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#create-password-group").addClass("is-valid");
                $('#create-confirm-password-group').prop('readonly', false);
            }
            inputPasswordSignUpValid = true;
        } else {
            if ($("#create-password-group").hasClass("is-valid") || !$("#create-password-group").hasClass("is-invalid")) {
                $("#create-password-group").removeClass("is-valid");
                $("#create-password-group").addClass("is-invalid");
                $('#create-confirm-password-group').prop('readonly', true);
            }
            inputPasswordSignUpValid = false;
        }
    });

    /* Check if "password" and "confirm password" are the same */
    $("#create-confirm-password-group").keyup(function () {
        var password = $('#create-password-group').val();
        var confirm_password = $('#create-confirm-password-group').val();

        if (password === confirm_password) {
            if ($("#create-confirm-password-group").hasClass("is-invalid") || !$("#create-confirm-password-group").hasClass("is-valid")) {
                $("#create-confirm-password-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#create-confirm-password-group").addClass("is-valid");
            }
            inputConfirmPasswordSignUpValid = true;
        } else {
            if ($("#create-confirm-password-group").hasClass("is-valid") || !$("#create-confirm-password-group").hasClass("is-invalid")) {
                $("#create-confirm-password-group").removeClass("is-valid");
                $("#create-confirm-password-group").addClass("is-invalid");
            }
            inputConfirmPasswordSignUpValid = false;
        }
    });


    function enableSubmitButtonifAllInputAreCorrectInSignUpForm() {
        if (inputUsernameSignUpValid && inputPasswordSignUpValid && inputConfirmPasswordSignUpValid && inputEmailSignUpValid) {
            return true;
        }
        return false;
    }

    $("#createAnAccount").click(function () {

        /* check if our 3 inputs are disabled */
        var state = enableSubmitButtonifAllInputAreCorrectInSignUpForm();
        if (state) {

            var username = $('#create-username-group').val();
            var email = $('#create-email-group').val();
            var password = $('#create-password-group').val();
            var confirm_password = $('#create-confirm-password-group').val();

            var datas = 'username=' + username + "&email=" + email + "&password=" + password + "&confirm=" + confirm_password;
            $.ajax({
                type: "POST",
                url: "create_an_account.php",
                data: datas,
                cache: false,
                success: function (result) {
                    console.log("RESULT : " + result);
                    if ($.trim(result).length > 0) {
                        $("#signup-errors-display").text("\"" + result + "\" already exists. Try an another username please.");
                        $("#signup-errors-display").show();
                    } else {
                        location.reload();
                    }
                }
            })
        } else {
            $("#signup-errors-display").text("User inputs are incorrect, fields must be filled correctly and not empty.");
            $("#signup-errors-display").show();
        }
    });


    /************************************************************************
     *                                                                      *
     *    SECTION : SignIn Form                                             *
     *                                                                      *
     ************************************************************************/
    
    $("#signin-errors-display").hide();
    
    $("#loginToAnAccount").click(function() {
        var login = $('#login-username-group').val();
        var passw = $('#login-password-group').val();
        
        if(login == '' || passw == ''){
            $("#signin-errors-display").text("User inputs are incorrect, fields must be not empty.");
            $("#signin-errors-display").show();
        } else {
            var datas = 'login=' + login + '&passw=' + passw;
            $.ajax({
                type: "POST",
                url: "login.php",
                data: datas,
                cache: false,
                success: function (result){
                    if ($.trim(result).length <= 0) {
                        $("#signin-errors-display").text("This account does not exist. If it's your first connection, make sure to check if you have activated your account.");
                        $("#signin-errors-display").show();
                    } else {
                        window.location.href = 'index.php';
                    }
                }
            })
        }
    });
    
    /************************************************************************
     *                                                                      *
     *    SECTION : Logout                                                  *
     *                                                                      *
     ************************************************************************/
    
    $("#processLogout").click(function() {
        $.ajax({
            url: "logout.php",
            success: function(data){
                window.location.href = 'index.php';
            }
        })
    });
	
	/************************************************************************
     *                                                                      *
     *    SECTION : Diagram modal                                           *
     *                                                                      *
     ************************************************************************/

	 $("#view-diagram").click(function() {
		 
		 //Diagram creation
		 new Chart(document.getElementById("doughnut-chart"), {
			type: 'doughnut',
			data: {
			  labels: ["Closed", "Opened", "Filtered"],
			  datasets: [
				{
				  label: "Scan port",
				  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"],
				  data: Object.values(array)
				}
			  ]
			},
			options: {
			  title: {
				display: true,
				text: 'Predicted world population (millions) in 2050'
			  }
			}
		});
		
		document.getElementById("open").textContent='';
		
		//Opened ports names
		for(let i = 0; i<arrayOpenedPorts.length; i+=1){
			let p = document.createElement('p');
			p.textContent = `The port ${arrayOpenedPorts[i]} is opened.`;
			document.getElementById("open").appendChild(p);
		}
		
	 });
	 
	 
	 
	/************************************************************************
     *                                                                      *
     *    SECTION : Saving ports                                            *
     *                                                                      *
     ************************************************************************/
	 
	$("#save-ports").click(function() {
		 
		var ports = document.getElementsByClassName("portNumber");
		var userName = document.getElementById("userName").innerHTML;
		var datas = []
		for(var i=0; i < ports.length; i++) {
			datas[i]=ports[i].innerHTML;
		}
		
		$.ajax({
                type: "POST",
                url: "savePorts.php",
                data: {id:datas, userName:userName},
                cache: false,
                success: function (result){
                    alert("Sauvegarde");
                }
            })
		
		
	 });

});