// src/assets/js/sidebar.js — auto-open/close sidebar <details> berdasarkan viewport
(function () {
    'use strict';
    var toggles = document.querySelectorAll('[data-sidebar-toggle]');
    if (!toggles.length) return;

    var mq = window.matchMedia('(min-width: 768px)');

    function sync() {
        toggles.forEach(function (el) { el.open = mq.matches; });
    }

    sync();
    if (typeof mq.addEventListener === 'function') {
        mq.addEventListener('change', sync);
    } else if (typeof mq.addListener === 'function') {
        mq.addListener(sync);
    }
})();
