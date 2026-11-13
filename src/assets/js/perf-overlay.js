// src/assets/js/perf-overlay.js
(function () {
    'use strict';

    const STORAGE_KEY = 'galonku:perf';
    const params = new URLSearchParams(location.search);

    // C2: safe localStorage (throws di private mode / sandboxed iframe)
    function safeGet(key)  { try { return localStorage.getItem(key); } catch { return null; } }
    function safeSet(k, v) { try { localStorage.setItem(k, v); } catch {} }
    function safeDel(k)    { try { localStorage.removeItem(k); } catch {} }

    // C2: performance guard (polyfill lama / environment aneh)
    const perf = (typeof performance !== 'undefined' && performance) || null;
    function now() { return perf && typeof perf.now === 'function' ? perf.now() : Date.now(); }

    if (params.get('perf') === '1') safeSet(STORAGE_KEY, '1');
    if (params.get('perf') === '0') safeDel(STORAGE_KEY);

    let enabled = safeGet(STORAGE_KEY) === '1';
    let overlay = null;
    let rafId = 0;

    let frames = 0, lastSample = now(), fps = 0;
    let frameTimes = [], longestFrame = 0;
    let prevFrame = now();

    const loadInfo = (() => {
        if (!perf || typeof perf.getEntriesByType !== 'function') return '—';
        const nav = perf.getEntriesByType('navigation')[0];
        if (!nav) return '—';
        const t = (nav.loadEventEnd || nav.domContentLoadedEventEnd || 0) - (nav.startTime || 0);
        return t > 0 ? t.toFixed(0) + ' ms' : '—';
    })();

    const currentPage = (() => {
        const p = new URLSearchParams(location.search).get('page') || 'home';
        return p.length > 18 ? p.slice(0, 18) + '…' : p;
    })();

    function buildOverlay() {
        const el = document.createElement('div');
        el.id = 'perf-overlay';
        el.style.cssText = `
            position:fixed;right:8px;bottom:36px;z-index:9998;
            background:silver;color:#222;min-width:190px;
            font-family:"Pixelated MS Sans Serif",Arial,sans-serif;
            font-size:11px;user-select:none;
            box-shadow:inset -1px -1px #0a0a0a,inset 1px 1px #fff,inset -2px -2px grey,inset 2px 2px #dfdfdf;
        `;

        const bar = document.createElement('div');
        bar.style.cssText = `
            background:navy;color:#fff;padding:2px 6px;
            display:flex;justify-content:space-between;align-items:center;
            cursor:move;font-size:11px;
        `;
        bar.innerHTML = '<span>Performance</span><span data-perf-close style="cursor:pointer;padding:0 4px;">×</span>';

        const body = document.createElement('div');
        body.style.cssText = 'padding:6px 8px;line-height:1.5;';
        body.innerHTML = `
            <div>FPS     : <b data-fps>—</b></div>
            <div>Frame   : <b data-frame>—</b> ms</div>
            <div>Worst   : <b data-worst>—</b> ms</div>
            <div>Load    : <b data-load>${loadInfo}</b></div>
            <div>Heap    : <b data-heap>—</b></div>
            <div>Page    : <b data-page>${currentPage}</b></div>
        `;

        el.appendChild(bar);
        el.appendChild(body);
        document.body.appendChild(el);

        bar.querySelector('[data-perf-close]').addEventListener('click', () => toggle(false));

        let drag = null;
        bar.addEventListener('mousedown', (e) => {
            if (e.target.hasAttribute('data-perf-close')) return;
            const r = el.getBoundingClientRect();
            drag = { dx: e.clientX - r.left, dy: e.clientY - r.top };
            el.style.left = r.left + 'px';
            el.style.top = r.top + 'px';
            el.style.right = 'auto';
            el.style.bottom = 'auto';
        });
        window.addEventListener('mousemove', (e) => {
            if (!drag) return;
            el.style.left = (e.clientX - drag.dx) + 'px';
            el.style.top = (e.clientY - drag.dy) + 'px';
        });
        window.addEventListener('mouseup', () => { drag = null; });

        return el;
    }

    function readHeap() {
        const m = perf && perf.memory;
        return m ? (m.usedJSHeapSize / 1048576).toFixed(1) + ' MB' : 'n/a';
    }

    function loop() {
        const t = now();
        frames++;
        const dt = t - lastSample;
        if (dt >= 500) {
            fps = frames * 1000 / dt;
            frames = 0;
            lastSample = t;
        }

        const ft = t - prevFrame;
        prevFrame = t;
        if (ft > 0 && ft < 2000) {
            frameTimes.push(ft);
            if (frameTimes.length > 60) frameTimes.shift();
            if (ft > longestFrame) longestFrame = ft;
        }

        if (overlay) {
            overlay.querySelector('[data-fps]').textContent = fps.toFixed(0);
            overlay.querySelector('[data-frame]').textContent = ft.toFixed(1);
            overlay.querySelector('[data-worst]').textContent = longestFrame.toFixed(1);
            overlay.querySelector('[data-heap]').textContent = readHeap();
        }
        rafId = requestAnimationFrame(loop);
    }

    function start() {
        if (overlay) return;
        overlay = buildOverlay();
        frames = 0;
        lastSample = prevFrame = now();
        frameTimes = [];
        longestFrame = 0;
        rafId = requestAnimationFrame(loop);
    }

    function stop() {
        cancelAnimationFrame(rafId);
        rafId = 0;
        if (overlay) { overlay.remove(); overlay = null; }
    }

    function toggle(force) {
        enabled = typeof force === 'boolean' ? force : !enabled;
        if (enabled) { safeSet(STORAGE_KEY, '1'); start(); }
        else { safeDel(STORAGE_KEY); stop(); }
    }

    window.addEventListener('keydown', (e) => {
        if (e.ctrlKey && e.shiftKey && (e.key === 'P' || e.key === 'p')) {
            e.preventDefault();
            toggle();
        }
    });

    if (enabled) {
        if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
        else start();
    }

    window.galonkuPerf = { toggle, start, stop };
})();
