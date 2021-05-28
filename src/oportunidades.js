$(function() {
    $('.oportunidade__btn-toggle').on('click', function(e) {
        if ($(this).closest('.oportunidade').hasClass('oportunidade--open')) {
            $(this).closest('.oportunidade').fadeOut(500, function() {
                $(this).removeClass('oportunidade--open').show();
            });
        } else {
            $(this).closest('.oportunidades').children('.oportunidade--open').removeClass('oportunidade--open');
            $(this).closest('.oportunidade').addClass('oportunidade--open').hide().fadeIn(750);
            $('html, body').animate({
                scrollTop: $(this).offset().top - 30
            }, 250);
        }
    });
});
