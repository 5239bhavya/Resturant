<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Presazine
 */

if( ! function_exists( 'presazine_site_branding' ) ) :
	/**
  	 * Site Branding
  	 *
  	 * @since 1.0.0
  	 */
function presazine_site_branding() { ?>
    <?php $enable_header_background = presazine_get_option('disable_header_background_section');
    $header_background_image = presazine_get_option('header_background_image'); 
     $show_social  = presazine_get_option( 'header_social_link' );
      $show_header_social_links =presazine_get_option('show_header_social_links');
      $show_header_search =presazine_get_option('show_header_search');
      $homelayout     = presazine_get_option( 'homepage_design_layout_options' ); 
      $headerlayout= presazine_get_option('header_layout_options');
      $header_ads_image =presazine_get_option('header_ads_image');
      $header_ads_image_url =presazine_get_option('header_ads_image_url'); ?>
      

     <div class="site-menu" <?php if ($enable_header_background == true ) { ?> style="background-image: url('<?php echo esc_url($header_background_image) ?>');" <?php } ?> >
        <div class="overlay"></div>
        <div class="wrapper">
            <div class="header-logo-ads">
                <div class="site-branding" >
                    <div class="site-logo">
                        <?php if(has_custom_logo()):?>
                            <?php the_custom_logo();?>
                        <?php endif;?>
                    </div><!-- .site-logo -->

                    <div id="site-identity">
                        <h1 class="site-title">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">  <?php bloginfo( 'name' ); ?></a>
                        </h1>

                        <?php 
                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                            <p class="site-description"><?php echo esc_html($description);?></p>
                        <?php endif; ?>
                    </div><!-- #site-identity -->
                </div> <!-- .site-branding -->
                <?php if ( !empty($header_ads_image)){ ?>
                    <div class="header_ads">
                       <a class="_blank" href="<?php echo esc_url($header_ads_image_url); ?>"><img src="<?php echo esc_url($header_ads_image) ?>"></a>
                    </div><!-- .widget_ads -->
                <?php } ?>
            </div>
          <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php echo esc_attr__('Primary Menu', 'presazine'); ?>">
            <div class="header-menu-wrapper">
                <?php if (($homelayout=='home-normal-magazine' || $homelayout=='home-magazine') && ($headerlayout=='header-two'||$headerlayout=='header-three')): ?>
                    <div class="home-icon"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><i
                    class="fa fa-home"></i></a></div>
                <?php endif; ?>
                    <button type="button" class="menu-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'fallback_cb'    => 'presazine_primary_navigation_fallback',
                    ) );
                    ?>
            </div>
          </nav><!-- #site-navigation -->
        </div>
      </div><!-- .site-menu -->
<?php }
endif;
add_action( 'presazine_action_header', 'presazine_site_branding', 10 );

if ( ! function_exists( 'presazine_instagram_section' ) ) :

  /**
   * Top  Footer 
   *
   * @since 1.0.0
   */
  function presazine_instagram_section() {
     $disable_instagram_section = presazine_get_option( 'disable_instagram_section' );
           if( true ==$disable_instagram_section): ?>
              <section id="instagram" class="relative page-section blog-posts">
                  <?php get_template_part( 'inc/sections/section-instagram' ); ?>
              </section>
      <?php endif; 

 }
endif;

add_action( 'presazine_action_instagram', 'presazine_instagram_section', 10 );

if ( ! function_exists( 'presazine_footer_top_section' ) ) :

  /**
   * Top  Footer 
   *
   * @since 1.0.0
   */
  function presazine_footer_top_section() {
      $footer_sidebar_data = presazine_footer_sidebar_class();
      $footer_sidebar    = $footer_sidebar_data['active_sidebar'];
      $footer_class      = $footer_sidebar_data['class'];
      if ( empty( $footer_sidebar ) ) {
        return;
      }      ?>
      <div class="footer-widgets-area page-section <?php echo esc_attr( $footer_class ); ?>"> <!-- widget area starting from here -->
          <div class="wrapper">
            <?php
              for ( $i = 1; $i <= 4 ; $i++ ) {
                if ( is_active_sidebar( 'footer-' . $i ) ) {
                ?>
                  <div class="hentry">
                    <?php dynamic_sidebar( 'footer-' . $i ); ?>
                  </div>
                  <?php
                }
              }
            ?>
            </div>
          
      </div> <!-- widget area starting from here -->
    <?php
 }
endif;

add_action( 'presazine_action_footer', 'presazine_footer_top_section', 10 );

