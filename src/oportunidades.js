$(function() {
    $('.oportunidade__btn-toggle').on('click', function(e) {
        const oportunidades = $(this).closest('.oportunidades');
        const oportunidade = $(this).closest('.oportunidade');

        const colCount = oportunidades.css('grid-template-columns').split(' ').length;
        const rowPosition = Math.floor(oportunidade.index() / colCount);
        const colPosition = oportunidade.index() % colCount;

        if (oportunidade.hasClass('oportunidade--open')) {
            oportunidade.fadeOut(500, function() {
                $(this).removeClass('oportunidade--open').show();
                oportunidade.removeAttr('style');
            });
        } else {
            oportunidades.children('.oportunidade--open').removeClass('oportunidade--open').removeAttr('style');

            if (colPosition < colCount - 1) {
                oportunidade.css('grid-column', (colPosition + 1) + ' / span 2');
            } else if (colPosition == colCount - 1) {
                oportunidade.css('grid-column', (colCount - 1) + ' / span 2');
            }

            oportunidade.css('grid-row', (rowPosition + 1) + '/ span 3')

            oportunidade.addClass('oportunidade--open').hide().fadeIn(750);
            $('html, body').animate({
                scrollTop: $(this).offset().top - 32
            }, 250);
        }
    });
});
