<?php
namespace Thim_EL_Kit;

use Elementor\Controls_Manager;
use Thim_EL_Kit\Modules\SinglePost\Init as SinglePost;
use Thim_EL_Kit\Modules\ArchivePost\Init as ArchivePost;
use Thim_EL_Kit\Modules\ArchiveProduct\Init as ArchiveProduct;
use Thim_EL_Kit\Modules\SingleProduct\Init as SingleProduct;
use Thim_EL_Kit\Elementor\Controls\Controls_Manager as Thim_Controls_Manager;

class Elementor {
	use SingletonTrait;

	const CATEGORY                 = 'thim_ekit';
	const CATEGORY_ARCHIVE_POST    = 'thim_ekit_archive_post';
	const CATEGORY_SINGLE_POST     = 'thim_ekit_single_post';
	const CATEGORY_ARCHIVE_PRODUCT = 'thim_ekit_archive_product';
	const CATEGORY_SINGLE_PRODUCT  = 'thim_ekit_single_product';

	const WIDGETS = array(
		'global'          => array(
			'nav-menu',
			'site-logo',
			'product-base',
			'course-base',
			'header-info',
			'social',
			'minicart',
			'list-blog',
			'list-course',
			'team',
			'testimonial',
			'back-to-top',
			'contact-form-7',
			'breadcrumb',
			'search-form',
		),
		'archive-post'    => array( 'archive-post' ),
		'single-post'     => array( 'post-title', 'post-content', 'post-image', 'author-box', 'post-comment', 'post-navigation', 'post-info' ),
		'archive-product' => array( 'archive-product' ),
		'single-product'  => array(
			'product-title',
			'product-image',
			'product-price',
			'product-add-to-cart',
			'product-rating',
			'product-stock',
			'product-meta',
			'product-short-description',
			'product-content',
			'product-tabs',
			'product-additional-information',
			'product-related',
			'product-upsell',
		),
	);

	public function __construct() {
		$this->include_controls();

		// Register Controls
		add_action( 'elementor/controls/register', array( $this, 'register_controls' ), 11 );

		add_action( 'elementor/documents/register_controls', array( $this, 'register_documents' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_category' ) );
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ), 10, 1 );
	}

	public function widgets() {
		// Include Elementor widget in here.
		$widgets = self::WIDGETS;

		global $post;

		// Only register archive-post, post-title in Elementor Editor only template.
		if ( $post && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$type = get_post_meta( $post->ID, Custom_Post_Type::TYPE, true );

			foreach ( $widgets as $key => $widget ) {
				if ( $key === 'archive-post' && $type !== ArchivePost::instance()->tab ) {
					unset( $widgets['archive-post'] );
				}

				if ( $key === 'single-post' && $type !== SinglePost::instance()->tab ) {
					unset( $widgets['single-post'] );
				}

				if ( $key === 'archive-product' && ( ! class_exists( 'WooCommerce' ) || $type !== ArchiveProduct::instance()->tab ) ) {
					unset( $widgets['archive-product'] );
				}

				if ( $key === 'single-product' && ( ! class_exists( 'WooCommerce' ) || $type !== SingleProduct::instance()->tab ) ) {
					unset( $widgets['single-product'] );
				}
			}
		}

		if ( ! class_exists( 'WooCommerce' ) ) {
			unset( $widgets['archive-product'] );
			unset( $widgets['single-product'] );
			unset( $widgets['global'][ array_search( 'minicart', $widgets['global'] ) ] );
		}

		if ( ! class_exists( 'LearnPress' ) ) {
			unset( $widgets['global'][ array_search( 'list-course', $widgets['global'] ) ] );
		}

		if ( ! class_exists( 'WPCF7' ) ) {
			unset( $widgets['global'][ array_search( 'contact-form-7', $widgets['global'] ) ] );
		}

		$widgets = apply_filters( 'thim_ekit/elementor/widgets/list', $widgets );

		return $widgets;
	}

	public function register_documents( $document ) {
		if ( get_the_ID() ) {
			$type = get_post_meta( get_the_ID(), Custom_Post_Type::TYPE, true );

			$preview = array(
				'type'      => SinglePost::instance()->tab,
				'post_type' => 'post',
			);

			if ( class_exists( 'WooCommerce' ) ) {
				$preview = array(
					'type'      => SingleProduct::instance()->tab,
					'post_type' => 'product',
				);
			}

			$preview = apply_filters( 'thim_ekit/elementor/documents/preview_item', $preview );

			if ( $type === $preview['type'] ) {
				$document->start_controls_section(
					'preview_settings',
					array(
						'label' => esc_html__( 'Preview Settings', 'thim-elementor-kit' ),
						'tab'   => Controls_Manager::TAB_SETTINGS,
					)
				);

				$document->add_control(
					'thim_ekits_preview_id',
					array(
						'label'       => esc_html__( 'Search & Select', 'thim-elementor-kit' ),
						'type'        => Thim_Controls_Manager::AUTOCOMPLETE,
						'rest_action' => 'get-posts?post_type=' . $preview['post_type'],
						'label_block' => true,
					)
				);

				$document->add_control(
					'thim_ekits_apply_preview',
					array(
						'type'      => Controls_Manager::BUTTON,
						'label'     => '',
						'text'      => esc_html__( 'Save & Preview', 'thim-elementor-kit' ),
						'separator' => 'none',
						'event'     => 'thimELKitsPreview',
					)
				);

				$document->end_controls_section();
			}
		}
	}

