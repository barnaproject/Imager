$(document).ready(function() {
  $('#search-images').submit(function(){
    $(this).find('button').html('...').attr('type', 'button');
  });
    $('.item').each(function(e){
    	var num = e;
    	get_num(e);
    });
    function get_num(e){
    	$('.num_results').html('('+(e+1)+')');
    }
    $('.loader').remove();
    $('.results-container').css('opacity', 1);
    $(window).scroll(function(){
      if($(this).scrollTop() > 10){
        $('.navbar-default').css('background-color', '#000');
      }else{
        $('.navbar-default').css('background-color', '#3498db');
      }
    });
    if($('tbody').children().length == 0){
      $('.results-container').html('<div class="row mt centered"><h1>No Results...</h1></div>');
    }
    var imageExist = 0;
    $('.item').each(function(){
      var exist = $(this).data('exist');
      if(exist == 1){
        imageExist = 1;
        return false;
      }
    });
    if(imageExist == 1){
      $('#download_images').find('button').show();
    }else{
      $('#download_images').find('button').remove();
    }
    $('#download_images').submit(function(e){
      $('.item').each(function(){
        var exist = $(this).data('exist');
        var link = $(this).find('img').attr('src');
        if(exist == 1){
          $('#download_images').find('.hidden-images').append('<input type="hidden" name="imgs[]" value="'+link+'">');
        }
      });
    });
});