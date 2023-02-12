![PHP](https://img.shields.io/badge/PHP-8.2.1-green)
![WordPress](https://img.shields.io/badge/WordPress-6.1.1-green)

![CarbonFields](https://img.shields.io/badge/Carbon%20Fields-3.4.0-green)
![loadCSS](https://img.shields.io/badge/loadCSS-2.0.1-green)
![dynamicAdapt](https://img.shields.io/badge/dynamicAdapt-2022-green)

## Created with "Carbon fields" and custom features
### Dynamic-adaptive style for PC, tablet & mobile


> Description theme

## Features:
### equd_content
> (require "Carbon fields")[^equd_content]
### dynamic_adaptive
> (https://github.com/FreelancerLifeStyle/dynamic_adapt) with menu walker
### dynamic_style
> (CSS reset, root variables, calculate)
### async_style_script
> (with loadCSS)
### post_link
> (edit post link for custom "post types")

[^equd_content]: dsdsdsads.

- - - 

## Entities:

- Post types:
  - Page;
    - Desc page type;
  - Post;
    - Desc post type;

- Taxonomies:
  - Category
    - desc category
  - Tag

### Template
```html
<head>
<!-- wp_head() -->
</head>
<body>
  <!-- wp_body_open() -->
  <header id="head-top" class="site-header">
    <div class="site-header__line flex-row">
    <div class="site-header__line"></div>
    <div class="site-header__line reserve flex-row"></div>
  </header>
  <main id="primary" class="site-main flex-column">
    <!-- header.entry-header -->
    <main class="entry-main">
      <div class="wrapper container flex-row">
        <!-- aside.sidebar -->
        <!-- article.$post_type || div.wrapper_grid -->
      </div>
    </main>
    <!-- header.entry-footer -->
  </main>
  <footer id="colophon" class="site-footer">
    <div class="site-footer__line"></div>
    <div class="site-footer__line flex-row"></div>
    <div class="site-footer__line"></div>
  </footer>
  <!-- wp_footer() -->
  <!-- wp_body_close() -->
</body>
```

```php
//theme hooks
wp_body_open();
wp_body_close();
/**
* @method async_style_script
*/
wp_enqueue_style_special();
wp_enqueue_script_special();
```

