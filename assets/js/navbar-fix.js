/* ============================================================
   NAVBAR FIX - Paste this on every page before </body>
   Works on all pages without touching main.js or index.php
   ============================================================ */

(function () {

    // Remove Bootstrap's automatic control over the navbar
    // so our code is the only thing driving open/close
    function stripBootstrapAttributes() {
        // Hamburger button
        var toggler = document.querySelector('.navbar-toggler');
        if (toggler) {
            toggler.removeAttribute('data-bs-toggle');
            toggler.removeAttribute('data-bs-target');
            toggler.removeAttribute('data-toggle');
            toggler.removeAttribute('data-target');
        }

        // All nav dropdown links
        document.querySelectorAll('.navbar-nav .dropdown-toggle').forEach(function (el) {
            el.removeAttribute('data-bs-toggle');
            el.removeAttribute('data-toggle');
        });
    }

    // ── helpers ──────────────────────────────────────────────
    function getCollapse()  { return document.getElementById('main_nav'); }
    function getToggler()   { return document.querySelector('.navbar-toggler'); }

    function closeAllDropdowns() {
        var collapse = getCollapse();
        if (!collapse) return;
        collapse.querySelectorAll('.dropdown-menu.show, .show').forEach(function (el) {
            el.classList.remove('show');
        });
    }

    function closeMenu() {
        var collapse = getCollapse();
        var toggler  = getToggler();
        if (!collapse) return;
        collapse.classList.remove('show');
        if (toggler) {
            toggler.classList.add('collapsed');
            toggler.setAttribute('aria-expanded', 'false');
        }
        document.body.style.overflow = '';
        closeAllDropdowns();
    }

    // ── 1. HAMBURGER ─────────────────────────────────────────
    function initToggler() {
        var toggler  = getToggler();
        var collapse = getCollapse();
        if (!toggler || !collapse) return;

        toggler.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            if (collapse.classList.contains('show')) {
                closeMenu();
            } else {
                collapse.classList.add('show');
                toggler.classList.remove('collapsed');
                toggler.setAttribute('aria-expanded', 'true');
                if (window.innerWidth < 992) {
                    document.body.style.overflow = 'hidden';
                }
            }
        }, true); // capture phase — fires before Bootstrap
    }

    // ── 2. MAIN DROPDOWNS (mobile only) ──────────────────────
    function initMainDropdowns() {
        document.querySelectorAll(
            '.navbar-nav > .nav-item.dropdown > .dropdown-toggle'
        ).forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                if (window.innerWidth >= 992) return;
                e.preventDefault();
                e.stopImmediatePropagation();

                var parentLi = this.closest('.nav-item.dropdown');
                var menu     = parentLi.querySelector(':scope > .dropdown-menu');
                var isOpen   = menu && menu.classList.contains('show');

                // close all other top-level dropdowns
                document.querySelectorAll('.navbar-nav > .nav-item.dropdown').forEach(function (li) {
                    if (li === parentLi) return;
                    var m = li.querySelector(':scope > .dropdown-menu');
                    if (m) m.classList.remove('show');
                    li.classList.remove('show');
                    li.querySelectorAll('.dropdown-submenu, .dropdown-menu').forEach(function (el) {
                        el.classList.remove('show');
                    });
                });

                // toggle this one
                if (menu) menu.classList.toggle('show', !isOpen);
                parentLi.classList.toggle('show', !isOpen);
            }, true);
        });
    }

    // ── 3. SUBMENUS (mobile only) ─────────────────────────────
    function initSubmenus() {
        document.querySelectorAll('.dropdown-submenu > .dropdown-toggle').forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                if (window.innerWidth >= 992) return;
                e.preventDefault();
                e.stopImmediatePropagation();

                var parentLi   = this.closest('.dropdown-submenu');
                var submenu    = parentLi.querySelector(':scope > .dropdown-menu');
                var isOpen     = submenu && submenu.classList.contains('show');

                // close sibling submenus
                var parentMenu = parentLi.closest('.dropdown-menu');
                if (parentMenu) {
                    parentMenu.querySelectorAll(':scope > .dropdown-submenu').forEach(function (sib) {
                        if (sib === parentLi) return;
                        sib.classList.remove('show');
                        var sm = sib.querySelector(':scope > .dropdown-menu');
                        if (sm) sm.classList.remove('show');
                    });
                }

                if (submenu) submenu.classList.toggle('show', !isOpen);
                parentLi.classList.toggle('show', !isOpen);
            }, true);
        });
    }

    // ── 4. OUTSIDE CLICK ──────────────────────────────────────
    function initOutsideClick() {
        document.addEventListener('click', function (e) {
            if (window.innerWidth >= 992) return;
            var collapse = getCollapse();
            if (!collapse || !collapse.classList.contains('show')) return;
            var navbar = document.querySelector('.navbar');
            if (navbar && !navbar.contains(e.target)) {
                closeMenu();
            }
        });
    }

    // ── 5. CLOSE ON REAL LINK CLICK ───────────────────────────
    function initLinkClose() {
        var collapse = getCollapse();
        if (!collapse) return;
        collapse.querySelectorAll(
            '.dropdown-item:not(.dropdown-toggle), .nav-link:not(.dropdown-toggle)'
        ).forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth >= 992) return;
                var href = this.getAttribute('href');
                if (href && href !== '#' && !href.startsWith('javascript:')) {
                    setTimeout(closeMenu, 80);
                }
            });
        });
    }

    // ── 6. RESET ON RESIZE TO DESKTOP ─────────────────────────
    function initResizeReset() {
        var timer;
        window.addEventListener('resize', function () {
            clearTimeout(timer);
            timer = setTimeout(function () {
                if (window.innerWidth >= 992) closeMenu();
            }, 200);
        });
    }

    // ── INIT ──────────────────────────────────────────────────
    function init() {
        stripBootstrapAttributes(); // must run first
        initToggler();
        initMainDropdowns();
        initSubmenus();
        initOutsideClick();
        initLinkClose();
        initResizeReset();
    }

    // Run after DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init(); // DOM already ready
    }

})();