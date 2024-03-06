// Tailwind CSS
import "../css/app.css";


import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Tooltip from "@ryangjchandler/alpine-tooltip";

Alpine.plugin(Tooltip)

Livewire.start()
