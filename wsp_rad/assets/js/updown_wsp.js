var enable_tally = 0;
$(".tally_bill").click(function(){
   $(".item_row").removeClass("bg-warning");
   $(".item_row:first").addClass("bg-warning");
   enable_tally = 1;

   if(enable_tally == 1){
view_port_height = $('.bg-warning').offset().top;
view_port_height = parseInt(view_port_height) - parseInt(100);

var tr_length = $(".items_table tbody tr").length;
var min_length = 0;
var tr_count = 1;


//On pressing Down
   shortcut.add("Down",
function() {
  

$("html, body").animate({ scrollTop: view_port_height }, 10);

console.log(tr_count);
console.log(" ");
console.log(tr_length);
if(tr_count < tr_length){
tr_count = tr_count + 1;

$(".items_table tbody tr").removeClass("bg-warning text-white");
$(".items_table tbody tr:nth-child("+tr_count+")").addClass("bg-warning text-white");

view_port_height = $('.bg-warning').offset().top; 
view_port_height = parseInt(view_port_height) - parseInt(100);

}
}
);


// On pressing up
shortcut.add("Up",
function() {

$("html, body").animate({ scrollTop: view_port_height }, 10);

if(tr_count <= tr_length){
tr_count = tr_count - 1;
console.log(tr_count);

$(".items_table tbody tr").removeClass("bg-warning text-white");
$(".items_table tbody tr:nth-child("+tr_count+")").addClass("bg-warning text-white");

view_port_height = $('.bg-warning').offset().top; 
view_port_height = parseInt(view_port_height) - parseInt(200);
}
}
);

}

});