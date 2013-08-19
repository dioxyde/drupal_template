jQuery(document).ready(function ($) {

    $("#edit-slogan .fieldset-wrapper").hide();
    $("#edit-slogan .fieldset-legend").click(function(){
        $("#edit-slogan .fieldset-wrapper").slideToggle("slow");
        $(this).toggleClass("active");
        $('#edit-slogan .plus').toggleClass('moins');
    });

    $("#edit-seo .fieldset-wrapper").hide();
    $("#edit-seo .fieldset-legend").click(function(){
        $("#edit-seo .fieldset-wrapper").slideToggle("slow");
        $(this).toggleClass("active");
        $('#edit-seo .plus').toggleClass('moins');
    });

});