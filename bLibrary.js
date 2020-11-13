
$( document ).ready(function() {
  $('#show_data_Modal').modal({ show: false});
});
$("#imLib").on("click",function(){
    if ($("#imLib").attr("src")==="libW.jpg"){
      $("table").css("display","initial");
      $("table").css("visibility", "visible");
      // $("#imLib").attr("src","/open-library.jpg").width(630);
      // $("#imLib").height(400);
      $("#imLib").attr("src","library-whole.jpg").width = $(".col-xs-4 col-sm-4 col-md-4 col-lg-4").width;
  } else if($("#imLib").attr("src")==="library-whole.jpg"){
       $("#imLib").attr("src","libW.jpg");
       $("table").css("display","none");
     }
});

//show the rest of the search option with the checkbox
$('#searchMore').click(function() {
  if( $(this).is(':checked')) {
      $(".imFormDiv").show();
  } else {
      $(".imFormDiv").hide();
  }
});
// $("tr").on("click",function(){
//   alert("click")
// });