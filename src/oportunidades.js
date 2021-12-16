require('./_polyfill_element-closest');
import Flipping from 'flipping/lib/adapters/web';

const flip = new Flipping();

document.addEventListener('DOMContentLoaded', function() {
    const classes = ['animate__animated', 'animate__fadeIn', 'animate__fast'];

    document.querySelectorAll('.oportunidade__btn-toggle').forEach(function(btn) {
        const oportunidades = btn.closest('.oportunidades__list');
        const oportunidade = btn.closest('.oportunidade');

        oportunidade.addEventListener('animationend', function(e) {
            e.stopPropagation();
            this.classList.remove(...classes);
        });

        const colCount = window.getComputedStyle(oportunidades).getPropertyValue('grid-template-columns').split(' ').length;
        const index = [...oportunidades.children].indexOf(oportunidade);
        const rowPosition = Math.floor(index / colCount);
        const colPosition = index % colCount;

        btn.addEventListener('click', function(e) {
            e.preventDefault();

            flip.read();

            if (oportunidade.classList.contains('oportunidade--open')) { // Close
                oportunidade.classList.remove('oportunidade--open');
                oportunidade.style.gridColumn = '';
                oportunidade.style.gridRow = '';
                oportunidade.classList.add(...classes);
                btn.dataset.bsOriginalTitle = 'Expandir';
            } else { // Open
                oportunidades.querySelectorAll('.oportunidade--open').forEach(function(open) { // Close others
                    open.classList.remove('oportunidade--open');
                    open.style.gridColumn = '';
                    open.style.gridRow = '';
                    open.classList.add(...classes);
                    open.querySelector('.oportunidade__btn-toggle').dataset.bsOriginalTitle = 'Expandir';
                });

                if (colPosition < colCount - 1) {
                    oportunidade.style.gridColumn = (colPosition + 1) + ' / span 2';
                } else if (colPosition == colCount - 1) {
                    oportunidade.style.gridColumn = (colCount - 1) + ' / span 2';
                }

                oportunidade.style.gridRow = (rowPosition + 1) + ' / span 3';
                oportunidade.classList.add('oportunidade--open');
                oportunidade.classList.add(...classes);
                btn.dataset.bsOriginalTitle = 'Fechar';
            }

            flip.flip();
        });
    });

    const niveis = document.querySelector('.oportunidades-filter select[name="curso_nivel[]"]');
    niveis.addEventListener('change', (event) => {
        // Esconde os demais
        document.querySelectorAll('.oportunidades-filter .alert').forEach((alert) => {
            alert.classList.add('d-none');
        });

        // Mostra o alert
        let option = event.target.options[event.target.selectedIndex];
        let id = option.dataset.ifrsToggle;
        let alert = document.querySelector(id);

        if (alert) {
            alert.classList.remove('d-none');
        }
    });
});
