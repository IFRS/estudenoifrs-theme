import Flipping from 'flipping/lib/adapters/web';

const flip = new Flipping();
console.log(flip);

$(function() {
    $('.oportunidade__btn-toggle').on('click', function(e) {
        flip.read();

        const oportunidades = $(this).closest('.oportunidades');
        const oportunidade = $(this).closest('.oportunidade');

        const colCount = oportunidades.css('grid-template-columns').split(' ').length;
        const rowPosition = Math.floor(oportunidade.index() / colCount);
        const colPosition = oportunidade.index() % colCount;

        if (oportunidade.hasClass('oportunidade--open')) {
            oportunidade.removeAttr('style').removeClass('oportunidade--open').hide().fadeIn(500);
        } else {
            oportunidades.children('.oportunidade--open').removeAttr('style').removeClass('oportunidade--open').hide().fadeIn(500);

            if (colPosition < colCount - 1) {
                oportunidade.css('grid-column', (colPosition + 1) + ' / span 2');
            } else if (colPosition == colCount - 1) {
                oportunidade.css('grid-column', (colCount - 1) + ' / span 2');
            }

            oportunidade.css('grid-row', (rowPosition + 1) + '/ span 3')

            oportunidade.addClass('oportunidade--open').hide().fadeIn(500);
            // $('html, body').animate({
            //     scrollTop: $(this).offset().top - 32
            // }, 250);
        }

        flip.flip();
    });
});
