document.addEventListener("alpine:init", () => {
    // Stores variable globally
    Alpine.store("sidebar", {
        full: false,
        active: "dashboard",
        navOpen: false,
    });
    // Creating component Dropdown
    Alpine.data("dropdown", () => ({
        open: false,
        toggle(tab) {
            this.open = !this.open;
            Alpine.store("sidebar").active = tab;
        },
        activeClass: "bg-primary-600 text-gray-200",
        expandedClass: "text-sm border-l border-gray-400 ml-4 pl-4",
        shrinkedClass:
            "sm:absolute top-0 left-16 sm:shadow-md sm:z-10 sm:bg-gray-900/40 sm:rounded-md sm:p-4 border-l sm:border-none border-gray-400 ml-4 pl-4 sm:ml-0 w-max backdrop-blur-2xl text-white text-sm",
    }));
    // Creating tooltip
    Alpine.data("tooltip", () => ({
        show: false,
        visibleClass: "block sm:absolute left-12 sm:text-sm sm:bg-gray-600 sm:px-2 sm:py-1 sm:rounded-md",
    }));
    // Dashboard tooltip
    Alpine.data("tiptool", () => ({
        show: false,
        visibleClass: "block sm:absolute left-14 sm:text-sm sm:bg-gray-600 sm:px-2 sm:py-1 sm:rounded-md",
    }));
    // Creating component Sub Dropdown
    // Alpine.data('sub_dropdown', () => ({
    //     sub_open: false,
    //     sub_toggle() {
    //         this.sub_open = !this.sub_open;
    //     },
    //     sub_expandedClass: 'text-sm border-l border-gray-400 ml-4 pl-4',
    //     sub_shrinkedClass: 'sm:absolute top-0 left-15 sm:shadow-md sm:z-10 sm:bg-gray-900/30 sm:rounded-md sm:p-4 border-l sm:border-none border-gray-400 ml-4 pl-4 sm:ml-0 w-56 backdrop-blur-2xl'
    // }));
});
