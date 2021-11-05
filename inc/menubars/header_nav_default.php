<div class="frow-container">
    <div class="frow">
        <div class="col-md-1-1 main-header">
            <?php if ( has_custom_logo() ): 
                $flexstarter_custom_logo_id = get_theme_mod( 'custom_logo' );
                $flexstarter_logourl = wp_get_attachment_image_src( $flexstarter_custom_logo_id , 'flexstarter-logo' ); 
            ?>
                <div class="logo" itemscope="itemscope" itemtype="https://schema.org/Organization">
                    <a class="logo" href="<?php echo esc_url( home_url( '/' )); ?>" rel="home" itemprop="url">
                        <img src="<?php echo esc_url($flexstarter_logourl[0]); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    </a>
                </div>
            <?php else : ?>
                <div class="logo" itemscope="itemscope" itemtype="https://schema.org/Organization">
                    <a class="logo" href="<?php echo esc_url( home_url( '/' )); ?>" rel="home"  itemprop="url"><h2 itemprop="name"><?php esc_url(bloginfo('name')); ?></h2><p><?php esc_url(bloginfo('description')); ?></p></a>
                </div>
            <?php endif; ?>
            <nav id="navigation" class="navbar frow justify-between centered" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement" aria-label="Site Navigation">
                <button id="nav-toggle" class="nav-toggle nav-btn"><i class="fa-solid fa-bars-staggered"></i></button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'primary_menu',
                        'container'       => 'ul',
                        'container_id'    => 'navbar-menu', //changes
                        'container_class' => 'collapse navbar-collapse', //changes
                        'menu_id'         => false,
                        'menu_class'      => 'navbar-menu hidden menu-items '.get_theme_mod('main_menu_setting').'', //changes
                        'depth'           => 2
                    ));
                ?>
            </nav>
        </div>
    </div> <!-- frow -->
</div> <!-- container -->
