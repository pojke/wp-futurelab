<?php
/**
 * The FL_Shortcodes class
 *
 * @package FutureLab
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * FL_Shortcodes class
 * [fl_accordion]
 * [fl_slides num="4" category="popular"]
 * [fl_dropdown_menu menu="area"]
 *
 * @class       FL_Shortcodes
 * @version     1.0
 * @package     FutureLab
 */
class FL_Shortcodes {

	/**
	 * Init shortcodes.
	 */
	public static function init() {
		$shortcodes = array(
			'fl_accordion'                    => __CLASS__ . '::accordion',
			'fl_slides'                    => __CLASS__ . '::slides',
			'fl_dropdown_menu'                    => __CLASS__ . '::dropdown_menu',
		);

		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( $shortcode, $function );
		}
	}

	/**
	 * List accordion
	 *
	 * @return string
	 */
	public static function accordion( $atts ) {
		$atts = shortcode_atts( array(
			'columns'  => '1',
		), $atts, 'product_category' );

		$accordions = get_post_meta( get_the_ID(), 'futurelab_accordion_group_field_id', true );
		if ( empty( $accordions ) ) {
			return;
		}

		ob_start();

		fl_get_template( 'accordion.php', false, array(
			'accordions' => $accordions,
			'columns' => $atts['columns'],
		) );

		return ob_get_clean();
	}

	/**
	 * Display latest slides
	 *
	 * @param  array $atts [description].
	 * @return string       [description].
	 */
	public static function slides( $atts ) {
		$atts = shortcode_atts( array(
			'num' => '4',
			'category' => '',
		), $atts, 'slides' );

		$query_args = array(
			'post_type'           => 'slides',
			'post_status'         => 'publish',
			'posts_per_page'      => $atts['num'],
			'orderby'			 => 'date',
			'order'				 => 'DESC',
		);

		if ( ! empty( $atts['category'] ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy'	 => 'slide_category',
					'field'		 => 'slug',
					'terms'		 => $atts['category'],
				),
			);
		}

		$slides = get_posts( $query_args );

		if ( empty( $slides ) ) {
			return;
		}

		ob_start();

		fl_get_template( 'slide.php', false, array(
			'slides' => $slides,
		) );

		return ob_get_clean();
	}


	/**
	 * Display dropdown menu
	 *
	 * @param  array $atts [description].
	 * @return string       [description].
	 */
	public static function dropdown_menu( $atts ) {
		$atts = shortcode_atts( array(
			'name' => 'Dropdown',
			'menu' => '',
		), $atts, 'dropdown_menu' );

		if( empty( $atts['menu'] ) ) {
			return;
		}

		ob_start();

		fl_get_template( 'dropdown-menu.php', false, array(
			'atts' => $atts,
		) );

		return ob_get_clean();
	}

}
