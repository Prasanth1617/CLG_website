/*=====================================================
Template Name   : Eduka - FIXED FOR MOBILE
Description     : School, College, University And Courses HTML5 Template
Author          : LunarTemp
Version         : 1.0 (Mobile Navigation Fixed)
=======================================================*/

(function ($) {
    
    "use strict";

    // Desktop dropdown hover handled by CSS

    // ===================================
    // DATA BACKGROUND
    // ===================================
    
    $(document).on('ready', function () {
        $("[data-background]").each(function () {
            $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
        });
    });

    // ===================================
    // NAVBAR SEARCH
    // ===================================
    
    if ($('.search-box-outer').length) {
        $('.search-box-outer').on('click', function () {
            $('body').addClass('search-active');
        });
        $('.close-search').on('click', function () {
            $('body').removeClass('search-active');
        });
    }

    // ===================================
    // WOW ANIMATION
    // ===================================
    
    new WOW().init();

    // ===================================
    // HERO SLIDER
    // ===================================
    
    $('.hero-slider').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        margin: 0,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 5000,
        items: 1,
        navText: [
            "<i class='far fa-long-arrow-left'></i>",
            "<i class='far fa-long-arrow-right'></i>"
        ],
        onInitialized: function(event) {
            var $firstAnimatingElements = $('.owl-item').eq(event.item.index).find("[data-animation]");
            doAnimations($firstAnimatingElements);
        },
        onChanged: function(event){
            var $firstAnimatingElements = $('.owl-item').eq(event.item.index).find("[data-animation]");
            doAnimations($firstAnimatingElements);
        }
    });

    // Hero slider animations
    function doAnimations(elements) {
        var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        elements.each(function () {
            var $this = $(this);
            var $animationDelay = $this.data('delay');
            var $animationDuration = $this.data('duration');
            var $animationType = 'animated ' + $this.data('animation');
            $this.css({
                'animation-delay': $animationDelay,
                '-webkit-animation-delay': $animationDelay,
                'animation-duration': $animationDuration,
                '-webkit-animation-duration': $animationDuration,
            });
            $this.addClass($animationType).one(animationEndEvents, function () {
                $this.removeClass($animationType);
            });
        });
    }

    // ===================================
    // TESTIMONIAL SLIDER
    // ===================================
    
    $('.testimonial-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        autoplay: true,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 4 }
        }
    });

    // ===================================
    // EVENT SLIDER
    // ===================================
    
    $('.event-slider').owlCarousel({
        loop: true,
        margin: 25,
        nav: true,
        dots: true,
        autoplay: false,
        navText: [
            "<i class='far fa-angle-left'></i>",
            "<i class='far fa-angle-right'></i>"
        ],
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 3 }
        }
    });

    // ===================================
    // DEPARTMENT SLIDER
    // ===================================
    
    $('.department-slider').owlCarousel({
        loop: true,
        margin: 25,
        nav: true,
        dots: true,
        autoplay: false,
        navText: [
            "<i class='far fa-angle-left'></i>",
            "<i class='far fa-angle-right'></i>"
        ],
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 4 }
        }
    });

    // ===================================
    // PARTNER SLIDER
    // ===================================
    
    $('.partner-slider').owlCarousel({
        loop: true,
        margin: 70,
        nav: false,
        dots: false,
        autoplay: true,
        responsive: {
            0: { items: 2 },
            600: { items: 3 },
            1000: { items: 6 }
        }
    });

    // ===================================
    // PRELOADER
    // ===================================
    
    $(window).on('load', function () {
        $(".preloader").fadeOut("slow");
    });

    // ===================================
    // FUN FACT COUNTER
    // ===================================
    
    $('.counter').countTo();
    $('.counter-box').appear(function () {
        $('.counter').countTo();
    }, { accY: -100 });

    // ===================================
    // MAGNIFIC POPUP
    // ===================================
    
    $(".popup-gallery").magnificPopup({
        delegate: '.popup-img',
        type: 'image',
        gallery: { enabled: true },
    });

    $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // ===================================
    // SCROLL TO TOP
    // ===================================
    
    $(window).on('scroll',function () {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            $("#scroll-top").addClass('active');
        } else {
            $("#scroll-top").removeClass('active');
        }
    });

    $("#scroll-top").on('click', function () {
        $("html, body").animate({ scrollTop: 0 }, 1500);
        return false;
    });

    // ===================================
    // NAVBAR FIXED TOP
    // ===================================
    
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass("fixed-top");
        } else {
            $('.navbar').removeClass("fixed-top");
        }
    });

    // ===================================
    // PROJECT FILTER
    // ===================================
    
    $(window).on('load', function () {
        if ($(".filter-box").children().length > 0) {
            $(".filter-box").isotope({
                itemSelector: '.filter-item',
                masonry: { columnWidth: 1 },
            });

            $('.filter-btn').on('click', 'li', function () {
                var filterValue = $(this).attr('data-filter');
                $(".filter-box").isotope({ filter: filterValue });
            });

            $(".filter-btn li").each(function () {
                $(this).on("click", function () {
                    $(this).siblings("li.active").removeClass("active");
                    $(this).addClass("active");
                });
            });
        }
    });

    // ===================================
    // PROGRESS BAR
    // ===================================
    
    $(document).ready(function(){
        var progressBar = $('.progress');
        if(progressBar.length) {
            progressBar.each(function () {
                var Self = $(this);
                Self.appear(function () {
                    var progressValue = Self.data('value');
                    Self.find('.progress-bar').animate({
                        width:progressValue+'%'           
                    }, 1000);
                });
            })
        }
    });

    // ===================================
    // COUNTDOWN
    // ===================================
    
    if ($('#countdown').length) {
        $('#countdown').countdown('2030/01/30', function (event) {
            $(this).html(event.strftime('' + '<div class="row">' + '<div class="col countdown-single">' + '<h2 class="mb-0">%-D</h2>' + '<h5 class="mb-0">Day%!d</h5>' + '</div>' + '<div class="col countdown-single">' + '<h2 class="mb-0">%H</h2>' + '<h5 class="mb-0">Hours</h5>' + '</div>' + '<div class="col countdown-single">' + '<h2 class="mb-0">%M</h2>' + '<h5 class="mb-0">Minutes</h5>' + '</div>' + '<div class="col countdown-single">' + '<h2 class="mb-0">%S</h2>' + '<h5 class="mb-0">Seconds</h5>' + '</div>' + '</div>'));
        });
    }

    // ===================================
    // COPYRIGHT DATE
    // ===================================
    
    let date = new Date().getFullYear();
    $("#date").html(date);

})(jQuery);

