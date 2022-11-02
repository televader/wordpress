<?php
namespace Thim_EL_Kit\Modules;

use Thim_EL_Kit\SingletonTrait;

class Init {
	use SingletonTrait;

	public function __construct() {
		$this->includes();
	}

	public function includes() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		require_once THIM_EKIT_PLUGIN_PATH . 'inc/modules/mega-menu/class-init.php';
		require_once THIM_EKIT_PLUGIN_PATH . 'inc/modules/header-footer/class-init.php';
		require_once THIM_EKIT_PLUGIN_PATH . 'inc/modules/class-modules.php';
		require_once THIM_EKIT_PLUGIN_PATH . 'inc/modules/archive-post/class-init.php';
		require_once THIM_EKIT_PLUGIN_PATH . 'inc/modules/single-post/class-init.php';

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			require_once THIM_EKIT_PLUGIN_PATH . 'inc/modules/class-woocommerce.php';
			require_once THIM_EKIT_PLUGIN_PATH . 'inc/modules/archive-product/class-init.php';
			require_once THIM_EKIT_PLUGIN_PATH . 'inc/modules/single-product/class-init.php';
		}
	}
}

Init::instance();
