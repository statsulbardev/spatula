// Tailwind CSS
import '../css/app.css';

// AlpineJS
import Alpine from 'alpinejs'
import Tooltip from '@ryangjchandler/alpine-tooltip'
import '../js/sidebar'

Alpine.plugin(Tooltip);

window.Alpine = Alpine
Alpine.start()

// Tailwind Elements
import { Select, initTE } from "tw-elements";
initTE({ Select });
