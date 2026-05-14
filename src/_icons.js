import { config, library, dom } from '@fortawesome/fontawesome-svg-core'
import {
  faUsers,
  faGraduationCap,
  faLocationDot,
  faStar,
  faBriefcase,
  faDesktop,
  faLink,
  faSun,
  faBuilding,
  faHouse,
  faChevronDown,
  faChevronUp,
  faDollarSign,
  faBuildingColumns,
  faAngleRight,
  faArrowUp,
  faMagnifyingGlass,
  faPlus,
  faArrowUpRightFromSquare,
} from '@fortawesome/free-solid-svg-icons'
import {
  faCalendar,
  faCircleQuestion,
  faCircleRight,
  faCircleXmark,
  faClock,
} from '@fortawesome/free-regular-svg-icons'

// Configurar FontAwesome para substituir automaticamente tags <i>
config.autoReplaceSvg = true

// Registrar todos os ícones na biblioteca
library.add(
  faUsers,
  faGraduationCap,
  faLocationDot,
  faStar,
  faBriefcase,
  faDesktop,
  faLink,
  faSun,
  faBuilding,
  faHouse,
  faChevronDown,
  faChevronUp,
  faDollarSign,
  faBuildingColumns,
  faAngleRight,
  faArrowUp,
  faCalendar,
  faCircleQuestion,
  faCircleRight,
  faCircleXmark,
  faClock,
  faMagnifyingGlass,
  faPlus,
  faArrowUpRightFromSquare,
)

dom.watch()
