// import './bootstrap'

import Alpine from 'alpinejs'
import Focus from '@alpinejs/focus'
import autoAnimate from '@formkit/auto-animate'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import Tooltip from '@ryangjchandler/alpine-tooltip'

Alpine.plugin(Tooltip)

Alpine.plugin(Focus)
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)
window.Alpine = Alpine
Alpine.directive('animate', (el) => {
  autoAnimate(el)
})
window.Alpine = Alpine

Alpine.start()
