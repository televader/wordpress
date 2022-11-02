<?php

namespace Thim_EL_Kit;

use Thim_EL_Kit\Custom_Post_Type;

class Enqueue {
	use SingletonTrait;

	public $version;

	public function __construct() {
		$this->version = THIM_EKIT_VERSION;

		if ( THIM_EKIT_DEV ) {
			$this->version = time();
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ), 100 );
		add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'register_icon_thim_ekits_elementor' ) );
	}

	public function admin_scripts() {
		global $pagenow;
		$screen = get_current_screen();

		if ( ( Custom_Post_Type::CPT === $screen->id && ( 'post.php' === $pagenow || 'post-new.php' === $pagenow ) ) || ( 'edit.php' == $pagenow && 'edit-' . Custom_Post_Type::CPT == $screen->id ) ) {
			$file_info = include THIM_EKIT_PLUGIN_PATH . 'build/admin.asset.php';

			wp_enqueue_script( 'thim-ekit-admin', THIM_EKIT_PLUGIN_URL . 'build/admin.js', $file_info['dependencies'], $file_info['version'], true );
			wp_enqueue_style( 'thim-ekit-admin', THIM_EKIT_PLUGIN_URL . 'build/admin.css', array( 'wp-components' ), $this->version );

			$this->localize_admin();
		}

		do_action( 'thim_ekit/admin/enqueue' );
	}

	public function frontend_scripts() {
		wp_enqueue_script( 'thim-ekit-frontend', THIM_EKIT_PLUGIN_URL . 'build/frontend.js', array(), $this->version, true );
		wp_enqueue_style( 'thim-ekit-frontend', THIM_EKIT_PLUGIN_URL . 'build/frontend.css', array(), $this->version );
		wp_enqueue_script( 'thim-ekit-widgets', THIM_EKIT_PLUGIN_URL . 'build/widgets.js', array( 'elementor-frontend', 'wp-api-fetch' ), $this->version, true );
		wp_enqueue_style( 'thim-ekit-widgets', THIM_EKIT_PLUGIN_URL . 'build/widgets.css', array( 'elementor-frontend' ), $this->version ); // Load after elementor-frontend.css
		wp_enqueue_style( 'font-awesome-5-all', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.css', array(), $this->version );
		wp_enqueue_style( 'thim-ekit-font-icon', THIM_EKIT_PLUGIN_URL . 'build/libraries/thim-ekits/css/thim-ekits-icons.min.css', $this->version );

		do_action( 'thim_ekit/frontend/enqueue' );
	}

	public function localize_admin() {
		$list_types = Custom_Post_Type::instance()->tabs;

		$types = array();

		if ( ! empty( $list_types ) ) {
			foreach ( $list_types as $key => $type ) {
				$types[] = array(
					'value' => $key,
					'label' => $type['name'] ?? $key,
				);
			}
		}

		wp_localize_script(
			'thim-ekit-admin',
			'thimEKit',
			apply_filters(
				'thim_ekit/admin/enqueue/localize',
				array(
					'types' => $types,
				)
			)
		);
	}

	public function register_icon_thim_ekits_elementor( $font ) {
		$ekits_fonts_icon['thim-ekits-fonts'] = array(
			'name'          => 'thim-ekits-fonts',
			'label'         => esc_html__( 'Thim Elementor Kit', 'thim-elementor-kit' ),
			'url'           => THIM_EKIT_PLUGIN_URL . 'build/libraries/thim-ekits/css/thim-ekits-icons.min.css',
			'prefix'        => 'tk-',
			'displayPrefix' => 'tk',
			'labelIcon'     => 'eicon-elementor',
			'ver'           => $this->version,
			'fetchJson'     => THIM_EKIT_PLUGIN_URL . 'build/libraries/thim-ekits/js/thim-ekits.json',
			'native'        => true,
		);

		return array_merge( $font, $ekits_fonts_icon );
	}
}

Enqueue::instance();
