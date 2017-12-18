var VirusFunction =(function (){

 function render() {


         var html =
                '<div >' +
                           '<h1> List of Virus </h1>'+
               '</div>';

        $("#container").html(html);
        
    }

    return {
        render: render
    }


}());