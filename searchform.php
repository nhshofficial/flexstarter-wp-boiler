<form role="search" class="wp-block-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="search-input">
        <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'flexstarter' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php esc_attr_x( 'Search for:', 'label', 'flexstarter' ); ?>">
    </div>
    <button type="submit" class="wp-block-search__button mt-10"><?php esc_html_e( 'Search', 'flexstarter' ) ?></button>
</form>