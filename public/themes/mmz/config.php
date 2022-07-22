<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists, this
    | is work with "layouts", "partials", "views" and "widgets"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities this is cool
    | feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => array(
        'before' => function ($theme) {
            $theme->setTitle('Title example');
            $theme->setAuthor('Jonh Doe');
        },

        'asset' => function ($asset) {
            $asset->themePath()->add([
                //css
                ['css-main','css/main.css?v=3.3'],

                //js vendor
                ['js-vendor-modernizr-3.6.0-js','js/vendor/modernizr-3.6.0.min.js'],
                ['js-vendor-jquery-3.6.0-js','js/vendor/jquery-3.6.0.min.js'],
                ['js-vendor-jquery-migrate-3.3.0-js','js/vendor/jquery-migrate-3.3.0.min.js'],
                ['js-vendor-bootstrap-bundle-js','js/vendor/bootstrap.bundle.min.js'],

                //js plugins
                ['js-plugins-slick','js/plugins/slick.js'],
                ['js-plugins-jquery-syotimer-js','js/plugins/jquery.syotimer.min.js'],
                ['js-plugins-wow','js/plugins/wow.js'],
                ['js-plugins-jquery-ui','js/plugins/jquery-ui.js'],
                ['js-plugins-perfect-scrollbar','js/plugins/perfect-scrollbar.js'],
                ['js-plugins-magnific-popup','js/plugins/magnific-popup.js'],
                ['js-plugins-select2-js','js/plugins/select2.min.js'],
                ['js-plugins-waypoints','js/plugins/waypoints.js'],
                ['js-plugins-counterup','js/plugins/counterup.js'],
                ['js-plugins-jquery-countdown-js','js/plugins/jquery.countdown.min.js'],
                ['js-plugins-images-loaded','js/plugins/images-loaded.js'],
                ['js-plugins-isotope','js/plugins/isotope.js'],
                ['js-plugins-scrollup','js/plugins/scrollup.js'],
                ['js-plugins-jquery-vticker-min','js/plugins/jquery.vticker-min.js'],
                ['js-plugins-jquery-theia-sticky','js/plugins/jquery.theia.sticky.js'],
                ['js-plugins-jquery-elevatezoom','js/plugins/jquery.elevatezoom.js'],

                ['js-main','js/main.js'],
                ['js-shop','js/shop.js'],

            ]);
        },


        'beforeRenderTheme' => function ($theme) {
        },

        'beforeRenderLayout' => array(

            'mobile' => function ($theme) {
                // $theme->asset()->themePath()->add('ipad', 'css/layouts/ipad.css');
            }

        )

    )

);
