// Tailwind CSS
import "../css/app.css";

// AlpineJS
import Alpine from "alpinejs";
import Tooltip from "@ryangjchandler/alpine-tooltip";
import persist from "@alpinejs/persist";

// Turbo
import * as Turbo from "@hotwired/turbo";

Alpine.plugin(Tooltip);
Alpine.plugin(persist);

window.Alpine = Alpine;
Alpine.start();