// ===================================
// MOBILE NAVIGATION
// ===================================

document.addEventListener('DOMContentLoaded', function () {

    var navCollapse = document.getElementById('main_nav');
    var toggler     = document.querySelector('.navbar-toggler');

    // ── helpers ──────────────────────────────────────────────────────
    function closeAllDropdowns() {
        if (!navCollapse) return;
        navCollapse.querySelectorAll('.dropdown-menu.show').forEach(function (m) {
            m.classList.remove('show');
        });
        navCollapse.querySelectorAll('.show').forEach(function (el) {
            el.classList.remove('show');
        });
    }

    function closeMenu() {
        if (!navCollapse) return;
        navCollapse.classList.remove('show');
        if (toggler) {
            toggler.classList.add('collapsed');
            toggler.setAttribute('aria-expanded', 'false');
        }
        document.body.style.overflow = '';
        closeAllDropdowns();
    }

    // ── 1. HAMBURGER ─────────────────────────────────────────────────
    // Use CAPTURE phase (3rd arg = true) so this fires BEFORE Bootstrap
    if (toggler && navCollapse) {
        toggler.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation(); // stop Bootstrap firing too

            if (navCollapse.classList.contains('show')) {
                closeMenu();
            } else {
                navCollapse.classList.add('show');
                toggler.classList.remove('collapsed');
                toggler.setAttribute('aria-expanded', 'true');
                if (window.innerWidth < 992) {
                    document.body.style.overflow = 'hidden';
                }
            }
        }, true); // <-- capture phase: beats Bootstrap's bubble listener
    }

    // ── 2. MAIN DROPDOWNS (mobile only) ──────────────────────────────
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

            // close every other top-level dropdown
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

    // ── 3. SUBMENUS (mobile only) ─────────────────────────────────────
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

    // ── 4. OUTSIDE CLICK closes menu ──────────────────────────────────
    document.addEventListener('click', function (e) {
        if (window.innerWidth >= 992) return;
        if (!navCollapse || !navCollapse.classList.contains('show')) return;
        var navbar = document.querySelector('.navbar');
        if (navbar && !navbar.contains(e.target)) {
            closeMenu();
        }
    });

    // ── 5. CLOSE ON REAL LINK CLICK ───────────────────────────────────
    if (navCollapse) {
        navCollapse.querySelectorAll(
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

    // ── 6. RESIZE RESET ───────────────────────────────────────────────
    var resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            if (window.innerWidth >= 992) closeMenu();
        }, 200);
    });

});

