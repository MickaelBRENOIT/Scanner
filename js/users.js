var UsersFunction =(function (){

 function render() {


         var content =
            '<div >' +
                           '<h1> List of Users </h1>'+
            '</div>'+
            '<div class="spanTable" style=".height: 30px !important; overflow: scroll;​">'     +            
                  '<table class="table"  id="usersTable">'+
 
                   '</table>'+
            '</div>'+
            '<button class="btn btn-outline-primary my-2 my-sm-0 mr-2" type="button" data-toggle="modal" data-target="#UserModal" style="margin-left: 77%; top: 10px; ">Add User</button>';


        var isUpdate= false;
        var lineSelected=0;
       
        $("#container").html(content); 


        $(".fa-close").click(function(ev){
              lineSelected = $(this).attr("value");
              //deleteRow(lineNmb);
           
        });

        
         $(".fa-edit").click(function(ev){
               lineSelected = $(this).attr("value");
               isUpdate= true;

        });


        $("#btnAddUser").click(function(ev){
            isUpdate= false;
        });

        $("#validateUser").click(function(ev){
              
              if(isUpdate){
                   updateRow(lineNmb);

              }else{
                 // addUser();
              }
           
        });


        selectAllUsers();

 
          

function selectAllUsers(){

  $.ajax({ method: "POST", url: "getUsers.php", })
    
        .done(function( data ) { 
          var result = $.parseJSON(data); 

/* from result create a string of data and append to the table */
          var string = 
                '<thead class="thead-inverse">'+
                 '<tr>'+
      '<th>#</th>'+
      '<th>User Name</th>'+
      '<th>Email</th>'+
      '<th>Actif</th>'+
      '<th>Role</th>'+
      '<th>Action</th>'+
    '</tr>'+
  '</thead>'+
  '<tbody>';
    
      
      var line=1;
        $.each( result, function( key, value ) { 
             string += "<tr> <td>"+value['id'] + "</td> <td> " +    
                            value['username']+"</td> <td> "+ value['email']+"</td> <td> "+ value['active']+"</td>  <td> "+ value['role']+
                        '</td> <td>  <i class="fa fa-close" style="font-size:36px;color:red" value="'+line+'"></i>'+
                   '<i class="fa fa-edit" style="font-size:36px;color:black;margin-left: 10px;"  value="'+line+'" data-toggle="modal" data-target="#UserModal"></i></td> </tr>';
             line++;
                     }); 
             string += '</tbody>'; 
 
          $("#usersTable").html(string); 
       });
}

/*
function addUser()
{
    var tableau = document.getElementById("usersTable");

    var ligne = tableau.insertRow(-1);

    var colonne1 = ligne.insertCell(0);
    colonne1.innerHTML += "2";

    var colonne2 = ligne.insertCell(1);
    colonne2.innerHTML += "Hamza";
 
    var colonne3 = ligne.insertCell(2);
    colonne3.innerHTML += "@rezgui";

    var colonne4 = ligne.insertCell(3);
    colonne4.innerHTML += "yes";

     var colonne5 = ligne.insertCell(4);
    colonne5.innerHTML += "admin";

var actionBtn= '<i class="fa fa-close" style="font-size:36px;color:red" value="2"></i>'+
     ' <i class="fa fa-edit" style="font-size:36px;color:black;margin-left: 10px;"  value="2" data-toggle="modal" data-target="#UserModal"></i>';
var colonne6 = ligne.insertCell(5);
    colonne6.innerHTML += actionBtn;
    
}
*/
function deleteRow(num)
{
    document.getElementById("usersTable").deleteRow(num);
}

      
    }

    return { render: render }


}());