<?php
/**
 * THENI KAMMAVAR SANGAM COLLEGE
 * Redesigned Header — Text Logo + Full Navigation
 * Drop-in replacement: include this file in place of the existing <header> block
 */
?>

<!-- ══════════════════════════════════════════════
     HEADER STYLES  (paste into index.css if preferred)
══════════════════════════════════════════════ -->
<style>
/* ── Variables ─────────────────────────────────── */
:root {
  --tks-red:      #8B1A1A;
  --tks-red-dark: #6A1212;
  --tks-gold:     #C8921A;
  --tks-gold-lt:  #E8AC30;
  --tks-navy:     #0F2545;
  --tks-navy-lt:  #17356A;
  --tks-dark:     #111111;
  --tks-white:    #FFFFFF;
  --tks-cream:    #FDF8F1;
  --tks-muted:    #8A7A68;
  --tks-border:   rgba(200,146,26,0.25);
}

/* ── Reset scoped to header ─────────────────────── */
.tks-header *, .tks-header *::before, .tks-header *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* ════════════════════════════════════════════════
   1. TOP INFO BAR
════════════════════════════════════════════════ */
.tks-topbar {
  background: var(--tks-red-dark);
  padding: 6px 0;
  font-size: 12.5px;
  font-family: 'DM Sans', sans-serif;
}
.tks-topbar .tks-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 6px;
}
.tks-topbar-left,
.tks-topbar-right {
  display: flex;
  align-items: center;
  gap: 18px;
  flex-wrap: wrap;
}
.tks-topbar a,
.tks-topbar span {
  color: #fff;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: color 0.2s;
  white-space: nowrap;
}
.tks-topbar a:hover { color: var(--tks-gold-lt); }
.tks-topbar i { font-size: 12px; color: var(--tks-gold-lt); }
.tks-topbar-sep {
  color: rgba(255,255,255,0.2) !important;
  font-size: 14px;
}
.tks-topbar-right a {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  padding: 2px 12px;
  border-radius: 20px;
  font-size: 11.5px;
  font-weight: 500;
  letter-spacing: 0.3px;
  transition: background 0.2s, color 0.2s;
}
.tks-topbar-right a:hover {
  background: var(--tks-gold);
  color: var(--tks-dark);
  border-color: var(--tks-gold);
}

/* ════════════════════════════════════════════════
   2. LOGO / IDENTITY BAR
════════════════════════════════════════════════ */
.tks-identity {
  background: var(--tks-cream);
  border-bottom: 3px solid var(--tks-gold);
  padding: 6px 0;
}
.tks-identity .tks-container {
  display: flex;
  align-items: center;
  gap: 10px;
}

/* — Logo Image — */
.tks-emblem {
  flex-shrink: 0;
  display: block;
  text-decoration: none;
}
.tks-emblem img {
  height: 115px;
  width: auto;
  display: block;
  object-fit: contain;
}

/* — College name block — */
.tks-college-name {
  flex: 0 1 auto;
  display: flex;
  flex-direction: column;
  gap: 1px;
  min-width: 0;
  overflow: hidden;

}

/* — 50th Anniversary Badge — */
.tks-anniversary-badge {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  text-decoration: none;
  margin-left: 10px;
}
.tks-anniversary-badge img {
  height: 110px;
  width: auto;
  display: block;
  object-fit: contain;
}

.tks-divider-img {
  width: 100%;
  max-width: 260px;
  height: auto;
  display: block;
  margin: 2px auto;
  object-fit: contain;
}
.tks-college-name .sangam {
  font-family: Georgia, 'Times New Roman', serif;
  font-size: 17px;
  font-weight: 700;
  color: var(--tks-navy);
  letter-spacing: 2px;
  text-transform: uppercase;
  line-height: 1.2;
  text-align: center;
}
.tks-college-name .college {
  font-family: Georgia, 'Times New Roman', serif;
  font-size: 18px;
  font-weight: 800;
  color: var(--tks-navy);
  line-height: 1.15;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  text-align: center;
}
.tks-college-name .college .coed {
  font-size: 12px;
  font-weight: 600;
  color: var(--tks-navy);
  text-transform: none;
  letter-spacing: 0;
}
.tks-college-name .affil {
  font-size: 14px;
  color: #333;
  margin-top: 2px;
  line-height: 1.5;
  text-align: center;
}
.tks-college-name .address {
  font-size: 10.5px;
  font-weight: 700;
  color: #111;
  text-align: center;
  margin-top: 1px;
  letter-spacing: 0.3px;
}

