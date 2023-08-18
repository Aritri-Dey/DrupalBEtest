// js to trim body field to 50 words.
(function ($) {
  $(document).ready(function () {
    $('.field--name-body').each(function(){
      var words = $(this).text().replace(".").replace(",").split(" ").filter(function(a){return a});
      var maxWords = 6;
      if(words.length > maxWords){
        html = words.slice(0,maxWords) +'<span class="show-more" style="display:none;"> '+words.slice(maxWords, words.length)+'</span>' + '<a href="#" class="read_more">...Read More</a>'
        $(this).html(html)
        $(this).find('a.read_more').click(function(event){
          $(this).toggleClass("less");
          event.preventDefault();
          if($(this).hasClass("less")){
            $(this).html("Show Less")
            $(this).parent().find(".show-more").show();
          }
          else {
            $(this).html("...Read More")
            $(this).parent().find(".show-more").hide();
          }
        })
      }
    })
  });
})(jQuery);