// ===================================
// SIDE PANEL (More Information)
// ===================================

document.addEventListener('DOMContentLoaded', function() {
    const moreInfoBtn = document.getElementById('more-info-btn');
    const sidePanel = document.getElementById('side-panel');
    
    if (moreInfoBtn && sidePanel) {
        moreInfoBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = sidePanel.classList.contains('active');
            
            if (isOpen) {
                sidePanel.classList.remove('active');
                this.classList.remove('active');
                document.body.style.overflow = '';
                console.log('📋 Side panel closed');
            } else {
                sidePanel.classList.add('active');
                this.classList.add('active');
                document.body.style.overflow = 'hidden';
                console.log('📋 Side panel opened');
            }
        });
        
        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (sidePanel.classList.contains('active')) {
                if (!sidePanel.contains(e.target) && !moreInfoBtn.contains(e.target)) {
                    sidePanel.classList.remove('active');
                    moreInfoBtn.classList.remove('active');
                    document.body.style.overflow = '';
                    console.log('📋 Side panel closed (outside click)');
                }
            }
        });
    }
});

// ===================================
// GOOGLE TRANSLATE
// ===================================

function googleTranslateElementInit() {
    if (document.getElementById('google_translate_element')) {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,ta,hi',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
        console.log('🌐 Google Translate initialized');
    }
}

// Move translate widget for mobile/desktop
function moveTranslateWidget() {
    const widget = document.getElementById("google_translate_element");
    const mobileContainer = document.querySelector(".translate-mobile");
    const desktopContainer = document.querySelector(".translate-desktop");

    if (widget) {
        if (window.innerWidth <= 768) {
            if (mobileContainer && !mobileContainer.contains(widget)) {
                mobileContainer.appendChild(widget);
                console.log('📱 Translate widget moved to mobile');
            }
        } else {
            if (desktopContainer && !desktopContainer.contains(widget)) {
                desktopContainer.appendChild(widget);
                console.log('💻 Translate widget moved to desktop');
            }
        }
    }
}

window.addEventListener("resize", moveTranslateWidget);
window.addEventListener("load", () => {
    setTimeout(moveTranslateWidget, 1000);
});

// ===================================
// SEARCH MODAL FUNCTIONS
// ===================================

function openSearchModal() {
    const modal = document.getElementById('searchModal');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.focus();
            }
        }, 100);
        console.log('🔍 Search modal opened');
    }
}

function closeSearchModal() {
    const modal = document.getElementById('searchModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
        console.log('🔍 Search modal closed');
    }
}

function quickSearch(term) {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    
    if (searchInput && searchForm) {
        searchInput.value = term;
        searchForm.submit();
        console.log('🔍 Quick search:', term);
    }
}

// Search modal event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSearchModal();
        }
    });
    
    // Close on outside click
    const searchModal = document.getElementById('searchModal');
    if (searchModal) {
        searchModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeSearchModal();
            }
        });
    }
    
    console.log('🔍 Search modal initialized');
});

