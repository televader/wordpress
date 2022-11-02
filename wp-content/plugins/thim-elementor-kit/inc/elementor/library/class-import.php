<?php
namespace Thim_EL_Kit\Elementor\Library;

use Elementor\TemplateLibrary\Source_Local;

class Import extends Source_Local {

	/**
	 * Update post meta.
	 *
	 * @since 2.0.0
	 * @param  integer $post_id Post ID.
	 * @param  array   $data Elementor Data.
	 * @return array   $data Elementor Imported Data.
	 */
	public function import( $post_id = 0, $data = array() ) {
		if ( ! empty( $post_id ) && ! empty( $data ) ) {
			$data = wp_json_encode( $data, true );

			$data = json_decode( $data, true );

			// Import the data.
			$data = $this->process_export_import_content( $data, 'on_import' );

			update_metadata( 'post', $post_id, '_elementor_data', $data );

			// !important, Clear the cache after images import.
			\Elementor\Plugin::$instance->files_manager->clear_cache();

			return $data;
		}

		return false;
	}
}
