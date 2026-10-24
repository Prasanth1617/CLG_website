UI polish patch (same colours and logo)
=======================================
Copy everything in this folder into your project folder, replacing files when asked
(the php files go in the project root; polish.css goes in assets/css).

What changed:
- Every public page: its own page title and description (was the same title on all pages),
  link-preview tags (Open Graph), a skip-to-content link, lazy-loading for images below
  the first screen, alt="" on 5 images that had none.
- New assets/css/polish.css: keyboard focus outlines, skip link, wide tables scroll on
  phones, long text wraps instead of widening the page, reduced-motion support.
- No admin files are included, so admin/db.php is untouched.

Check after copying:
1. Run the site and open a few pages: titles in the browser tabs should differ.
2. Press Tab once on any page: a "Skip to main content" link should appear.
3. Open a page at phone width: the look should be unchanged, except wide tables
   scroll sideways instead of breaking the layout.
