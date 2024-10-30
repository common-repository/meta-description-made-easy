<?php
/*
 * Plugin Name: Meta Description Made Easy
 * Description: Want to Add Meta Description to the header of your WORDPRESS website, Posts and pages? Meta Description Made Easy plugin (MEDME) helps you to easily to that.
 * Version: 1.1
 * Author: Dooman Soltani
 * Author URI: http://doomansoltani.com/medme/
 * License: GNU General Public License v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: Meta-Description-Made-Easy
 
 */
 
 /*


you can freely modify and enhance the plugin under the terms of the GNU General Public License as published by
the Free Software Foundation;

hope that it will be useful and helpful
*/

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// load plugin text domain
function MEDME_init() { 
	load_plugin_textdomain( 'Meta-Description-Made-Easy', false, dirname( plugin_basename( __FILE__ ) ) . '/translation' );
}
add_action('plugins_loaded', 'MEDME_init');

// add excerpt to pages
function MEDME_page_excerpt() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'MEDME_page_excerpt' );

// add settings link
function MEDME_action_links ( $links ) { 
	$settingslink = array( '<a href="'. admin_url( 'options-general.php?page=MEDME' ) .'">'. __('Settings', 'Meta-Description-Made-Easy') .'</a>', ); 
	return array_merge( $links, $settingslink ); 
} 
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'MEDME_action_links' ); 
 
// add admin options page
function MEDME_menu_page() {
	add_options_page( __( 'Meta Description', 'Meta-Description-Made-Easy' ), __( 'Meta Description', 'Meta-Description-Made-Easy' ), 'manage_options', 'MEDME', 'MEDME_options_page' );
}
add_action( 'admin_menu', 'MEDME_menu_page' );

// add admin settings and such 
function MEDME_admin_init() {
	add_settings_section( 'MEDME-section', __( 'General', 'Meta-Description-Made-Easy' ), 'MEDME_section_callback', 'MEDME' );
	add_settings_field( 'MEDME-field', __( 'Meta Description', 'Meta-Description-Made-Easy' ), 'MEDME_field_callback', 'MEDME', 'MEDME-section' );
	register_setting( 'MEDME-options', 'MEDME-setting', 'sanitize_text_field' );
	add_settings_field( 'MEDME-field-1', __( 'Homepage', 'Meta-Description-Made-Easy' ), 'MEDME_field_callback_1', 'MEDME', 'MEDME-section' );
	register_setting( 'MEDME-options', 'MEDME-setting-1', 'esc_attr' );

	add_settings_section( 'MEDME-section-2', __( 'Post and Page', 'Meta-Description-Made-Easy' ), 'MEDME_section_callback_2', 'MEDME' );
	add_settings_field( 'MEDME-field-2', __( 'Excerpt', 'Meta-Description-Made-Easy' ), 'MEDME_field_callback_2', 'MEDME', 'MEDME-section-2' );
	register_setting( 'MEDME-options', 'MEDME-setting-2', 'esc_attr' );

	add_settings_section( 'MEDME-section-3', __( 'Product', 'Meta-Description-Made-Easy' ), 'MEDME_section_callback_3', 'MEDME' );
	add_settings_field( 'MEDME-field-3', __( 'Product short description', 'Meta-Description-Made-Easy' ), 'MEDME_field_callback_3', 'MEDME', 'MEDME-section-3' );
	register_setting( 'MEDME-options', 'MEDME-setting-3', 'esc_attr' );
}
add_action( 'admin_init', 'MEDME_admin_init' );

function MEDME_section_callback() {
	echo '<ul>';
	echo '<li>'.esc_attr__( 'Every search engine, Just like google, Shows meta descriptions in the search result pages (SERPs)', 'Meta-Description-Made-Easy' ).'</li>';
	echo '<li>'.esc_attr__( 'Use a unique meta description for every single post and page', 'Meta-Description-Made-Easy' ).'</li>';
	echo '</ul>';
}

function MEDME_section_callback_2() {
	echo '<ul>';
	echo '<li>'.esc_attr__( 'Using the "Excerpt" Box, you can add your SEO friendly Meta Description to your posts and pages', 'Meta-Description-Made-Easy' ).'</li>';
	echo '</ul>';
}

function MEDME_section_callback_3() {
	echo '<ul>';
	echo '<li>'.esc_attr__( 'If you have built an online store on your site using woocommerce," box.', 'Meta-Description-Made-Easy' ).'</li>';
	echo '<li>'.esc_attr__( 'you can add your product description to the pages by writing you desired content in "Product short description" Box.', 'Meta-Description-Made-Easy' ).'</li>';
	echo '</ul>';
}

