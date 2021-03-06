<?php
/* ------------------------------------------------------------------------- *
 *  Partial Template Hooks
 *  ________________
 *
 *	If you want to add/edit functions please use a child theme
 *	http://codex.wordpress.org/Child_Themes
 *	________________
 *
/* ------------------------------------------------------------------------- */



/* ------------------------------------------------------------------------- *
 *  Header
/* ------------------------------------------------------------------------- */

/* -- Header Before */
add_action( 'tradeup_header__before', 'tradeup_header_placeholder', 0 ); // Add a placeholder for the menu, when fixed.

/* -- Header After */
add_action( 'tradeup_header__after', 'tradeup_search_display', 0 ); // Search overlay - when header search button is clicked

/* -- Header Main Wrapper */
add_action( 'tradeup_main__header', 'tradeup_logo_display', 10, 1 ); // Add logo, text or image.
add_action( 'tradeup_main__header', 'tradeup_menu_main_area', 20 ); // Displays the main menu.
add_action( 'tradeup_main__header', 'tradeup_menu_actions_area', 30 ); // Wrapper for the right side menu

/* -- Header / Action Buttons style 1 */
add_action( 'tradeup_header__action_btns_1', 'tradeup_menu_action_btns', 11 ); // Action buttons menu - right side

/* -- Header / Action Buttons style 2 */
add_action( 'tradeup_header__action_btns_2', 'tradeup_search_button', 10 ); // Action buttons - search
add_action( 'tradeup_header__action_btns_2', 'tradeup_mobile_menu_button', 20 ); // Action buttons - mobile menu
add_action( 'tradeup_header__action_btns_2', 'tradeup_mobile_actions_menu_button', 30 ); // Action buttons - mobile actions menu



/* ------------------------------------------------------------------------- *
 *  Footer
/* ------------------------------------------------------------------------- */

/* -- Footer Wrapper */
add_action( 'tradeup_main__footer', 'tradeup_footer_widgets_wrapper', 10 ); // Displays footer sidebars columns wrapper
add_action( 'tradeup_main__footer', 'tradeup_footer_creds_wrapper', 20 ); // Displays footer credits wrapper

/* -- Footer Sidebars */
add_action( 'tradeup_footer__sidebars', 'tradeup_footer_sidebar_1', 10 ); // Footer sidebar #1
add_action( 'tradeup_footer__sidebars', 'tradeup_footer_sidebar_2', 20 ); // Footer sidebar #2
add_action( 'tradeup_footer__sidebars', 'tradeup_footer_sidebar_3', 30 ); // Footer sidebar #3

/* -- Footer Credits */
add_action( 'tradeup_footer__creds', 'tradeup_logo_display', 10, 1 ); // Add logo, text or image
add_action( 'tradeup_footer__creds', 'tradeup_footer_creds_menu', 20 ); // Displays a menu in the footer
add_action( 'tradeup_footer__creds', 'tradeup_footer_creds_copyright', 30 ); // Displays theme developer & website owner credits



/* ------------------------------------------------------------------------- *
 *  Posts & Pages
/* ------------------------------------------------------------------------- */

/* -- Single/Page pagination */
add_action( 'tradeup_page_article_after', 'tradeup_post_page_pagination', 11 );  // If page has multiple pages, add pagination

/* -- Single - After content */
add_action( 'tradeup_single_content_after', 'tradeup_post_page_pagination', 5 ); // If post has multiple pages, add pagination
add_action( 'tradeup_single_content_after', 'tradeup_single_tags_display', 10 ); // Displays a list of tags for this post

/* -- Index - Post meta footer */
add_action( 'tradeup_post_index__footer_meta', 'tradeup_index_post_meta_footer', 10 ); // Index post - footer meta wrapper
add_action( 'tradeup_index__post_meta', 'tradeup_post_meta', 10 ); // Index post - footer meta info



/* ------------------------------------------------------------------------- *
 *  Portfolio
/* ------------------------------------------------------------------------- */

if( tradeup_jetpack_check( 'custom-content-types' ) ) : // Check if Jetpack is active

/* -- Project after content */
add_action( 'tradeup_portfolio_content_after', 'tradeup_portfolio_tags_display', 0 ); // Displays a list of tags for this project

/* -- Projects loop inner top */
add_action( 'tradeup_portfolio_page__inner_items_wrap_top', 'tradeup_portfolio_page_masonry_sizers' ); // Output masonry sizers

/* -- Projects container inner bottom */
add_action( 'wp_enqueue_scripts', 'tradeup_portfolio_page_masonry_script' ); // Output masonry script

endif; // Jetpack check



/* ------------------------------------------------------------------------- *
 *  WooCommerce
/* ------------------------------------------------------------------------- */

if( tradeup_wco_is_activated() ) {

/* -- Shopping cart buttons */
add_action( 'tradeup_header__action_btns_2', 'tradeup_wco_cart_link', 15 );

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
add_filter( 'woocommerce_add_to_cart_fragments', 'tradeup_wco_cart_link_fragment' ); } else {
add_filter( 'add_to_cart_fragments', 'tradeup_wco_cart_link_fragment' ); }

/* -- Breadcrumbs */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'tradeup_woocom_hfw__heading_bottom', 'woocommerce_breadcrumb', 20 );
add_action( 'tradeup_woocom_shfw__heading_bottom', 'woocommerce_breadcrumb', 20 );

/* -- Before shop loop */
add_action( 'woocommerce_before_shop_loop', 'tradeup_wco_before_shop_loop_start', 1 );
add_action( 'woocommerce_before_shop_loop', 'tradeup_wco_before_shop_loop_end', 999 );

/* -- Products list */
add_filter( 'loop_shop_columns', 'tradeup_wco_loop_columns' ); // Number of products per row

/* -- Related products */
add_filter( 'woocommerce_output_related_products_args', 'tradeup_wco_related_loop_columns' );
add_filter( 'woocommerce_output_up_sells_products_args', 'tradeup_wco_related_loop_columns' );

/* -- Product page */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

} // WooCommerce Activated/Exists
