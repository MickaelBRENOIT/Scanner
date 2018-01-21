$(document).ready(function () {
	
	/************************************************************************
     *                                                                      *
     *    SECTION : Add a port Form                                         *
     *                                                                      *
     ************************************************************************/
	 
	$("#add-port-errors-display").hide();
	var portNameValid = false;
	var keywordNameValid = false;
	var descriptionNameValid = false;
	var virusNameValid = false;
	
	/*Check if port name is composed of greater than 0 numbers*/
	$("#add-portname-group").keyup(function () {
        var contents = $('#add-portname-group').val();
        if (/^[1-9]\d*$/.test(contents)) {
            if ($("#add-portname-group").hasClass("is-invalid") || !$("#add-portname-group").hasClass("is-valid")) {
                $("#add-portname-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#add-portname-group").addClass("is-valid");
            }
            portNameValid = true;
        } else {
            if ($("#add-portname-group").hasClass("is-valid") || !$("#create-username-group").hasClass("is-invalid")) {
                $("#add-portname-group").removeClass("is-valid");
                $("#add-portname-group").addClass("is-invalid");
            }
            portNameValid = false;
        }
    });
	
	/* Check if keyword is not empty */
	$("#add-keyword-group").keyup(function () {
        var contents = $('#add-keyword-group').val();
        if (/^(?!\s*$).+/.test(contents)) {
            if ($("#add-keyword-group").hasClass("is-invalid") || !$("#add-keyword-group").hasClass("is-valid")) {
                $("#add-keyword-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#add-keyword-group").addClass("is-valid");
            }
            keywordNameValid = true;
        } else {
            if ($("#add-keyword-group").hasClass("is-valid") || !$("#create-username-group").hasClass("is-invalid")) {
                $("#add-keyword-group").removeClass("is-valid");
                $("#add-keyword-group").addClass("is-invalid");
            }
            keywordNameValid = false;
        }
    });
	
	/* Check if description is not empty */
	$("#add-description-group").keyup(function () {
        var contents = $('#add-description-group').val();
        if (/^(?!\s*$).+/.test(contents)) {
            if ($("#add-description-group").hasClass("is-invalid") || !$("#add-description-group").hasClass("is-valid")) {
                $("#add-description-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#add-description-group").addClass("is-valid");
            }
            descriptionNameValid = true;
        } else {
            if ($("#add-description-group").hasClass("is-valid") || !$("#create-username-group").hasClass("is-invalid")) {
                $("#add-description-group").removeClass("is-valid");
                $("#add-description-group").addClass("is-invalid");
            }
            descriptionNameValid = false;
        }
    });
	
	/* Check if virus is not empty */
	$("#add-virus-group").keyup(function () {
        var contents = $('#add-virus-group').val();
        if (/^(?!\s*$).+/.test(contents)) {
            if ($("#add-virus-group").hasClass("is-invalid") || !$("#add-virus-group").hasClass("is-valid")) {
                $("#add-virus-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#add-virus-group").addClass("is-valid");
            }
            virusNameValid = true;
        } else {
            if ($("#add-virus-group").hasClass("is-valid") || !$("#create-username-group").hasClass("is-invalid")) {
                $("#add-virus-group").removeClass("is-valid");
                $("#add-virus-group").addClass("is-invalid");
            }
            virusNameValid = false;
        }
    });
	
	function enableSubmitButtonIfAllInputAreCorrectInAddPortForm() {
		if(portNameValid && keywordNameValid && descriptionNameValid && virusNameValid)
			return true;
		else	
			return false;
			
	}

    /************************************************************************
     *                                                                      *
     *    SECTION : display list of users                                   *
     *                                                                      *
     ************************************************************************/

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

    /************************************************************************
     *                                                                      *
     *    SECTION : Get all roles for modal                                 *
     *                                                                      *
     ************************************************************************/

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

    /* Username needs at least 3 characters */
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

    /************************************************************************
     *                                                                      *
     *    SECTION : Add an user Form                                        *
     *                                                                      *
     ************************************************************************/

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

    /************************************************************************
     *                                                                      *
     *    SECTION : Delete an user Form                                     *
     *                                                                      *
     ************************************************************************/

    var username = '';

    $(document).on('click', '.deleteuser', function () {
        username = $(this).val();

        $('#delete-user-display').text("Do you really want to delete " + username + " ?");
        $('#DeleteUserModal').modal('show');
        
    });

    $('#DeleteAnUser').click(function () {
        var datas = 'username=' + username;
        
        $.ajax({
            type: "POST",
            url: "delete_an_user.php",
            data: datas,
            cache: false,
            success: function (result) {
                location.reload();
            }
        })
    });
    
    /************************************************************************
     *                                                                      *
     *    SECTION : Update an user Form                                     *
     *                                                                      *
     ************************************************************************/
    
    $("#modify-errors-display").hide();
    
    $(document).on('click', '.modifyuser', function () {
        username = $(this).val();
        var datas = 'username=' + username;
        
        $.ajax({
            type: "POST",
            url: "getroles.php",
            cache: false,
            success: function (result) {
                $('#select-role-modify').empty();
                $('#select-role-modify').append(result);
            }
        });
        
        $.ajax({
            type: "POST",
            url: "getanuser.php",
            data: datas,
            cache: false,
            success: function (result) {
                
                result = result.split("&");
                var user = result[0];
                var mail = result[1];
                var acti = result[2];
                var role = result[3];
                
                $("#modify-username-group").val(user);
                $("#modify-email-group").val(mail);
                $("#modify-activate-group").val(acti);
                $("#select-role-modify option[value="+role+"]").prop("selected", true);
                
                $('#updateUserModal').modal('show');
                
            }
        })
    });
    
    var inputEmailModifyValid = false;
    var inputPasswordModifyValid = false;
    
    /* Check if email is really an email address */
    $("#modify-email-group").keyup(function () {
        var contents = $('#modify-email-group').val();
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(contents)) {
            if ($("#modify-email-group").hasClass("is-invalid") || !$("#modify-email-group").hasClass("is-valid")) {
                $("#modify-email-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#modify-email-group").addClass("is-valid");
            }
            inputEmailModifyValid = true;
        } else {
            if ($("#modify-email-group").hasClass("is-valid") || !$("#modify-email-group").hasClass("is-invalid")) {
                $("#modify-email-group").removeClass("is-valid");
                $("#modify-email-group").addClass("is-invalid");
            }
            inputEmailModifyValid = false;
        }
    });
    
    /* Check if password is 8 characters min. with at least 1 lowercase, 1 uppercase, 1 digit and 1 special char */
    $("#modify-password-group").keyup(function () {
        var contents = $('#modify-password-group').val();
        if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/.test(contents)) {
            if ($("#modify-password-group").hasClass("is-invalid") || !$("#modify-password-group").hasClass("is-valid")) {
                $("#modify-password-group").removeClass("is-invalid"); // remove class if it possible otherwise it ignore this instruction
                $("#modify-password-group").addClass("is-valid");
            }
            inputPasswordModifyValid = true;
        } else {
            if ($("#modify-password-group").hasClass("is-valid") || !$("#modify-password-group").hasClass("is-invalid")) {
                $("#modify-password-group").removeClass("is-valid");
                $("#modify-password-group").addClass("is-invalid");
            }
            inputPasswordModifyValid = false;
        }
    });
    
    $('#ModifyAnUser').click(function (){
        
        if (inputEmailModifyValid && inputPasswordModifyValid) {

            var username = $('#modify-username-group').val();
            var email = $('#modify-email-group').val();
            var activate = $('#modify-activate-group').val();
            var password = $('#modify-password-group').val();
            var role = $('#select-role-modify').val();

            var datas = 'username=' + username + '&email=' + email + "&activate=" + activate + "&password=" + password + "&role=" + role;
            $.ajax({
                type: "POST",
                url: "modify_an_user.php",
                data: datas,
                cache: false,
                success: function (result) {
                    location.reload();
                }
            })
        } else {
            $("#modify-errors-display").text("User inputs are incorrect, fields must be filled correctly and not empty.");
            $("#modify-errors-display").show();
        }
    });
    
    /************************************************************************
     *                                                                      *
     *    SECTION : display list of ports                                   *
     *                                                                      *
     ************************************************************************/
	$('#display-port-list').click(function () {
        if ($('#display-port-list').hasClass("btn btn-primary")) {
            $.ajax({
                type: "POST",
                url: "getPortList.php",
                cache: false,
                success: function (result) {
                    $("#table-ports").append(result);
                    $('#display-port-list').removeClass().addClass("btn btn-danger");
                    $('#display-port-list').html("Clear the list");
                }
            });
        } else {
            $("#table-ports").empty();
            $('#display-port-list').removeClass().addClass("btn btn-primary");
            $('#display-port-list').html("Display all ports");
        }
    });

	/************************************************************************
     *                                                                      *
     *    SECTION : add a port                                   *
     *                                                                      *
     ************************************************************************/
		
	//Modal appearance function
	$('#add-port').click(function () {
        $('#addPortModal').modal('show');
    });
	
	
	function checkIfAddAPortModalFormIsCorrectlyFilled(){
		if($('#add-portname-group').val() && $('#add-type-group').val()) {
			return true;
		}else{
			return false;
		}
	}
	
	//Actual port adding to database
	$('#addAPort').click(function () {
        var state = enableSubmitButtonIfAllInputAreCorrectInAddPortForm();
        if (state) {

            var port = $('#add-portname-group').val();
            var type = $('#add-type-group').val();
            var keyword = $('#add-keyword-group').val();
            var description = $('#add-description-group').val();
			var virus = $('#add-virus-group').val();

            var datas = 'port=' + port + "&type=" + type + "&keyword=" + keyword + "&description=" + description + "&virus=" + virus;
            $.ajax({
                type: "POST",
                url: "add_a_port.php",
                data: datas,
                cache: false,
                success: function (result) {
					location.reload();            
                }
            })
        } else {
            $("#add-port-errors-display").text("Port inputs are incorrect, fields must be filled correctly and not empty.");
            $("#add-port-errors-display").show();
        }
    });
	
	/************************************************************************
     *                                                                      *
     *    SECTION : Modify a port                                   *
     *                                                                      *
     ************************************************************************/
		
	//Modal appearance function
	$(document).on('click', '.modifyport', function () {
		username = $(this).val();
        var datas = 'id=' + username;
		$("#modify-id-group").val($(this).val());
		$.ajax({
            type: "POST",
            url: "getaport.php",
            data: datas,
            cache: false,
            success: function (result) {
				result = result.split("&");
                var port = result[0];
                var type = result[1];
                var keyword = result[2];
                var description = result[3];
				var virus = result[4];
                
                $("#modify-portname-group").val(port);
				$("#modify-type-group option[value="+type+"]").prop("selected", true);
                $("#modify-keyword-group").val(keyword);
				$("#modify-description-group").val(description);
				$("#modify-virus-group").val(virus);
                
                
                $('#updatePortModal').modal('show');  
								
            }
        })
    });
	
	
	
	$('#ModifyAPort').click(function () {
			var id = $('#modify-id-group').val();
			var port = $('#modify-portname-group').val();
            var type = $('#modify-type-group').val();
            var keyword = $('#modify-keyword-group').val();
            var description = $('#modify-description-group').val();
			var virus = $('#modify-virus-group').val();
			
			var datas = 'id=' + id + '&port=' + port + "&type=" + type + "&keyword=" + keyword + "&description=" + description + "&virus=" + virus;
            
	});
	
	/************************************************************************
     *                                                                      *
     *    SECTION : Delete a port                                           *
     *                                                                      *
     ************************************************************************/
	$(document).on('click', '.deleteport', function () {
		$('#delete-port-display').text("Do you really want to delete this port ?");
		$('#DeletePortModal').modal('show');
		$('#DeleteAnPort').val($(this).val());
	});
	
	$('#DeleteAnPort').click(function () {
		var id = $(this).val();
		
		var datas = 'id=' + id;
		
		$.ajax({
                type: "POST",
                url: "delete_a_port.php",
                data: datas,
                cache: false,
                success: function (result) {
					location.reload();            
                }
            })
		
	});
	
	
	
	
	
	
	/************************************************************************
     *                                                                      *
     *    SECTION : Import ports through XML file                           *
     *                                                                      *
     ************************************************************************/

	$('#display-xml-import').click(function () {
        $('#importXmlModal').modal('show');
    });
	
	
	
	
	/************************************************************************
     *                                                                      *
     *    SECTION : Export ports through XML file                           *
     *                                                                      *
     ************************************************************************/	
	$('#display-xml-export').click(function () {
		$('#export-xml-display').text("Do you want to download the port database in an XML file format ?");
		$('#ExportXmlModal').modal('show');
		
		$.ajax({
                type: "POST",
                url: "create_XML_file.php",
                cache: false,
                success: function (result) {
					$('#export-xml-display').text("Do you want to download the port database in an XML file format ?");
					$('#ExportXmlModal').modal('show');           
                }
        })
		
    });
	
	
	
	$('#ExportAPort').click(function () {
		$.ajax({
                type: "POST",
                url: "delete_XML_file.php",
                cache: false,
                success: function (result) {
					location.reload();
                }
        })
	});
	
	
	
	
	
});