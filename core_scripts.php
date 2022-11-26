 <!-- App js -->
 <script src="js/vendor.min.js"></script>
        <script src="js/app.min.js"></script>
        <script src="wsp_rad/assets/js//sweetalert.min.js"></script>
        <script src="wsp_rad/assets/js/printThis.js"></script>
    <script src="wsp_rad/assets/js/jquery.tabletoCSV.js"></script>
    <script src="wsp_rad/assets/js/export_to_xls.js"></script>
    <script src="wsp_rad/assets/js/jquery-ui.js"></script>
    <script src="js/rad_auto_suggestions.js"></script>
    <script src="wsp_rad/assets/js/jquery.dataTables.min.js"></script>
    <script src="wsp_rad/assets/js/dataTables.responsive.min.js"></script>
        <script>
// Auto Select DB Values
$(".db_auto_chose").each(function(){  
var db_auto_chose_name = $(this).attr("name");
var db_auto_chose_value = $(this).attr("db_auto_chose_value");
$(this).val(db_auto_chose_value);
});


// Auto Select DB Check Values Radio
$(".db_radio_check").each(function(){  
var db_radio_check_name = $(this).attr("for");
var db_radio_check_value = $(this).attr("db_radio_check_value");
$("input[name='"+db_radio_check_name+"'][value='"+db_radio_check_value+"']").attr("checked", true);
});

// Auto Select DB Check Values Checkbox
$(".db_checkbox_check").each(function(){  
var db_checkbox_check_name = $(this).attr("for");
var db_checkbox_check_value = $(this).attr("db_checkbox_check_value");
var db_checkbox_check_value_split = db_checkbox_check_value.split(",");
$(db_checkbox_check_value_split).each(function(single_checkbox_key,single_checkbox_value){    
    $("input[name='"+db_checkbox_check_name+"[]'][value='"+single_checkbox_value+"']").attr("checked", true);
});
});

//Backup 
//Backup DB
$(".backup_now").click(function(){
    //Progress
    // swal({
    //         title: "Processing...",
    //         text: "Please wait",            
    //         buttons:false,    
    //         closeOnClickOutside: false
    //         });
    
    //Send Request to backup
    $.post("wsp_rad/backup.php",function(data){
        var response_json_backup = data;
    if(response_json_backup["status"] == "success"){
       swal("Backup Success","","success");
      //Enable download
      //  window.open(response_json_backup["url"],"_blank");
    }else{
        swal("Backup Failed",response_json_backup["message"],"error");
    }
    });

});
//Backup DB

//Automated every hour
function tick()
{
    //get the mins of the current time
    var mins = new Date().getMinutes();
    var seconds = new Date().getSeconds();
    console.log(mins + " " + seconds);
    if(mins == "0" && seconds == "0"){
        $(".backup_now").trigger("click");
     }
   
}
setInterval(function() { tick(); }, 1000);

        </script>
        <script>

var prefilled = "<?php echo $_GET["prefilled"]; ?>";
var main_split = prefilled.split("||");
$.each(main_split,function(index, value){
    var sub_split = value.split(">");
    $("[name='"+sub_split[0]+"']").val(sub_split[1]);
})


//Trigger modal with hash
if(window.location.hash) {
          var hash = window.location.hash;
          $(hash).modal('toggle');
          setTimeout(function(){
            $(hash + " form").find('input[type=text],textarea,select').filter(':visible:first').focus();
          },500);
      }

$(function(){
  $('button[data-toggle=modal]').click(function (e) {
    window.location.hash = $(this).attr("data-target");    
  });
}); 

</script>