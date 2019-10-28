import { library } from '@fortawesome/fontawesome-svg-core'
import { faRedo, faTimes, faArrowRight, faPen, faQuestion, faVolumeUp } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faRedo, faTimes, faArrowRight, faPen, faQuestion, faVolumeUp )

Vue.component('icon', FontAwesomeIcon)