# v2.3.7
## 07/30/2025

1. [](#improved)
   * Added support for videos in the gallery template

# v2.3.6
## 07/25/2025

1. [](#improved)
   * Remove trailing slashes from void HTML tags
   * Refactoring the posts layout from Flexbox to CSS Grid for better readability and maintainability
   * Refactoring some SCSS styles for better structure and readability
   * Fixed mandatory `href` attribute on `a` tags on non-routable pages
   * Fixed HTML markup errors reported by the W3C validator (Thanks to [@Fazarel](https://github.com/Fazarel))
2. [](#bugfix)
   * Fixed sidebar lock position when content height changes dynamically [Issue #48](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/48)

# v2.3.5
## 05/18/2025

1. [](#improved)
   * Added addressDetails to demo contact page
2. [](#bugfix)
   * **Fixed:** Recent Posts template now correctly respects the user-defined post limit in modular pages.

# v2.3.4
## 03/13/2025

1. [](#improved)
   * Upgraded Glightbox library to version 3.3.0
   * Added theme version dynamically in HTML comment using Twig
   * Moved sidebar partials templates into a dedicated `partials/sidebar` folder for better organization
   * Replaced `logo.png` with `favicon.png` in the head section
  
# v2.3.3
## 02/03/2025

1. [](#improved)
   * Updated menu heading text in sidebar
   * Adapted to latest version of [Taxonomylist plugin](https://github.com/getgrav/grav-plugin-taxonomylist/)
   * Updated README
   * Updated styles for Dropdown menu
2. [](#bugfix)
   * Fixed favicon type in link rel html attribute

# v2.3.2
## 11/18/2024

1. [](#improved)
   * Improved styles for dropdown menu (no empty space between menu link and arrow icon).
   * Changed position of page index in default template. Now it is displayed at the top.
   * Included the Form plugin as a dependency in blueprints.

# v2.3.1
## 11/06/2024

1. [](#improved)
   * Improved styles for related pages in sidebar
   * Fixed the condition for displaying related pages in the sidebar
   * Using the new `decoding` filter in all templates that load images

# v2.3.0
## 10/27/2024

1. [](#new)
   * New option to show sidebar on the right (thanks [@elAlberino](https://github.com/ElAberino))
   * New option to display a page index at the beginning of a page with children
   * New option (`addressDetails`) to add extra information to the contact template
2. [](#improved)
   * Remove extra paragraph in breadcrumbs in item template (thanks [@elAlberino](https://github.com/ElAberino))
   * Fixed Box shortcode to remove extra paragraphs
   * Set all options in the sidebar section, contact section and social media icons to `false` in default settings
   * Updated README
   * Update translations

# v2.2.3
## 08/13/2024

1. [](#new)
   * Added the `target` tag to social media icons
2. [](#improved)
    * Added `rel=nofollow` attribute to improve SEO
3. [](#bugfix)
   * Fixed HTML encoding in gallery image description in lightbox (thanks [@artecnico](https://github.com/artecnico))
     
# v2.2.2
## 08/08/2024

1. [](#bugfix)
   * Fixed invalid value in `itemtype` field in gallery template
     
# v2.2.1
## 08/05/2024

1. [](#new)
   * Added styles to center text of notices vertically (thanks [@elAlberino](https://github.com/ElAberino))
2. [](#improved)
   * Option in `ImageFloatShortcode` shortcode to add additional css classes
   * Update contact demo page to include `id` and `autocomplete` attributes
3. [](#bugfix)
   * Fixed `raw` filter on some items in the contact section
   
# v2.2.0
## 07/14/2024

1. [](#new)
   * Removed the `custom.js` and `custom.css` files from the theme, to avoid overwriting user customizations with the release of new versions. These files are now loaded, if they exist in the theme's `assets/css` or `assets/js` folder, using the `onTwigSiteVariables` function within `editorial.php` and can be enabled from the theme settings.
2. [](#improved)
   * Fixed the escaping of an html string in the metadata description
   * Integrated "Back to Top" button code in main.js
   * Updated demo content
   
# v2.1.0
## 06/17/2024

1. [](#improved)
   * Changed the navigation menu to allow dropdown links to open, set to `routable` in settings. The behavior of the arrow to open submenus has been separated from the menu link.

# v2.0.7
## 05/09/2024

1. [](#improved)
   * Removed `@import` declaration for Fontawesome fonts, duplicated in CSS styles.
   * Updated `taxonomylist` partial template to latest changes of [taxonomylist plugin](https://github.com/getgrav/grav-plugin-taxonomylist/releases/tag/1.3.6)
   * Render markdown in `data.html.twig` template
   * Updated styles for `box` class
   * Updated demo content
  
# v2.0.6
## 01/30/2024

1. [](#improved)
   * Simplified Flex-Row shortcode code. New twig template to process the shortcode
   * Image hidden in search results on small devices
   * Added raw filter in Contact template
   * Added `safe_email` filter to contact
   * Updated demo site address
   
# v2.0.5
## 11/25/2023

1. [](#bugfix)
   * Fixed route of Popular tags in sidebar (issue [#37](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/37))
2. [](#new)
   * New options to enable/disable plugin sections in the sidebar
   
# v2.0.4
## 10/28/2023

1. [](#bugfix)
   * Fixed raw filter on copyright text 

# v2.0.3
## 10/28/2023

1. [](#bugfix)
   * Fixed sort filter error when taxonomy is empty
2. [](#improved)
   * Improved code in recent posts, blog-list and blog templates
   * Increased font size in styles
   * Moved the copyright text field to the sidebar section in the admin
3. [](#new)
   * Added support for comments plugin

# v2.0.2
## 09/13/2023

1. [](#bugfix)
   * Fixed code for datestamp on blog pages

# v2.0.1
## 09/12/2023

1. [](#bugfix)
   * Fixed CHANGELOG format
# v2.0.0
## 09/12/2023

1. [](#new)
   * New Downloads template (issue [#32](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/35))
   * New macro for navigation
   * New design for related pages template.
   * Added custom.css to assets links (issue [#35](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/35))
   * Added custom.js to assets links
   * Added Back to top button
   * Added support for navigation on modular one-page pages. 
2. [](#improved)
   * Code restructure in all twig templates
   * Option to hide or show page title (issue [#26](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/35))
   * Improved CSS styles for login and forgot forms
   * Removed the extra text from the checkbox label, from the privacy.html.twig template (Note: use the `markdown` attribute on the form field to be able to use html tags within the privacy field) (issue [#31](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/35))
   * Updated translations and added French translations (thanks [@Fazarel](https://github.com/Fazarel))
   * H1 tag optimized for SEO purposes.
3. [](#bugfix)
   * Fixed raw filter in featured posts
   * Fixed date traslations in recent-posts and blog templates (issue [#34](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/35))
# v1.0.10.1
## 07/05/2023

1. [](#bugfix)
   * Fixed use of `default` filter by `defined` in sidebar template (issue [#21](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/21))
# v1.0.10
## 07/02/2023

1. [](#new)
   * Added option to enable or disable contact section
   * New shortcodes for buttons, flex rows and columns, tables, boxes and images.
   * Added option to load Google fonts from local folder.
   * New colors for buttons and boxes (as in Bootstrap)
2. [](#improved)
   * Improved CSS styles
   * Improved traslations
   * Updated demo content
3. [](#bugfix)
   * Fixed date in modular template recent-posts (issue [#18](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/18))
   * Fixed visibility unplished posts in modular template recent-posts (issue [#20](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/20))
# v1.0.9
## 06/05/2023

1. [](#new)
   * New effects in Gallery template
   * New Team twig template
   * Option to enable or disable open sidebar on startup
   * Social sharing icons added to blog items
2. [](#improved)
   * Improved css styles
   * Improved traslations
   * `responsive` css class to make tables responsive
# v1.0.8
## 05/20/2023

1. [](#improved)
   * Modified some styles to improve web accessibility.
2. [](#bugfix)
   * Fixed dropdown menu (issue [#16](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/16))
# v1.0.7
## 03/29/2023

1. [](#new)
   * Added support por `translate-date` and `twig-extensions` plugins.
   * New non-modular contact template
   * New options for featured image
2. [](#improved)
   * Improved simplesearch results with `striptags` filter.
   * Updated translations
   * Updated css styles
  
# v1.0.6
## 03/10/2023

1. [](#new)
   * Added sections for Langswitcher and Login in sidebar
   * Added login, forgot, reset and profile templates
   * Added offline template
   * Added taxonomylist template
   * Added relatedpages template
   * Added metadata template
   * Added Form template
   * Added breacrumbs support to the blog
2. [](#improved)
   * Improved styles for breadcrumbs
   * Updated translations
   * Updated css styles
3. [](#bugfix)
   * Fixed blog routes in item and blog templates

# v1.0.5
## 02/17/2023

1. [](#new)
   * Added Gallery template
   * Added demo content (issue [#10](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/10))
2. [](#improved)
   * Improved styles for breadcrumbs
   * Improved translations in blueprints
3. [](#bugfix)
   * Fixed error when displaying content with various plugins (lightbox-gallery, highlight, etc)(issues [#11](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/11) and [#12](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/12))

# v1.0.4
## 01/23/2023

1. [](#improved)
   * Rebuilded languages.yaml file and blueprints.
   * Added header subtitle on various twig templates.
   * Added option to choose the `Read more` text on item buttons.
   * Taxonomy Author added in item footer.
2. [](#bugfix)
   * Fixed `raw` Twig filter in modular.html.twig (issue [#4](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/4))
   * Fixed `page.header` in media for featured image in blog-list-item.html.twig (issue [#5](https://github.com/pmoreno-rodriguez/grav-theme-editorial/issues/5)).
   * Fixed bug when showing the mobile logo if there is no other image loaded.
   * Fixed show tags in item footer,
# v1.0.3
## 01/15/2023

1. [](#new)
   * Added modular Banner template
   * Added modular Recent Posts template
   * Added modular Contact template
   * Added modular Features template
   * Added Forms templates
   * Added blueprints for default, blog, item, and modulars templates.
   * Added partials templates: blog-list-item, logo, metadata and simplesearch_searchbox
   * Added Item template
   * Added Modular template
   * Added Error template
   * Added Simplesearch Results template
   * Added functionality to searchbox in sidebar
   * Added Production mode for CSS styles.
   * Added Custom logo and Custom logo mobile in theme config.
2. [](#improved)
   * Improved the languages.yaml file and added the Spanish language
   * Improved all blueprints to support language translation
   * Improved the featured posts template in the sidebar, to use a taxonomy chosen by the user and not the default `featured`. A limit of posts that will appear is also established.
3. [](#bugfix)
   * Rolling back assets to original HTML5Up version, to fix Fontawesome fonts.
# v1.0.2
## 11/13/2022

1. [](#new)
   * Added `rel="me"` to mastadon social links.
# v1.0.1
## 11/13/2022

1. [](#bugfix)
   * Fixed Featured Posts h3 link
# v1.0.0
## 03/06/2022

1. [](#new)
   * Complete overhaul of the theme. Now uses gulp-sass for pre-processing
   * Mini search form and blog items now function properly.
2. [](#improved)
   * Improved theme licensing description.  CC3 for the actual theme itself, and MIT for the GravCMS portion.
   * Updated Fontawesome to v6.
   * Added languages.yaml
# v0.1.3
## 02/14/2018

1. [](#new)
   * Default state of sidebar is now configurable.
2. [](#bugfix)
   * Child pages in navigation now render properly.
# v0.1.2
## 02/14/2018

1. [](#new)
   * Added Simplesearch dependency.
   * Search functionality works now.
2. [](#improved)
   * Styling on images (thanks to andreakal).
# v0.1.1
## 02/05/2018

1. [](#new)
   * Added thumbnail and screenshot images to theme.
# v0.1.0
## 01/05/2018

1. [](#new)
   * ChangeLog started...
