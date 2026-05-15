import Collapse from 'bootstrap/js/dist/collapse.js'
import Dropdown from 'bootstrap/js/dist/dropdown.js'
import Modal from 'bootstrap/js/dist/modal.js'
import Offcanvas from 'bootstrap/js/dist/offcanvas.js'
import Popover from 'bootstrap/js/dist/popover.js'
import Tooltip from 'bootstrap/js/dist/tooltip.js'

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new Tooltip(tooltipTriggerEl)
})