if ( ! function_exists( 'presazine_footer_section' ) ) :

  /**
   * Footer copyright
   *
   * @since 1.0.0
   */

  function presazine_footer_section() { ?>
        <div class="site-info">
            <?php 
                $copyright_footer = presazine_get_option('copyright_text'); 
                $powered_by_footer = presazine_get_option('powered_by_text'); 
                if ( ! empty( $copyright_footer ) ) {
                  $copyright_footer = wp_kses_data( $copyright_footer );
                }
                // Powered by content.
                $powered_by_text = sprintf( __( 'Theme Presazine by %s', 'presazine' ), '<a target="_blank" rel="designer" href="'.esc_url( 'http://sensationaltheme.com/' ).'">'. esc_html__( 'Sensational Theme', 'presazine' ). '</a>' ); 
            ?>
            <div class="wrapper">
                <span class="copy-right"><?php echo esc_html($copyright_footer);?><?php echo $powered_by_text; ?></span>
            </div> 
        </div> <!-- site generator ends here -->
        
    <?php }

endif;
add_action( 'presazine_action_footer', 'presazine_footer_section', 20 );

if ( ! function_exists( 'presazine_footer_sidebar_class' ) ) :
  /**
   * Count the number of footer sidebars to enable dynamic classes for the footer
   *
   * @since Presazine 0.1
   */
  function presazine_footer_sidebar_class() {
    $data = array();
    $active_sidebar = array();
      $count = 0;

      if ( is_active_sidebar( 'footer-1' ) ) {
        $active_sidebar[]   = 'footer-1';
          $count++;
      }

      if ( is_active_sidebar( 'footer-2' ) ){
        $active_sidebar[]   = 'footer-2';
          $count++;
    }

      if ( is_active_sidebar( 'footer-3' ) ){
        $active_sidebar[]   = 'footer-3';
          $count++;
      }

      if ( is_active_sidebar( 'footer-4' ) ){
        $active_sidebar[]   = 'footer-4';
          $count++;
      }

      $class = '';

      switch ( $count ) {
          case '1':
            $class = 'col-1';
            break;
          case '2':
            $class = 'col-2';
            break;
          case '3':
            $class = 'col-3';
            break;
            case '4':
            $class = 'col-4';
            break;
      }

    $data['active_sidebar'] = $active_sidebar;
    $data['class']        = $class;

      return $data;
  }
endif;

if ( ! function_exists( 'presazine_excerpt_length' ) ) :

  /**
   * Implement excerpt length.
   *
   * @since 1.0.0
   *
   * @param int $length The number of words.
   * @return int Excerpt length.
   */
  function presazine_excerpt_length( $length ) {

    if ( is_admin() ) {
      return $length;
    }

    $excerpt_length = presazine_get_option( 'excerpt_length' );

    if ( absint( $excerpt_length ) > 0 ) {
      $length = absint( $excerpt_length );
    }

    return $length;
  }

endif;

add_filter( 'excerpt_length', 'presazine_excerpt_length', 999 );

