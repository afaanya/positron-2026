console.log("POSITRON 2026 ready");

const preventZoom = (event) => {
    if (event.ctrlKey || event.metaKey) {
        event.preventDefault();
    }
};

const zoomKeys = new Set(["-", "+", "=", "0"]);

window.addEventListener("wheel", preventZoom, { passive: false });
window.addEventListener("mousewheel", preventZoom, { passive: false });
window.addEventListener("DOMMouseScroll", preventZoom, { passive: false });

document.addEventListener("keydown", (event) => {
    if ((event.ctrlKey || event.metaKey) && zoomKeys.has(event.key)) {
        event.preventDefault();
    }
}, { passive: false });