	public function register_category( \Elementor\Elements_Manager $elements_manager ) {
		$categories = apply_filters(
			'thim_ekit_elementor_category',
			array(
				self::CATEGORY_ARCHIVE_POST    => array(
					'title' => esc_html__( 'Thim Archive Post', 'thim-elementor-kit' ),
					'icon'  => 'fa fa-plug',
				),
				self::CATEGORY_SINGLE_POST     => array(
					'title' => esc_html__( 'Thim Single Post', 'thim-elementor-kit' ),
					'icon'  => 'fa fa-plug',
				),
				self::CATEGORY_ARCHIVE_PRODUCT => array(
					'title' => esc_html__( 'Thim Archive Product', 'thim-elementor-kit' ),
					'icon'  => 'fa fa-plug',
				),
				self::CATEGORY_SINGLE_PRODUCT  => array(
					'title' => esc_html__( 'Thim Single Product', 'thim-elementor-kit' ),
					'icon'  => 'fa fa-plug',
				),
				self::CATEGORY                 => array(
					'title' => esc_html__( 'Thim Basic', 'thim-elementor-kit' ),
					'icon'  => 'fa fa-plug',
				),
			)
		);

		$old_categories = $elements_manager->get_categories();
		$categories     = array_merge( $categories, $old_categories );

		$set_categories = function ( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $elements_manager, $categories );
	}

	public function include_controls() {
		include_once THIM_EKIT_PLUGIN_PATH . 'inc/elementor/controls/control-manager.php';
		include_once THIM_EKIT_PLUGIN_PATH . 'inc/elementor/controls/autocomplete.php';

		// Custom Css Control
		include_once THIM_EKIT_PLUGIN_PATH . 'inc/elementor/custom-css/class-custom-css.php';

		// Library
		include_once THIM_EKIT_PLUGIN_PATH . 'inc/elementor/library/class-init.php';
	}

	public function register_controls( $controls_manager ) {
		$controls_manager->register_control( 'autocomplete', new \Thim_EL_Kit\Elementor\Controls\Autocomplete() );
	}

	public function register_widget_class( $base, $widget ) {
		$class = ucwords( str_replace( '-', ' ', $widget ) );
		$class = str_replace( ' ', '_', $class );
		$class = sprintf( '\Elementor\Thim_Ekit_Widget_%s', $class );

		if ( ! class_exists( $class ) ) {
			$file_url = $widget . '/' . $widget . '.php';

			$file       = apply_filters( 'thim_ekit/elementor/widget/file_path', THIM_EKIT_PLUGIN_PATH . 'inc/elementor/widgets/' . $base . '/' . $file_url, $widget );
			$file_theme = locate_template( 'thim-elementor-kit/' . $file_url );

			if ( file_exists( $file_theme ) ) {
				$file = $file_theme;
			}

			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}

		return $class;
	}

	public function register_widgets( $widgets_manager ) {
		$widgets_all = $this->widgets();

		if ( ! empty( $widgets_all ) ) {
			foreach ( $widgets_all as $base => $widgets ) {
				if ( ! empty( $widgets ) ) {
					foreach ( $widgets as $widget ) {
						$class = $this->register_widget_class( $base, $widget );

						if ( class_exists( $class ) && ! Settings::instance()->disable_widgets_settings( $widget ) ) {
							$widgets_manager->register( new $class() );
						}
					}
				}
			}
		}
	}

	public static function get_cat_taxonomy( $taxomony = 'category', $cats = false ) {
		if ( ! $cats ) {
			$cats = array();
		}
		$terms = new \WP_Term_Query(
			array(
				'taxonomy'     => $taxomony,
				'pad_counts'   => 1,
				'hierarchical' => 1,
				'hide_empty'   => 1,
				'orderby'      => 'name',
				'menu_order'   => true,
			)
		);

		if ( is_wp_error( $terms ) ) {
		} else {
			if ( empty( $terms->terms ) ) {
			} else {
				foreach ( $terms->terms as $term ) {
					$prefix = '';
					if ( $term->parent > 0 ) {
						$prefix = '--';
					}
					$cats[ $term->term_id ] = $prefix . $term->name;
				}
			}
		}

		return $cats;
	}

	public static function register_options_courses_meta_data() {
		$opt                  = array();
		$opt['duration']      = esc_html__( 'Duration', 'thim-elementor-kit' );
		$opt['level']         = esc_html__( 'Level', 'thim-elementor-kit' );
		$opt['count_lesson']  = esc_html__( 'Count Lesson', 'thim-elementor-kit' );
		$opt['count_quiz']    = esc_html__( 'Count Quiz', 'thim-elementor-kit' );
		$opt['count_student'] = esc_html__( 'Count Student', 'thim-elementor-kit' );
		$opt['instructor']    = esc_html__( 'Instructor', 'thim-elementor-kit' );
		$opt['category']      = esc_html__( 'Category', 'thim-elementor-kit' );
		$opt['tag']           = esc_html__( 'Tag', 'thim-elementor-kit' );
		$opt['price']         = esc_html__( 'Price', 'thim-elementor-kit' );

		return apply_filters( 'learn-thim-kits-lp-meta-data', $opt );
	}
}

Elementor::instance();