/* — Accreditation badges — */
.tks-badges {
  display: flex;
  flex-direction: column;
  gap: 7px;
  flex-shrink: 0;
  margin-left: auto;
}
/* Top row: images */
.tks-badges-images {
  display: flex;
  align-items: center;
  gap: 10px;
}
.tks-badges-images img {
  height: 40px;
  width: auto;
  object-fit: contain;
  display: block;
}

/* Bottom row: pill badges */
.tks-badges-pills {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
  justify-content: flex-end;
}
.tks-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 12px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.5px;
  white-space: nowrap;
}
.tks-badge-red {
  background: var(--tks-red);
  color: #fff;
  border: 1px solid rgba(255,255,255,0.15);
}
.tks-badge-navy {
  background: var(--tks-navy);
  color: #fff;
  border: 1px solid rgba(255,255,255,0.1);
}
.tks-badge-gold {
  background: var(--tks-gold);
  color: var(--tks-dark);
  font-weight: 700;
}
.tks-badge i { font-size: 10px; }

/* ════════════════════════════════════════════════
   3. MAIN NAVIGATION
════════════════════════════════════════════════ */
.tks-nav-wrap {
  background: var(--tks-navy);
  position: sticky;
  top: 0;
  z-index: 999;
  box-shadow: 0 3px 16px rgba(0,0,0,0.35);
}
.tks-nav-wrap .tks-container {
  display: flex;
  align-items: stretch;
  position: relative;
}

/* Nav list */
.tks-nav-list {
  display: flex;
  list-style: none;
  flex: 1;
  padding: 0;
  margin: 0;
}
.tks-nav-list > li {
  position: relative;
}
.tks-nav-list > li > a {
  display: flex;
  align-items: center;
  gap: 4px;
  height: 48px;
  padding: 0 10px;
  font-size: 16px;
  font-weight: 500;
  color: #ffffff;
  text-decoration: none;
  white-space: nowrap;
  border-bottom: 3px solid transparent;
  transition: color 0.2s, background 0.2s, border-color 0.2s;
  letter-spacing: 0.1px;
}
.tks-nav-list > li > a .tks-caret {
  font-size: 8px;
  opacity: 0.55;
  margin-top: 1px;
  transition: transform 0.2s;
}
.tks-nav-list > li:hover > a,
.tks-nav-list > li.active > a {
  color: #fff;
  background: rgba(255,255,255,0.06);
  border-bottom-color: var(--tks-gold);
}
.tks-nav-list > li:hover > a .tks-caret {
  transform: rotate(180deg);
}

/* Dropdown */
.tks-dropdown {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  min-width: 230px;
  background: #0D1F40;
  border-top: 3px solid var(--tks-gold);
  border-radius: 0 0 8px 8px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.45);
  z-index: 1000;
  padding: 6px 0;
  animation: tksDropIn 0.18s ease;
}
@keyframes tksDropIn {
  from { opacity: 0; transform: translateY(8px); }
  to   { opacity: 1; transform: translateY(0); }
}
.tks-nav-list > li:hover .tks-dropdown {
  display: block;
}
.tks-dropdown a {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 9px 20px;
  font-size: 13px;
  color: rgba(255,255,255,0.75);
  text-decoration: none;
  border-bottom: 1px solid rgba(255,255,255,0.05);
  transition: background 0.15s, color 0.15s, padding-left 0.15s;
}
.tks-dropdown a:last-child { border-bottom: none; }
.tks-dropdown a::before {
  content: '';
  display: inline-block;
  width: 5px;
  height: 5px;
  background: var(--tks-gold);
  border-radius: 50%;
  flex-shrink: 0;
  opacity: 0;
  transition: opacity 0.15s;
}
.tks-dropdown a:hover {
  background: rgba(200,146,26,0.12);
  color: var(--tks-gold-lt);
  padding-left: 26px;
}
.tks-dropdown a:hover::before { opacity: 1; }

/* Submenu (nested) */
.tks-submenu-wrap {
  position: relative;
}
.tks-submenu-wrap > a::after {
  content: '›';
  margin-left: auto;
  font-size: 16px;
  opacity: 0.5;
}
.tks-submenu {
  display: none;
  position: absolute;
  top: -6px;
  left: 100%;
  min-width: 200px;
  background: #0D1F40;
  border-top: 3px solid var(--tks-gold);
  border-radius: 0 8px 8px 8px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.45);
  padding: 6px 0;
  z-index: 1001;
}
.tks-submenu-wrap:hover .tks-submenu { display: block; }

