<?php
/**
 * woocomerce Compatibility File
 *
 * @link https://woocomerce.com/
 *
 * @package flexstarter
 */

/**
 * woocomerce setup function.
 *
 * @link https://docs.woocomerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocomerce/woocomerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function flexstarter_woocomerce_setup() {
	add_theme_support( 'woocomerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'flexstarter_woocomerce_setup' );

/**
 * Disable the default woocomerce stylesheet.
 *
 * Removing the default woocomerce stylesheet and enqueing your own will
 * protect you during woocomerce core updates.
 *
 * @link https://docs.woocomerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocomerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocomerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocomerce-active' class.
 */
function flexstarter_woocomerce_active_body_class( $classes ) {
	$classes[] = 'woocomerce-active';

	return $classes;
}
add_filter( 'body_class', 'flexstarter_woocomerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function flexstarter_woocomerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'flexstarter_woocomerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function flexstarter_woocomerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocomerce_product_thumbnails_columns', 'flexstarter_woocomerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function flexstarter_woocomerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'flexstarter_woocomerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function flexstarter_woocomerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocomerce_output_related_products_args', 'flexstarter_woocomerce_related_products_args' );

if ( ! function_exists( 'flexstarter_woocomerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function flexstarter_woocomerce_product_columns_wrapper() {
		$columns = flexstarter_woocomerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocomerce_before_shop_loop', 'flexstarter_woocomerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'flexstarter_woocomerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function flexstarter_woocomerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocomerce_after_shop_loop', 'flexstarter_woocomerce_product_columns_wrapper_close', 40 );

/**
 * Remove default woocomerce wrapper.
 */
remove_action( 'woocomerce_before_main_content', 'woocomerce_output_content_wrapper', 10 );
remove_action( 'woocomerce_after_main_content', 'woocomerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'flexstarter_woocomerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all woocomerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function flexstarter_woocomerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocomerce_before_main_content', 'flexstarter_woocomerce_wrapper_before' );

if ( ! function_exists( 'flexstarter_woocomerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function flexstarter_woocomerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocomerce_after_main_content', 'flexstarter_woocomerce_wrapper_after' );

/**
 * Sample implementation of the woocomerce Mini Cart.
 *
 * You can add the woocomerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'flexstarter_woocomerce_header_cart' ) ) {
			flexstarter_woocomerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'flexstarter_woocomerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function flexstarter_woocomerce_cart_link_fragment( $fragments ) {
		ob_start();
		flexstarter_woocomerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocomerce_add_to_cart_fragments', 'flexstarter_woocomerce_cart_link_fragment' );

if ( ! function_exists( 'flexstarter_woocomerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function flexstarter_woocomerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'flexstarter' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'flexstarter' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'flexstarter_woocomerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function flexstarter_woocomerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php flexstarter_woocomerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}
