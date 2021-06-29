require('./_polyfill_element-closest');
import Flipping from 'flipping/lib/adapters/web';
import bootstrap from 'bootstrap';

const flip = new Flipping();

document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash) {
        let el = document.querySelector('[data-bs-target="' + window.location.hash + '"]');
        if (el) {
            let tab = bootstrap.Tab.getOrCreateInstance(el);
            tab.show();
        }
    }

    let tabs = document.querySelectorAll('button[data-bs-toggle="pill"]');
    tabs.forEach(function(tab) {
        tab.addEventListener('show.bs.tab', function() {
            history.replaceState(null, '', this.dataset.bsTarget);
            document.querySelector(this.dataset.bsTarget).querySelectorAll('.oportunidade--open').forEach(function(open) {
                open.classList.remove('oportunidade--open');
                open.removeAttribute('style');
            });
        });
    });

    const classes = ['animate__animated', 'animate__fadeIn', 'animate__fast'];

    document.querySelectorAll('.oportunidade__btn-toggle').forEach(function(btn) {
        const oportunidades = btn.closest('.oportunidades');
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
                oportunidade.removeAttribute('style');
                oportunidade.classList.add(...classes);
                btn.dataset.bsOriginalTitle = 'Expandir';
            } else { // Open
                oportunidades.querySelectorAll('.oportunidade--open').forEach(function(open) { // Close others
                    open.classList.remove('oportunidade--open');
                    open.removeAttribute('style');
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
});
