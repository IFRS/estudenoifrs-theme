import './_polyfill_element-closest.js';
import Flipping from 'flipping/lib/adapters/web.js';

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

    btn.addEventListener('click', function(e) {
      e.preventDefault();

      const colCount = window.getComputedStyle(oportunidades).getPropertyValue('grid-template-columns').split(' ').length;
      const index = [...oportunidades.children].indexOf(oportunidade);
      const rowPosition = Math.floor(index / colCount);
      const colPosition = index % colCount;

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
    const filter = document.querySelector('.oportunidades-filter');
    const option = event.target.options[event.target.selectedIndex];
    const heading = option.textContent;
    const content = option.dataset.ifrsAlert;

    // Esconde os demais
    document.querySelectorAll('.oportunidades-filter .alert-info').forEach((alert) => {
      filter.removeChild(alert);
    });

    if (content) {
      // Cria e mostra o alert
      let alert = document.createElement('div');
      alert.classList.add('alert', 'alert-info', 'alert-dismissible', 'fade', 'mt-3');
      alert.setAttribute('role', 'alert');
      alert.innerHTML = '<strong>' + heading.trim() + '</strong>' + ': ' + content;
      alert.innerHTML += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar Ajuda"></button>';

      filter.appendChild(alert);

      setTimeout(() => {
        alert.classList.add('show');
      }, 100);
    }
  });
});
