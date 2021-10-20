<div class="frow-container">
    <div class="frow">
        <!-- logo -->
        <div class="col-md-1-3 col-sm-1-2 col-xs-1-2">
            <?php if ( has_custom_logo() ): 
                $flexstarter_custom_logo_id = get_theme_mod( 'custom_logo' );
                $flexstarter_logourl = wp_get_attachment_image_src( $flexstarter_custom_logo_id , 'flexstarter-logo' ); 
            ?>
                <a class="logo" href="<?php echo esc_url( home_url( '/' )); ?>" rel="home" itemprop="url">
                    <img src="<?php echo esc_url($flexstarter_logourl[0]); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                </a>
            <?php else : ?>
                <a class="logo" href="<?php echo esc_url( home_url( '/' )); ?>"><h2><?php esc_url(bloginfo('name')); ?></h2><p><?php esc_url(bloginfo('description')); ?></p></a>
            <?php endif; ?>
        </div>
        <!-- menu -->
        <div class="col-md-2-3 col-sm-1-2 col-xs-1-2">
            <div class="frow justify-end centered">
                <button id="nav-toggle" class="nav-toggle">Menu</button>
                <nav class="nav-collapse" id="nav">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <?php
                        wp_nav_menu(array(
                        'theme_location'  => 'primary_menu',
                        'container'       => 'ul',
                        'container_id'    => 'navbar-menu', //changes
                        'container_class' => 'collapse navbar-collapse', //changes
                        'menu_id'         => false,
                        'menu_class'      => 'menu-items '.get_theme_mod('main_menu_setting').'', //changes
                        'depth'           => 3
                    ));
                    ?>
                </nav>
                <?php if ( get_theme_mod( 'right_search_setting' ) === 'yes' ) : ?>
                <div class="search-header">
                    <button class="search__toggle" aria-label="Open search"><i class="fas fa-search"></i></button>
                    <form class="search__form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'flexstarter' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php esc_attr_x( 'Search for:', 'label', 'flexstarter' ); ?>">
                    </form>
                </div>
                <?php endif; ?>
            </div> <!-- frow -->
        </div> <!-- column -->
    </div> <!-- frow -->
</div> <!-- container -->
