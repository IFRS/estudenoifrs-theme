import 'bootstrap/js/dist/collapse.js'
import 'bootstrap/js/dist/dropdown.js'
import 'bootstrap/js/dist/modal.js'
import 'bootstrap/js/dist/offcanvas.js'
import 'bootstrap/js/dist/popover.js'
import Tooltip from 'bootstrap/js/dist/tooltip.js'

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new Tooltip(tooltipTriggerEl)
})