function MEDME_field_callback() {
	$MEDME_setting = esc_attr( get_option( 'MEDME-setting' ) );
	$MEDME_count = strlen(get_option( 'MEDME-setting' ) );
	echo "<textarea name='MEDME-setting' rows='8' cols='50' maxlength='320'>$MEDME_setting</textarea>";
	?>
	<p><?php printf( esc_attr__( 'You have used %s of 320 characters.', 'Meta-Description-Made-Easy' ), $MEDME_count ); ?></p>
	<?php
}

function MEDME_field_callback_1() {
	$value = esc_attr( get_option( 'MEDME-setting-1' ) );
	?>
	<input type='hidden' name='MEDME-setting-1' value='no'>
	<label><input type='checkbox' name='MEDME-setting-1' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Use this meta description for homepage only.', 'Meta-Description-Made-Easy' ); ?></label>
	<?php
}

function MEDME_field_callback_2() {
	$value = esc_attr( get_option( 'MEDME-setting-2' ) );
	?>
	<input type='hidden' name='MEDME-setting-2' value='no'>
	<label><input type='checkbox' name='MEDME-setting-2' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Use as meta description.', 'Meta-Description-Made-Easy' ); ?></label>
	<?php
}

function MEDME_field_callback_3() {
	$value = esc_attr( get_option( 'MEDME-setting-3' ) );
	?>
	<input type='hidden' name='MEDME-setting-3' value='no'>
	<label><input type='checkbox' name='MEDME-setting-3' <?php checked( $value, 'yes' ); ?> value='yes'> <?php _e( 'Use as meta description.', 'Meta-Description-Made-Easy' ); ?></label>
	<?php
}

// display admin options page
function MEDME_options_page() {
?>
<div class="wrap"> 
	<div id="icon-plugins" class="icon32"></div> 
	<h1><?php _e( 'Very Simple Meta Description', 'Meta-Description-Made-Easy' ); ?></h1> 
	<form action="options.php" method="POST">
	<?php settings_fields( 'MEDME-options' ); ?>
	<?php do_settings_sections( 'MEDME' ); ?>
	<?php submit_button(); ?>
	</form>
</div>
<?php
}

// include meta in header 
function MEDME_meta_description() {
	// no meta description for 404 or search page
	if ( is_404() || is_search() ) 
		return;
	global $post;
	$MEDME_meta = esc_attr( get_option( 'MEDME-setting' ) );
	$MEDME_homepage = esc_attr( get_option( 'MEDME-setting-1' ) );
	$MEDME_post = esc_attr( get_option( 'MEDME-setting-2' ) );
	$MEDME_product = esc_attr( get_option( 'MEDME-setting-3' ) );
	$MEDME_excerpt = get_the_excerpt();

	// meta description
	if ( $MEDME_homepage != 'yes' ) {
		if ( $MEDME_post == 'yes' && is_singular( array('post', 'page') ) && has_excerpt($post->ID) ) {
			echo '<meta name="description" content="'.esc_attr($MEDME_excerpt).'" />'."\n";
		} elseif ( $MEDME_product == 'yes' && is_singular( 'product' ) && has_excerpt($post->ID) ) {
			echo '<meta name="description" content="'.esc_attr($MEDME_excerpt).'" />'."\n";
		} else {
			if ( !empty($MEDME_meta) ) {
				echo '<meta name="description" content="'.esc_attr($MEDME_meta).'" />'."\n";
			}
		}
	} 
	if ( $MEDME_homepage == 'yes' ) {
		if ( $MEDME_post == 'yes' && is_singular( array('post', 'page') ) && has_excerpt($post->ID) ) {
			echo '<meta name="description" content="'.esc_attr($MEDME_excerpt).'" />'."\n";
		} elseif ( $MEDME_product == 'yes' && is_singular( 'product' ) && has_excerpt($post->ID) ) {
			echo '<meta name="description" content="'.esc_attr($MEDME_excerpt).'" />'."\n";
		} else { 
			if ( is_front_page() ) {
				if ( !empty( $MEDME_meta ) ) {
					echo '<meta name="description" content="'.esc_attr($MEDME_meta).'" />'."\n";
				}
			}
		}
	}
}
add_action( 'wp_head', 'MEDME_meta_description' );