/* Nav right buttons */
.tks-nav-right {
  display: flex;
  align-items: center;
  gap: 0;
  flex-shrink: 0;
}
.tks-search-btn {
  width: 46px;
  height: 48px;
  background: none;
  border: none;
  color: rgba(255,255,255,0.65);
  font-size: 14px;
  cursor: pointer;
  transition: color 0.2s, background 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
  border-left: 1px solid rgba(255,255,255,0.08);
}
.tks-search-btn:hover {
  color: var(--tks-gold-lt);
  background: rgba(255,255,255,0.05);
}
.tks-apply-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 0 18px;
  height: 48px;
  background: var(--tks-gold);
  color: var(--tks-dark);
  font-size: 13px;
  font-weight: 700;
  text-decoration: none;
  letter-spacing: 0.4px;
  transition: background 0.2s;
  white-space: nowrap;
  border-left: 1px solid rgba(0,0,0,0.1);
}
.tks-apply-btn:hover {
  background: var(--tks-gold-lt);
  color: var(--tks-dark);
  text-decoration: none;
}
.tks-apply-btn i { font-size: 12px; }

/* ════════════════════════════════════════════════
   4. NEWS TICKER
════════════════════════════════════════════════ */
.tks-ticker {
  background: #0F2545;
  border-top: 1px solid rgba(255,255,255,0.06);
  padding: 0;
  display: flex;
  align-items: stretch;
  overflow: hidden;
  height: 38px;
}
.tks-ticker-label {
  display: flex;
  align-items: center;
  padding: 0 18px;
  background: var(--tks-gold);
  color: var(--tks-dark);
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  flex-shrink: 0;
  white-space: nowrap;
  clip-path: polygon(0 0, 88% 0, 100% 50%, 88% 100%, 0 100%);
  padding-right: 28px;
}
.tks-ticker-body {
  flex: 1;
  overflow: hidden;
  display: flex;
  align-items: center;
}
.tks-ticker-scroll {
  display: inline-block;
  white-space: nowrap;
  animation: tksMarquee 35s linear infinite;
  font-size: 13px;
  color: rgba(255,255,255,0.8);
  padding-left: 20px;
}
@keyframes tksMarquee {
  from { transform: translateX(100%); }
  to   { transform: translateX(-100%); }
}
.tks-ticker-scroll a {
  color: #63C5E8;
  font-weight: 600;
  text-decoration: none;
  margin: 0 4px;
  transition: color 0.2s;
}
.tks-ticker-scroll a:hover { color: var(--tks-gold-lt); text-decoration: underline; }
.tks-ticker-scroll .tks-bullet {
  display: inline-block;
  margin: 0 24px;
  color: var(--tks-gold);
  opacity: 0.6;
}

/* ════════════════════════════════════════════════
   5. MOBILE HAMBURGER
════════════════════════════════════════════════ */
.tks-mob-toggle {
  display: none;
  align-items: center;
  justify-content: center;
  width: 48px;
  height: 52px;
  background: none;
  border: none;
  cursor: pointer;
  color: rgba(255,255,255,0.85);
  font-size: 20px;
  margin-left: auto;
}

/* ════════════════════════════════════════════════
   6. SHARED CONTAINER
════════════════════════════════════════════════ */
.tks-header .tks-container {
  max-width: 1440px;
  margin: 0 auto;
  padding: 0 24px;
  width: 100%;
}
.tks-identity .tks-container { padding: 0 4px; }

/* ════════════════════════════════════════════════
   7. RESPONSIVE
════════════════════════════════════════════════ */

