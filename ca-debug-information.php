<?php
/**
 * Plugin Name
 *
 * @author            Alexandro Giles
 * @copyright         2021 Alexandro Giles
 * @license           GPL-2.0-or-later
 * @wordpress-plugin
 * Plugin Name:       CA Debug information
 * Plugin URI:        https://example.com/plugin-name
 * Description:       It shows in the admin navbar information regarding debug information useful for developers or sitewide admins.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            Alexandro Giles
 * Author URI:        https://twitter.com/alexandrogiles
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

 //todo: init function
 
//show the template loaded
function cagb_which_template_is_loaded() {
	if ( is_super_admin() ) {
		$categories = get_the_category();
		//$category_id = $categories[0]->cat_ID;
		echo '<div style="margin-top:25px;" id="my-debug">';
		global $template;
		print_r( $template );
		echo ' | ' . get_the_ID();
		echo ' | ' . $categories;
		echo "</div>";
	}
}

add_action( 'wp_footer' , 'cagb_which_template_is_loaded');

function add_top_link_to_admin_bar($admin_bar) {
    // add a parent item
       $args = array(
           'id'    => 'Debug',
           'title' => 'Debug info',
       );
       $admin_bar->add_node( $args );
        
    // add a child item to our parent item 
       $args = array(
           'parent' => 'Debug',
           'id'     => 'media-libray',
           'title'  => get_the_ID(),
           'meta'   => true        
       );
       $admin_bar->add_node( $args );
        
    // add a child item to our parent item 
       $args = array(
           'parent' => 'Debug',
           'id'     => 'plugins',
           'title'  => 'Plugins',
           'href'   => esc_url( admin_url( 'plugins.php' ) ),
           'meta'   => false        
       );
       $admin_bar->add_node( $args );                        
}