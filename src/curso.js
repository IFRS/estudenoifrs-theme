function curso_info_resize() {
  let items = document.querySelectorAll('.curso-info:not(.curso-info--turnos)');
  items.forEach(item => {
    if (item.clientHeight > 50) {
      item.style.cssText = 'grid-column: span 2; background-position: left top;';
    } else {
      item.style.cssText = '';
    }
  });
}

document.addEventListener('DOMContentLoaded', curso_info_resize);
window.addEventListener('resize', curso_info_resize);
