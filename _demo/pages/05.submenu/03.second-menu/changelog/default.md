---
title: Changelog
date: '19:39 20-05-2023'
show_pageimage: true
image_width: 1000
image_height: 300
visible: true
---

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