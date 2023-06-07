// Tailwind CSS
import "../css/app.css";

// AlpineJS
import Alpine from "alpinejs";
import Tooltip from "@ryangjchandler/alpine-tooltip";

// Turbo
import * as Turbo from "@hotwired/turbo";

Alpine.plugin(Tooltip);

window.Alpine = Alpine;
Alpine.start();
