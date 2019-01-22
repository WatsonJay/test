<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package love
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
    <div class="side_bar">
	    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
