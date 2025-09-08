<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package acf_blocks
 */

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<?php 
 wp_footer();
?>
<footer>
	<a href="#top" class="scroll-to-top-btn">
    <svg width="28" height="16" viewBox="0 0 28 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M14.0001 0.0196812C14.5019 0.0196812 15.0036 0.211286 15.3862 0.59369L27.4256 12.6332C28.1915 13.399 28.1915 14.6408 27.4256 15.4063C26.6601 16.1719 25.4186 16.1719 24.6527 15.4063L14.0001 4.7531L3.34742 15.4059C2.58156 16.1715 1.34022 16.1715 0.574734 15.4059C-0.191499 14.6404 -0.191499 13.3987 0.574734 12.6328L12.6139 0.593317C12.9967 0.210851 13.4984 0.0196811 14.0001 0.0196812Z" fill="white"/>
    </svg>
</a>
    <div class="footer-top">
        <div class="container row between">
            <div class="footer-logo-block footer__col_1">
                <?php 
                $dark_logo = get_field('black_logo');
                
                if($dark_logo) {
                    // Темный режим - используем светлый логотип
                    ?>
                    <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/new-logo-light.png" class="footer-logo">
                    <?php
                } else {
                    // Светлый режим - используем темный логотип
                    ?>
                    <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/new-logo-dark.png" class="footer-logo">
                    <?php
                }
                ?>
            </div>
            <div class="footer-nav-block footer__col_2 row space-between">
             <div class="footer-nav__col-1">    
             <?php
                wp_nav_menu(array(
                'theme_location' => 'menu-3',
                'container' => 'nav',
                'container_id' => '',
                'container_class' => '',
                'menu_class' => 'footer-main-nav column',
                    'depth' => 2,
                    ));
             ?>
             </div>
              <div class="footer-nav__col-2">    
              <?php
                wp_nav_menu(array(
                'theme_location' => 'menu-4',
                'container' => 'nav',
                'container_id' => '',
                'container_class' => '',
                'menu_class' => 'footer-main-nav column',
                    'depth' => 2,
                    ));
             ?>
             </div>   
            </div>        
            <div class="footer__col_3">
                <?php
                
                $socials = get_field('footer-icons', 'option');
                $socials_dark = get_field('footer-icons_dark', 'option');
                $dark_logo = get_field('black_logo');

                if ( $socials_dark || $socials ) { ?>
                <div>
                    <p class="footer-social-title">Follow us:</p>

                    <div class="footer-social-block row">
                    <?php if ( $dark_logo ) { 
              
                    if($socials_dark){
                        foreach($socials_dark as $social){
                        $social_img = $social['icon'];
                        $social_link = $social['link']; ?>
                        <a href="<?php if($social_link){  echo $social_link; }?>"> <img alt="icon" src="<?php if($social_img){ echo $social_img; }?>"></a>
                        <?php
                        }
                    }
                } else {
                    if($socials){
                        foreach($socials as $social){
                        $social_img = $social['icon'];
                        $social_link = $social['link']; ?>
                        <a href="<?php if($social_link){  echo $social_link; }?>"> <img alt="icon" src="<?php if($social_img){ echo $social_img; }?>"></a>
                        <?php
                        }
                    }
                }

                ?>
                    </div>

                    </div>
                <?php } ?>

                <div class="footer-image-block">
                    <?php if(get_field('image_under_social','option')){ ?>
                        <img alt="image"  src="<?php echo get_field('image_under_social','option');?>">
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-text-block">
                <?php if( get_field('footer-text', 'option') ){ echo get_field('footer-text', 'option'); } ?>
            </div>
        </div>
    </div>
</footer>
</body>
</html>