// ===================================
// PREVENT GOOGLE TRANSLATE TOP BAR
// ===================================

window.addEventListener('load', function() {
    // Force remove Google Translate top bar
    if (document.body) {
        document.body.style.top = '0px !important';
    }
    
    // Hide Google Translate elements
    const style = document.createElement('style');
    style.innerHTML = `
        .VIpgJd-ZVi9od-ORHb-OEVmcd {
            display: none !important;
        }
        body {
            top: 0px !important;
            position: static !important;
        }
        .goog-logo-link, .goog-te-gadget span {
            display: none !important;
        }
        .goog-te-gadget {
            color: transparent !important;
        }
        .skiptranslate {
            display: none !important;
        }
        #goog-gt-tt {
            display: none !important;
        }
    `;
    document.head.appendChild(style);
    
    console.log('🌐 Google Translate bar hidden');
});

// ===================================
// SEARCH DATA (Optional)
// ===================================

let searchTimeout;
const searchData = [
    // About
    {title: 'Institution', desc: 'About our institution, history and establishment', url: 'institution.php', icon: 'far fa-building', keywords: 'about institution history college establishment'},
    {title: 'Vision & Mission', desc: 'Our vision and mission statements', url: 'vission&mission.php', icon: 'far fa-eye', keywords: 'vision mission goals objectives'},
    {title: 'Milestones', desc: 'Key achievements and milestones', url: 'milestones.php', icon: 'far fa-trophy', keywords: 'achievements milestones success'},
    {title: 'Annual Reports', desc: 'View our annual reports', url: 'annual-reports.php', icon: 'far fa-file-alt', keywords: 'annual reports yearly'},
    
    // Administration
    {title: 'Our Principal', desc: 'Meet our Principal', url: 'principal.php', icon: 'far fa-user-tie', keywords: 'principal head leadership director'},
    {title: 'Board of Management', desc: 'Board of Management members', url: 'board.php', icon: 'far fa-users-cog', keywords: 'board management'},
    {title: 'Academic Leadership', desc: 'Academic leaders and HODs', url: 'Leadership.php', icon: 'far fa-users', keywords: 'leadership hod heads'},
    
    // Academics
    {title: 'UG Courses', desc: 'Undergraduate: B.Sc, B.Com, B.A, BBA, BCA programs', url: 'ug.php', icon: 'far fa-graduation-cap', keywords: 'undergraduate ug bsc bcom ba bba bca bachelors degree courses'},
    {title: 'PG Courses', desc: 'Postgraduate: M.Sc, M.Com, M.A, MBA programs', url: 'pg.php', icon: 'far fa-user-graduate', keywords: 'postgraduate pg msc mcom ma mba masters degree courses'},
    {title: 'Faculty', desc: 'Our teaching faculty and professors', url: 'faculty.php', icon: 'far fa-chalkboard-teacher', keywords: 'faculty teachers professors lecturers staff'},
    {title: 'Academic Calendar', desc: 'Academic calendar and important dates', url: 'calender.php', icon: 'far fa-calendar-alt', keywords: 'calendar schedule dates semester'},
    {title: 'Examination', desc: 'Exam details and schedules', url: 'exam.php', icon: 'far fa-file-alt', keywords: 'exam examination test results marks'},
    {title: 'IQAC', desc: 'Internal Quality Assurance Cell', url: 'iqac.php', icon: 'far fa-award', keywords: 'iqac quality naac accreditation'},
    
    // Facilities
    {title: 'Library', desc: 'College library with books and resources', url: 'library.php', icon: 'far fa-book', keywords: 'library books resources journals'},
    {title: 'Hostel', desc: 'Hostel accommodation for students', url: 'hostel.php', icon: 'far fa-bed', keywords: 'hostel accommodation residence stay'},
    {title: 'Laboratory', desc: 'Well-equipped labs for practicals', url: 'lab.php', icon: 'far fa-flask', keywords: 'lab laboratory practical computer science'},
    {title: 'Bus Facility', desc: 'College bus transportation', url: 'bus-facility.php', icon: 'far fa-bus', keywords: 'bus transport transportation'},
    
    // Student Life
    {title: 'Sports', desc: 'Sports and athletics facilities', url: 'sports.php', icon: 'far fa-futbol', keywords: 'sports games athletics cricket football'},
    {title: 'NCC/NSS', desc: 'NCC and NSS activities', url: 'ncc-nss.php', icon: 'far fa-flag', keywords: 'ncc nss social service volunteer'},
    {title: 'Clubs & Associations', desc: 'Student clubs and activities', url: 'association.php', icon: 'far fa-users', keywords: 'clubs associations student activities'},
    {title: 'Anti-Ragging', desc: 'Anti-ragging policy and committee', url: 'anti-ragging.php', icon: 'far fa-shield-alt', keywords: 'ragging safety security policy'},
    
    // Important
    {title: 'Admissions & Apply', desc: 'Admission process and application form', url: 'application-form.php', icon: 'far fa-file-signature', keywords: 'admission apply application registration enroll'},
    {title: 'Fees Details', desc: 'Fee structure and payment details', url: 'feesdetail.php', icon: 'far fa-money-bill', keywords: 'fees fee structure payment tuition'},
    {title: 'Placement', desc: 'Placement cell and job opportunities', url: 'placement.php', icon: 'far fa-briefcase', keywords: 'placement jobs career recruitment'},
    {title: 'Gallery', desc: 'Photo gallery of events and campus', url: 'gallery.php', icon: 'far fa-images', keywords: 'gallery photos pictures events'},
    {title: 'Contact Us', desc: 'Contact information and location', url: 'contact.php', icon: 'far fa-phone', keywords: 'contact address phone email map'},
    {title: 'Alumni', desc: 'Alumni network and registration', url: 'alumni.php', icon: 'far fa-user-friends', keywords: 'alumni graduates former students'},
    {title: 'Events & News', desc: 'Latest events and achievements', url: 'event.php', icon: 'far fa-calendar-check', keywords: 'events news achievements updates'},
];