/* ── Tablet landscape (≤1100px) ─────────────────── */
@media (max-width: 1100px) {
  .tks-nav-list > li > a { padding: 0 11px; font-size: 14.5px; }
  .tks-apply-btn { padding: 0 16px; font-size: 12.5px; }
  /* .tks-badges { display: none; } */
  .tks-college-name .sangam { font-size: 14px; }
  .tks-college-name .college { font-size: 22px; }
  .tks-anniversary-badge img { height: 115px; }
    .tks-college-name .affil { font-size: 11.5px; }

}
@media (max-width: 991px) {
    .tks-badges
    {
        display: none;
    }
}
/* ── Tablet portrait (≤768px) ───────────────────── */
@media (max-width: 768px) {
  /* Nav */
  .tks-mob-toggle { display: flex; }
  .tks-nav-list { display: none; flex-direction: column; width: 100%; }
  /* .tks-nav-wrap .tks-container { flex-wrap: wrap; } */
  .tks-nav-list.tks-open { display: flex; }
  .tks-nav-list > li > a { height: 46px; border-bottom: 1px solid rgba(255,255,255,0.07); }
  .tks-nav-list > li > a .tks-caret { margin-left: auto; }
  .tks-dropdown { position: static; box-shadow: none; border-radius: 0; border-top: none;
    border-left: 3px solid var(--tks-gold); margin-left: 16px; animation: none; }
  .tks-nav-list > li:hover .tks-dropdown { display: none; }
  .tks-nav-list > li.tks-open-m .tks-dropdown { display: block; }
  .tks-nav-right { width: 100%; justify-content: flex-end; border-top: 1px solid rgba(255,255,255,0.08); }
  /* Topbar */
  /* .tks-topbar-left .tks-loc { display: none; } */
  /* Identity */
  .tks-identity { padding: 12px 0; }
  .tks-emblem img { height: 110px; }
  .tks-college-name .sangam { font-size: 22px; letter-spacing: 2px; }
  .tks-college-name .college { font-size: 17px; }
  .tks-college-name .college .coed { font-size: 15px; }
  .tks-college-name .affil { font-size: 11.5px; }
  .tks-college-name .address { font-size: 12px; }
  .tks-divider-img { max-width: 340px; }
  /* .tks-anniversary-badge img { height: 60px; } */
  /* .tks-badges { display: none; } */
}

/* ── Mobile (≤640px) ────────────────────────────── */
@media (max-width: 640px) {
  /* Topbar */
  .tks-topbar .tks-container { justify-content: center; }
  /* .tks-topbar-right { display: none; } */
  .tks-topbar-left { gap: 10px; font-size: 11.5px; }
  /* Identity — single row: logo | name | badge */
  .tks-identity { padding: 10px 0; }
  .tks-identity .tks-container {
    flex-wrap: nowrap;
    align-items: center;
    gap: 8px;
  }
  /* .tks-emblem img { height: 54px; } */
  .tks-college-name .sangam { font-size: 19px; letter-spacing: 1px; }
  .tks-college-name .college { font-size: 13px; letter-spacing: 0.5px; }
  .tks-college-name .college .coed { font-size: 10px; }
  .tks-divider-img { max-width: 150px; }
  .tks-college-name .affil { font-size: 9px; }
  .tks-college-name .address { font-size: 9.5px; }
  .tks-anniversary-badge { margin-left: 0; }
  .tks-badges { display: none; } 
  .tks-ticker-scroll { font-size: 12px; }
}

/* ── Small mobile (≤400px) ──────────────────────── */
@media (max-width: 400px) {
  .tks-topbar-left .tks-loc { display: none; }
  .tks-emblem img { height: 70px; }
  .tks-college-name .college { font-size: 11px; }
  .tks-college-name .sangam { font-size: 13px;}
  .tks-anniversary-badge img { height: 70px; }
  .tks-college-name .affil { display: none; }
  .tks-divider-img { max-width: 130px; }
}

@media  (max-width:500px) {
  .tks-identity .tks-container {
    padding: 0 3px;
}
}
@media (max-width: 640px) {
    .tks-anniversary-badge img
      {
          height: 77px;
      }
}

@media (max-width: 640px) {
    .tks-emblem img
      {
          height: 73px;
      }

}

@media (max-width: 768px) {
    .tks-topbar-right {
        display: none !important;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
    }

}

</style>

<!-- ══════════════════════════════════════════════
     HEADER MARKUP
══════════════════════════════════════════════ -->
<div class="tks-header">

  <!-- 1. TOP INFO BAR -->
  <div class="tks-topbar">
    <div class="tks-container">
      <div class="tks-topbar-left">
        
        
      </div>
      <div class="tks-topbar-right">
        <a href="alumni.php">Alumni</a>
         <a href="feesdetail.php">Admission & Fee</a>
         <a href="exam.php">Examination</a>
         <a href="nirf.php">NIRF</a>
         <a href="placement.php">Placement</a>
         <a href="gallery.php">Picture Gallery</a>
         <a href="admin-login.php">Admin Portal</a>
         <a href="contact.php">Contact us</a>
         <!-- <li class="translate-mobile"></li> -->
      </div>
    </div>
  </div>

  <!-- 2. IDENTITY / LOGO BAR -->
  <div class="tks-identity">
    <div class="tks-container">

      <!-- College Logo (left) -->
      <a href="index.php" class="tks-emblem" title="TKS College Home">
        <img src="assets/img/logo/logo.png" alt="TKS College Logo">
      </a>

      <!-- College name text block -->
      <div class="tks-college-name">