if( ! function_exists( 'presazine_banner_header
  ' ) ) :
    /**
     * Page Header
    */
    function presazine_banner_header() { 

        if ( is_front_page() && is_home() ){ 
            $header_image = get_header_image();
            $header_image_url = ! empty( $header_image ) ?  $header_image : get_template_directory_uri() . '/assets/images/default-header.jpg';
        }
        elseif( is_front_page() ) {
            return;
        }
        else {
            $header_image_url = presazine_banner_image( $image_url = '' );
        } ?>
        <div id="page-site-header" style="background-image: url('<?php echo esc_url( $header_image_url ); ?>');">
            <div class="overlay"></div>
            <header class='page-header'> 
                <div class="wrapper">
                    <?php presazine_banner_title();?>
                </div><!-- .wrapper -->
            </header>
        </div><!-- #page-site-header -->
        <?php echo '<div class= "page-section">';
    }
endif;
add_action( 'presazine_banner_header', 'presazine_banner_header', 10 );

if( ! function_exists( 'presazine_banner_title' ) ) :
/**
 * Page Header
*/
function presazine_banner_title(){ 
  $latest_posts_title = presazine_get_option( 'latest_posts_title' );
  $single_post_title = presazine_get_option( 'single_post_header_title_enable' ); 
  $single_page_title = presazine_get_option( 'single_page_header_title_enable' );
  $blog_post_title_enable = presazine_get_option( 'blog_post_header_title_enable' );
  $archive_post_title = presazine_get_option( 'archive_post_header_title_enable' );
    if ( (( is_front_page() && is_home() ) || is_home() ) && !empty($latest_posts_title && $blog_post_title_enable==true) ){ ?>
        <h2 class="page-title"><?php echo esc_html($latest_posts_title); ?></h2><?php
    }

    if( is_single() && $single_post_title==true) {
        the_title( '<h2 class="page-title">', '</h2>' );
    }
    if( is_page() && $single_page_title==true) {
        the_title( '<h2 class="page-title">', '</h2>' );
    }       
    if( is_archive() && $archive_post_title==true ){
        the_archive_description( '<div class="archive-description">', '</div>' );
        the_archive_title( '<h2 class="page-title">', '</h2>' );
    }

    if( is_search() ){ ?>
        <h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'presazine' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
    <?php }
    
    if( is_404() ) {
        echo '<h2 class="page-title">' . esc_html__( 'Error 404', 'presazine' ) . '</h2>';
    }
}
endif;

if( ! function_exists( 'presazine_banner_image' ) ) :
/**
 * Banner Header Image
*/
function presazine_banner_image( $image_url ){
    global $post;

    $archive_header = presazine_get_option( 'archive_header_image' );
    $search_header = presazine_get_option( 'search_header_image' );
    $header_404 = presazine_get_option( '404_header_image' );
     $post_header_image_condition = presazine_get_option( 'single_post_header_image_as_header_image_enable' );
    $page_header_image_condition = presazine_get_option( 'single_page_header_image_as_header_image_enable' );

    if ( is_home() && ! is_front_page() ){ 
        $image_url      = get_the_post_thumbnail_url( get_option( 'page_for_posts' ), 'full' );
        $header_image = get_header_image();
        $fallback_image = ! empty( $header_image ) ?  $header_image : get_template_directory_uri() . '/assets/images/default-header.jpg';
        $image_url      = ( ! empty( $image_url) ) ? $image_url : $fallback_image;
    }
    elseif( is_single() ){
        $image_url      = get_the_post_thumbnail_url( $post->ID, 'full' );
        $header_image = get_header_image();
        $fallback_image = ! empty( $header_image ) ?  $header_image : get_template_directory_uri() . '/assets/images/default-header.jpg';
        $image_url      = ( ! empty( $image_url) && $post_header_image_condition==false ) ? $image_url : $fallback_image;
    }
    elseif( is_page() ){
        $image_url      = get_the_post_thumbnail_url( $post->ID, 'full' );
        $header_image = get_header_image();
        $fallback_image = ! empty( $header_image ) ?  $header_image : get_template_directory_uri() . '/assets/images/default-header.jpg';
        $image_url      = ( ! empty( $image_url) && $page_header_image_condition==false ) ? $image_url : $fallback_image;
    }
    elseif( is_archive() ){
        $image_url = ( ! empty( $archive_header) ) ? $archive_header : get_template_directory_uri() . '/assets/images/default-header.jpg';
    }
    elseif( is_search() ){ 
        $image_url = ( ! empty( $search_header) ) ? $search_header : get_template_directory_uri() . '/assets/images/default-header.jpg';
    }
    elseif( is_404() ) {
        $image_url = ( ! empty( $header_404) ) ? $header_404 : get_template_directory_uri() . '/assets/images/default-header.jpg';
    }
    return $image_url;
}
endif;

if ( ! function_exists( 'presazine_posts_tags' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function presazine_posts_tags() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() && has_tag() ) { ?>
                <div class="tags-links">

                    <?php /* translators: used between list items, there is a space after the comma */
                    $tags = get_the_tags();
                    if ( $tags ) {

                        foreach ( $tags as $tag ) {
                            echo '<span><a href="' . esc_url( get_tag_link( $tag->term_id ) ) .'">' . esc_html( $tag->name ) . '</a></span>'; // WPCS: XSS OK.
                        }
                    } ?>
                </div><!-- .tags-links -->
        <?php } 
    }
endif;

/**
 * Render social links.
 *
 * @since 1.0
 */
function presazine_render_social_links() {

        $social_link1 = presazine_get_option( 'social_link_1' );
        $social_link2 = presazine_get_option( 'social_link_2' );
        $social_link3 = presazine_get_option( 'social_link_3' );
        
        if ( empty( $social_link1 ) && empty( $social_link2 ) && empty( $social_link3 ) && empty( $social_link4 ) && empty( $social_link5 ) ) {
                return;
        }

        echo '<div class="social-icons">';
        echo '<ul>';
        if ( ! empty( $social_link1 ) ) {
            echo '<li><a href="' . esc_url( $social_link1 ) . '"></a></li>';
        }
        if ( ! empty( $social_link2 ) ) {
            echo '<li><a href="' . esc_url( $social_link2 ) . '"></a></li>';
        }
        if ( ! empty( $social_link3 ) ) {
            echo '<li><a href="' . esc_url( $social_link3 ) . '"></a></li>';
        }
        echo '</ul>';
        echo '</div>';
}

if ( ! function_exists( 'presazine_pagination' ) ) :
  /**
   * blog/archive pagination.
   *
   * @return pagination type value
   */
  function presazine_pagination() {
    $pagination = presazine_get_option( 'pagination_type' );
    if ( $pagination == 'default' ) :
      the_posts_navigation();
    elseif ( $pagination == 'numeric' ) :
      the_posts_pagination( array(
          'mid_size' => 4,
          // 'prev_text' => ,
          // 'next_text' => ,
      ) );
    endif;
  }
endif;
add_action( 'presazine_pagination_action', 'presazine_pagination', 10 );