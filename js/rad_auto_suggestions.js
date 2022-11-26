
// Auto suggestion for subscription_package
var as_input_name_subscription_package = "subscription_package";
var record_type_subscription_package = "package";


$(document).on("focus",".auto_suggestions_"+as_input_name_subscription_package,function(){

$(this).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "api/"+record_type_subscription_package+"/auto_suggest_"+record_type_subscription_package+".php",
          dataType: "json",
          data: {
            search_input_value : request.term,
            search_input_name: record_type_subscription_package          },
          success: function( data ) {            
            response( data );          

          }
        } );
      },
      minLength: 1
    });

});
//Auto suggestion ends 