<span class="sangam">Theni Kammavar Sangam College of Arts and Science <sub>(Co-Ed)</sub></span>        
        <img src="assets/img/logo/arrow.png" alt="Decorative divider" class="tks-divider-img">
        <span class="affil">
          Approved by Govt. of Tamil Nadu &nbsp;|&nbsp; Affiliated to Madurai Kamaraj University &nbsp;|&nbsp;
          <br>Recognized under section 2(f) of the UGC Act, 1956 &nbsp;|&nbsp; ISO 9001:2015 Certified Institution
        </span>
        <span class="address">Koduvilarpatti, Theni - 625 534.</span>
      </div>

      <!-- 50th Anniversary Badge — far right -->
      <a href="index.php" class="tks-anniversary-badge" title="50 Years of Excellence">
        <img src="assets/img/logo/50.png" alt="50th Anniversary Badge">
      </a>

      <!-- Accreditation badges -->
      <div class="tks-badges">
          <!-- Top row: logos/images -->
        <div class="tks-badges-images">
          <img src="assets/img/gallery/ugc.jpg" alt="UGC">
          <img src="assets/img/gallery/nptel.jpg" alt="NPTEL">
          <img src="assets/img/gallery/iic.jpg" alt="IIC">
        </div>
        <!-- Bottom row: pill badges -->
        <div class="tks-badges-pills">
          <span class="tks-badge tks-badge-red"><i class="far fa-check-circle"></i> UGC Recognized</span>
          <span class="tks-badge tks-badge-navy"><i class="far fa-university"></i> Affiliated – MKU</span>
          <span class="tks-badge tks-badge-gold"><i class="far fa-star"></i> 50th Anniversary</span>
        </div>
      </div>


    </div>
  </div>

  <!-- 3. MAIN NAVIGATION -->
  <nav class="tks-nav-wrap" role="navigation" aria-label="Main Navigation">
    <div class="tks-container">

      <!-- Mobile toggle -->
      <button class="tks-mob-toggle" id="tksMobToggle" aria-label="Toggle menu">
        <i class="far fa-bars" id="tksMobIcon"></i>
      </button>

      <!-- Nav list -->
      <ul class="tks-nav-list" id="tksNavList">

        <li><a href="index.php">Home</a></li>

        <li>
          <a href="#">About Us <span class="tks-caret">▼</span></a>
          <ul class="tks-dropdown">
            <li><a href="institution.php">Institution</a></li>
            <li><a href="moa.php">MoA</a></li>
            <li><a href="milestones.php">Milestones</a></li>
            <li><a href="recognition.php">Recognition / Approval</a></li>
            <li><a href="annual-reports.php">Annual Reports</a></li>
            <li><a href="accounts.php">Accounts &amp; Audit Reports</a></li>
          </ul>
        </li>

        <li>
          <a href="#">Administration <span class="tks-caret">▼</span></a>
          <ul class="tks-dropdown">
            <li><a href="board.php">Management Committee</a></li>
            <li><a href="principal.php">Our Principal</a></li>
            <li><a href="vigilance_officer.php">Chief Vigilance Officer</a></li>
            <li><a href="ombudsperson.php">Ombudsperson</a></li>
            <li><a href="icc.php">ICC</a></li>
            <li><a href="Leadership.php">Academic Leadership</a></li>
          </ul>
        </li>

        <li>
          <a href="#">Academics <span class="tks-caret">▼</span></a>
          <ul class="tks-dropdown">
            <li class="tks-submenu-wrap">
              <a href="#">Courses</a>
              <ul class="tks-submenu">
                <li><a href="ug.php">UG Courses</a></li>
                <li><a href="pg.php">PG Courses</a></li>
              </ul>
            </li>
            <li><a href="calender.php">Academic Calendar</a></li>
            <li><a href="faculty.php">Faculty</a></li>
            <li><a href="exam.php">Examination</a></li>
            <li><a href="iqac.php">IQAC</a></li>
            <li><a href="iic.php">IIC</a></li>
            <li><a href="wec.php">WEC</a></li>
            <li><a href="collaborations.php">Academic Collaborations</a></li>
            <li><a href="login.php">Feedback</a></li>
          </ul>
        </li>

        <li>
          <a href="#">Research <span class="tks-caret">▼</span></a>
          <ul class="tks-dropdown">
            <li><a href="research.php">Research Forum</a></li>
            <li><a href="entrepreneurship.php">Entrepreneurship Cell</a></li>
          </ul>
        </li>

        <li>
          <a href="#">Facilities <span class="tks-caret">▼</span></a>
          <ul class="tks-dropdown">
            <li><a href="library.php">Library</a></li>
            <li><a href="hostel.php">Hostel</a></li>
            <li><a href="lab.php">Laboratory</a></li>
            <li><a href="bus-facility.php">Bus Facility</a></li>
          </ul>
        </li>

        <li>
          <a href="#">Student Life <span class="tks-caret">▼</span></a>
          <ul class="tks-dropdown">
            <li class="tks-submenu-wrap">
              <a href="#">Grievance</a>
              <ul class="tks-submenu">
                <li><a href="general.php">General</a></li>
                <li><a href="women.php">Women</a></li>
                <li><a href="sc-st.php">SC / ST</a></li>
                <li><a href="grivance.php">Grievance</a></li>
              </ul>
            </li>
            <li><a href="placement.php">Placement</a></li>
            <li><a href="association.php">Club / Cell / Association</a></li>
            <li><a href="committe.php">Committees</a></li>
            <li><a href="sports.php">Sports</a></li>
            <li><a href="ncc-nss.php">NCC / NSS</a></li>
            <li><a href="yrc.php">YRC</a></li>
            <li><a href="rrc.php">RRC</a></li>
            <li><a href="anti-drug.php">Anti-Drug</a></li>
            <li><a href="anti-ragging.php">Anti-Ragging</a></li>
            <li><a href="sedg.php">SEDG Cell</a></li>
            <li><a href="health-facilities.php">Health Facilities</a></li>
          </ul>
        </li>

        <li>
          <a href="#">Information <span class="tks-caret">▼</span></a>
          <ul class="tks-dropdown">
            <li><a href="job-opening.php">Job Opening</a></li>
            <li><a href="event.php">News, Events &amp; Achievements</a></li>
            <li><a href="news-letter.php">News Letter</a></li>
            <li><a href="annoncements.php">Announcements</a></li>
            <li><a href="circulars.php">Circulars &amp; Notices</a></li>
                                <li><a class="dropdown-item" href="ncfm26.php">NCFM26</a></li>
                                <li><a class="dropdown-item" href="r-tell26.php">R-TELL26</a></li>
                                <li><a class="dropdown-item" href="nctbcerai26.php">NCTBCERAI26</a></li>
                                <li><a class="dropdown-item" href="icctira25.php">ICCTIRA25</a></li>
          </ul>
        </li>

      </ul><!-- /tks-nav-list -->

      <!-- Right: Search + Apply -->
      <div class="tks-nav-right">
        <button class="tks-search-btn" onclick="openSearchModal()" title="Search">
          <i class="fas fa-search"></i>
        </button>
        <a href="application-form.php" class="tks-apply-btn">
          <i class="fal fa-pencil"></i> Apply Now
        </a>
      </div>

    </div>
  </nav>


</div><!-- /tks-header -->

<!-- Mobile nav JS -->
<script>
(function () {
  var btn  = document.getElementById('tksMobToggle');
  var list = document.getElementById('tksNavList');
  var icon = document.getElementById('tksMobIcon');
  if (!btn) return;

  btn.addEventListener('click', function () {
    var open = list.classList.toggle('tks-open');
    icon.className = open ? 'far fa-times' : 'far fa-bars';
  });

  // Mobile: tap parent link to open submenu
  list.querySelectorAll('.tks-nav-list > li > a').forEach(function (a) {
    a.addEventListener('click', function (e) {
      if (window.innerWidth > 768) return;
      var li = this.parentElement;
      if (!li.querySelector('.tks-dropdown')) return;
      e.preventDefault();
      var wasOpen = li.classList.contains('tks-open-m');
      list.querySelectorAll('.tks-open-m').forEach(function (el) {
        el.classList.remove('tks-open-m');
      });
      if (!wasOpen) li.classList.add('tks-open-m');
    });
  });
})();
</script>