// Live search function (Optional - if you want to use it)
function liveSearch(query) {
    clearTimeout(searchTimeout);
    const resultsDiv = document.getElementById('searchResults');
    
    if (!resultsDiv) return;
    
    if (query.trim().length < 2) {
        resultsDiv.innerHTML = '';
        return;
    }
    
    resultsDiv.innerHTML = '<div class="search-loading"><i class="fas fa-spinner"></i> Searching...</div>';
    
    searchTimeout = setTimeout(() => {
        const results = searchData.filter(item => {
            const searchTerm = query.toLowerCase();
            return item.title.toLowerCase().includes(searchTerm) ||
                   item.desc.toLowerCase().includes(searchTerm) ||
                   item.keywords.toLowerCase().includes(searchTerm);
        });
        
        displayResults(results, query);
    }, 300);
}

// Display search results (Optional)
function displayResults(results, query) {
    const resultsDiv = document.getElementById('searchResults');
    
    if (!resultsDiv) return;
    
    if (results.length === 0) {
        resultsDiv.innerHTML = `
            <div class="no-results">
                <i class="far fa-search"></i>
                <p>No results found for "${query}"</p>
            </div>
        `;
        return;
    }
    
    let html = '';
    results.slice(0, 8).forEach(item => {
        html += `
            <a href="${item.url}" class="search-result-item">
                <i class="${item.icon} result-icon"></i>
                <div>
                    <div class="result-title">${item.title}</div>
                    <div class="result-desc">${item.desc}</div>
                </div>
            </a>
        `;
    });
    
    resultsDiv.innerHTML = html;
}

// ===================================
// DEBUG MODE
// ===================================

// Set to false to disable console logs in production
const DEBUG_MODE = true;

if (!DEBUG_MODE) {
    console.log = function() {};
}

// ===================================
// READY STATE
// ===================================

console.log('✅ Main.js loaded successfully');
console.log('📱 Mobile navigation ready');
console.log('🔍 Search functionality ready');
console.log('📋 Side panel ready');
console.log('🌐 Google Translate ready');

