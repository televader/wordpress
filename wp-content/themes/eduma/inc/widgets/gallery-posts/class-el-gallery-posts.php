<?php
/**
 * Thim_Builder Elementor Gallery Posts widget
 *
 * @version     1.0.0
 * @author      ThimPress
 * @package     Thim_Builder/Classes
 * @category    Classes
 * @author      Thimpress, tuanta
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Thim_Builder_El_Gallery_Posts' ) ) {
	/**
	 * Class Thim_Builder_El_Gallery_Posts
	 */
	class Thim_Builder_El_Gallery_Posts extends Thim_Builder_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'Thim_Builder_Config_Gallery_Posts';
		
		protected function get_html_wrapper_class() {
			return 'thim-widget-gallery-posts';
		}
		/**
		 * Register controls.
		 */
		protected function register_controls() {
			$this->start_controls_section(
				'el-gallery-posts', [ 'label' => esc_html__( 'Thim: Gallery Posts', 'eduma' )]
			);

			$controls = \Thim_Builder_El_Mapping::mapping( $this->options() );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}
	}
}