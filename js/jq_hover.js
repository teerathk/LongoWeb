

$(document).ready(function() { 
   $('.hoverLink').mousemove(function(e){
       $('#hoverDiv').show();
        $('#hoverDiv').html($(this).attr('hovertext'));
       var top = e.pageY + 10;
       var left = e.pageX + 10;
       $('#hoverDiv').css('top', top).css('left', left);
   }).mouseout(function(){
      $('#hoverDiv').fadeOut('fast');
   });
});