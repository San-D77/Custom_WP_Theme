<!-- Footer -->
<div class="move-to-top d-none">
    <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g id="Arrow / Caret_Down_MD">
            <path id="Vector" d="M16 10L12 14L8 10" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </g>
    </svg>
</div>
<!-- Modal Structure -->
<div id="galleryModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-button">×</span>
        <div id="galleryCarousel" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <!-- Gallery images will be dynamically inserted here -->
                </ul>
            </div>
        </div>
    </div>
</div>

<footer class="footer-section">
    <div class="container">
        <div class="website">

        </div>

        <div class="footer-menu">
            <?php
            wp_nav_menu(
                array(
                    'menu' => 'footer',
                    'container' => '',
                    'theme_location' => 'footer',
                    'items_wrap' => '<ul id="" class="sub-menu">%3$s</ul>',
                    'walker' => new Walker_Footer_Nav()
                )
            );
            ?>
        </div>
        <div class="copyright col-md-12">
            <p>&copy; Copyright <?php echo date('Y'); ?>&nbsp;&nbsp;<a href="/"><?php bloginfo('name'); ?></a>. All Rights Reserved</p>
        </div>
    </div>
</footer>
</body>

</html>