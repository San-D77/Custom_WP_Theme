<!DOCTYPE html>
<html lang="en">

<head>
	
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-MR97Z4Q69S"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-MR97Z4Q69S');
	</script>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1967445389801515"
     crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body a {
            color: #111;
        }
    </style>

    <?php
    wp_head();
    ?>
    <div id="cookie-notice" class="cookie-notice">
        <p>This website uses cookies to improve your experience. <a href="#">Learn more</a></p>
        <button id="cookie-accept">Accept</button>
        <button id="cookie-decline">Decline</button>
    </div>

</head>

<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="toggle-icon">
                    <button class="navbar-toggler btn-menu d-block" id="sidebarBtnOpen" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_429_11066)">
                                    <path d="M3 6.00092H21M3 12.0009H21M3 18.0009H21" stroke="" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_429_11066">
                                        <rect width="24" height="24" fill="none" transform="translate(0 0.000915527)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                    </button>

                </div>
                <?php
                $logo_id = get_theme_mod('custom_logo');
                if ($logo_id) {
                    $logo_url = wp_get_attachment_image_src($logo_id, 'full')[0];
                ?>
                    <a href="/" class="navbar-brand d-lg" style="padding-bottom: 5px">
                        <img src="<?php
                                    echo $logo_url;
                                    ?>" height="50" width="150" alt="">
                    </a>
                <?php } else { ?>
                    <a href="/" class="navbar-site-title d-lg">
                        <?php echo get_bloginfo('name'); ?>
                    </a>

                <?php } ?>




                <?php if (has_nav_menu('primary')) : ?>
                    <div class="collapse navbar-collapse d-none d-lg-block menu-items" id="navbarSupportedContent">

                        <?php
                        wp_nav_menu(
                            array(
                                'menu' => 'primary',
                                'container' => '',
                                'theme_location' => 'primary',
                                'items_wrap' => '<ul id="" class="navbar-nav mx-auto">%3$s</ul>',
                                'walker' => new Walker_Primary_Nav()
                            )
                        );
                        ?>
                    </div>
                <?php endif; ?>


                <div class="sidebar" id="sidebar">
                    <div class="d-flex justify-content-end">
                        <div class="sidebar__btn-close" id="sidebarBtnClose">
                            <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9498 8.46447C17.3404 8.07394 17.3404 7.44078 16.9498 7.05025C16.5593 6.65973 15.9261 6.65973 15.5356 7.05025L12.0001 10.5858L8.46455 7.05025C8.07402 6.65973 7.44086 6.65973 7.05033 7.05025C6.65981 7.44078 6.65981 8.07394 7.05033 8.46447L10.5859 12L7.05033 15.5355C6.65981 15.9261 6.65981 16.5592 7.05033 16.9497C7.44086 17.3403 8.07402 17.3403 8.46455 16.9497L12.0001 13.4142L15.5356 16.9497C15.9261 17.3403 16.5593 17.3403 16.9498 16.9497C17.3404 16.5592 17.3404 15.9261 16.9498 15.5355L13.4143 12L16.9498 8.46447Z" fill="" />
                            </svg>
                        </div>
                    </div>

                    <?php
                    if (has_nav_menu('primary')) :
                        wp_nav_menu(
                            array(
                                'menu' => 'primary',
                                'container' => '',
                                'theme_location' => 'primary',
                                'items_wrap' => '<ul id="" class="pt-3 pt-lg-0 nav-menu menu">%3$s</ul>',
                                'walker' => new Walker_Sidebar_Nav()
                            )
                        );
                    endif;
                    if (has_nav_menu('footer')) :
                        wp_nav_menu(
                            array(
                                'menu' => 'footer',
                                'container' => '',
                                'theme_location' => 'footer',
                                'items_wrap' => '<ul id="" class="sub-menu">%3$s</ul>',
                                'walker' => new Walker_Footer_Nav()
                            )
                        );
                    endif;
                    ?>
                </div>
                <div class="search">
                    <div class="search-icon" id="search-label">
                        <svg height="30px" width="30px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                            <g>
                                <path class="st0" d="M332.998,291.918c52.2-71.895,45.941-173.338-18.834-238.123c-71.736-71.728-188.468-71.728-260.195,0
                                    c-71.746,71.745-71.746,188.458,0,260.204c64.775,64.775,166.218,71.034,238.104,18.844l14.222,14.203l40.916-40.916
                                    L332.998,291.918z M278.488,278.333c-52.144,52.134-136.699,52.144-188.852,0c-52.152-52.153-52.152-136.717,0-188.861
                                    c52.154-52.144,136.708-52.144,188.852,0C330.64,141.616,330.64,226.18,278.488,278.333z" />
                                <path class="st0" d="M109.303,119.216c-27.078,34.788-29.324,82.646-6.756,119.614c2.142,3.489,6.709,4.603,10.208,2.46
                                    c3.49-2.142,4.594-6.709,2.462-10.198v0.008c-19.387-31.7-17.45-72.962,5.782-102.771c2.526-3.228,1.946-7.898-1.292-10.405
                                    C116.48,115.399,111.811,115.979,109.303,119.216z" />
                                <path class="st0" d="M501.499,438.591L363.341,315.178l-47.98,47.98l123.403,138.168c12.548,16.234,35.144,13.848,55.447-6.456
                                    C514.505,474.576,517.743,451.138,501.499,438.591z" />
                            </g>
                        </svg>
                    </div>
                    <div id="search-container">
                        <form action="/" method="get">
                            <input type="text" name="s" id="" class="form-control search-box">
                            <span class="close-search">X</span>
                        </form>
                    </div>
                </div>
            </div>
        </nav>


    </header>