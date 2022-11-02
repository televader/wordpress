<?php
namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Icons_Manager;

class Thim_Ekit_Widget_Post_Navigation extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'thim-ekits-post-navigation';
	}

	public function get_title() {
		return esc_html__( 'Thim Post Navigation', 'thim-elementor-kit' );
	}

	public function get_icon() {
		return 'eicon-post-navigation';
	}

	public function get_categories() {
		return array( \Thim_EL_Kit\Elementor::CATEGORY_SINGLE_POST );
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			'show_label',
			array(
				'label'     => esc_html__( 'Show Label', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'thim-elementor-kit' ),
				'label_off' => esc_html__( 'Hide', 'thim-elementor-kit' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'prev_label',
			array(
				'label'     => esc_html__( 'Previous Label', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Previous', 'thim-elementor-kit' ),
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'next_label',
			array(
				'label'     => __( 'Next Label', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Next', 'thim-elementor-kit' ),
				'condition' => array(
					'show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_arrow',
			array(
				'label'     => esc_html__( 'Show Arrows Icon', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'thim-elementor-kit' ),
				'label_off' => esc_html__( 'Hide', 'thim-elementor-kit' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'arrow_left',
			array(
				'label'       => esc_html__( 'Arrows Prev Icon', 'thim-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'separator'   => 'before',
				'default'     => array(
					'value'   => 'fas fa-angle-left',
					'library' => 'fa-solid',
				),
				'recommended' => array(
					'fa-solid' => array(
						'angle-left',
						'angle-double-left',
						'chevron-left',
						'chevron-circle-left',
						'caret-left',
						'arrow-left',
						'long-arrow-alt-left',
						'arrow-circle-left',
					),
				),
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->add_control(
			'arrow_right',
			array(
				'label'       => esc_html__( 'Arrows Next Icon', 'thim-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => array(
					'value'   => 'fas fa-angle-right',
					'library' => 'fa-solid',
				),
				'recommended' => array(
					'fa-solid' => array(
						'angle-right',
						'angle-double-right',
						'chevron-right',
						'chevron-circle-right',
						'caret-right',
						'arrow-right',
						'long-arrow-alt-right',
						'arrow-circle-right',
					),
				),
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->add_control(
			'arrow',
			array(
				'label'     => esc_html__( 'Select Icon', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'fa fa-angle-left'          => esc_html__( 'Angle', 'thim-elementor-kit' ),
					'fa fa-angle-double-left'   => esc_html__( 'Double Angle', 'thim-elementor-kit' ),
					'fa fa-chevron-left'        => esc_html__( 'Chevron', 'thim-elementor-kit' ),
					'fa fa-chevron-circle-left' => esc_html__( 'Chevron Circle', 'thim-elementor-kit' ),
					'fa fa-caret-left'          => esc_html__( 'Caret', 'thim-elementor-kit' ),
					'fa fa-arrow-left'          => esc_html__( 'Arrow', 'thim-elementor-kit' ),
					'fa fa-long-arrow-left'     => esc_html__( 'Long Arrow', 'thim-elementor-kit' ),
					'fa fa-arrow-circle-left'   => esc_html__( 'Arrow Circle', 'thim-elementor-kit' ),
					'fa fa-arrow-circle-o-left' => esc_html__( 'Arrow Circle Negative', 'thim-elementor-kit' ),
				),
				'default'   => 'fa fa-angle-left',
				'condition' => array(
					'arrow_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'show_title',
			array(
				'label'     => esc_html__( 'Show Post Title', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'thim-elementor-kit' ),
				'label_off' => esc_html__( 'Hide', 'thim-elementor-kit' ),
				'default'   => 'yes',
			)
		);

		$this->end_controls_section();

		$this->register_style_controls();
	}

	protected function register_style_controls() {
		$this->start_controls_section(
			'section_style_label',
			array(
				'label' => esc_html__( 'Label', 'thim-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_label_style' );

		$this->start_controls_tab(
			'label_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.thim-ekit-single-post__navigation__link__content--label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'label_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			'label_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.thim-ekit-single-post__navigation__link__content--label:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} span.thim-ekit-single-post__navigation__link__content--label',
				'exclude'  => array( 'line_height' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			array(
				'label'     => esc_html__( 'Post Title', 'thim-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_title' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_post_navigation_style' );

		$this->start_controls_tab(
			'tab_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.thim-ekit-single-post__navigation__link__content--title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			'hover_color',
			array(
				'label'     => esc_html__( 'Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.thim-ekit-single-post__navigation__link__content--title:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} span.thim-ekit-single-post__navigation__link__content--title',
				'exclude'  => array( 'line_height' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_style',
			array(
				'label'     => esc_html__( 'Arrow Icon', 'thim-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_title' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_post_navigation_arrow' );

		$this->start_controls_tab(
			'arrow_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			'arrow_color',
			array(
				'label'     => esc_html__( 'Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.thim-ekit-single-post__navigation__arrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrow_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			'arrow_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} span.thim-ekit-single-post__navigation__arrow:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'arrow_size',
			array(
				'label'     => esc_html__( 'Size', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 6,
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .thim-ekit-single-post__navigation__arrow' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'arrow_gap',
			array(
				'label'     => esc_html__( 'Gap', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .thim-ekit-single-post__navigation__link > a' => 'column-gap: {{SIZE}}{{UNIT}};',
				),
				'range'     => array(
					'em' => array(
						'min' => 0,
						'max' => 5,
					),
				),
			)
		);

		$this->add_control(
			'arrow_size_spacing',
			array(
				'label'     => esc_html__( 'Icon Size', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .thim-ekit-single-post__navigation__arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'arrow_border',
				'selector' => '{{WRAPPER}} .thim-ekit-single-post__navigation__arrow',
			)
		);

		$this->add_responsive_control(
			'arrow_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .thim-ekit-single-post__navigation__arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'arrow_box_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .thim-ekit-single-post__navigation__arrow',
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'thim-ekit/modules/single-post/before-preview-query' );

		$settings = $this->get_settings_for_display();

		$prev_label = $next_label = $prev_arrow = $next_arrow = $prev_title = $next_title = '';

		if ( 'yes' === $settings['show_label'] ) {
			$prev_label = '<span class="thim-ekit-single-post__navigation__link__content--label">' . esc_html( $settings['prev_label'] ) . '</span>';
			$next_label = '<span class="thim-ekit-single-post__navigation__link__content--label">' . esc_html( $settings['next_label'] ) . '</span>';
		}

		$prev_icon = $settings['arrow_left'];
		$next_icon = $settings['arrow_right'];

		if ( $prev_icon === 'svg' ) {
			$prev_icon_html = Icons_Manager::render_uploaded_svg_icon( $prev_icon['value'] );
		} else {
			$prev_icon_html = Icons_Manager::render_font_icon( $prev_icon );
		}

		if ( $next_icon === 'svg' ) {
			$next_icon_html = Icons_Manager::render_uploaded_svg_icon( $next_icon['value'] );
		} else {
			$next_icon_html = Icons_Manager::render_font_icon( $next_icon );
		}

		if ( 'yes' === $settings['show_arrow'] ) {
			$prev_arrow = '<span class="thim-ekit-single-post__navigation__arrow thim-ekit-single-post__navigation__arrow--prev">' . wp_kses_post( $prev_icon_html ) . '<span class="elementor-screen-only">' . esc_html__( 'Prev', 'thim-elementor-kit' ) . '</span></span>';
			$next_arrow = '<span class="thim-ekit-single-post__navigation__arrow thim-ekit-single-post__navigation__arrow--next">' . wp_kses_post( $next_icon_html ) . '<span class="elementor-screen-only">' . esc_html__( 'Next', 'thim-elementor-kit' ) . '</span></span>';
		}

		if ( 'yes' === $settings['show_title'] ) {
			$prev_title = '<span class="thim-ekit-single-post__navigation__link__content--title">%title</span>';
			$next_title = '<span class="thim-ekit-single-post__navigation__link__content--title">%title</span>';
		}
		?>

		<div class="thim-ekit-single-post__navigation">
			<div class="thim-ekit-single-post__navigation__prev thim-ekit-single-post__navigation__link">
				<?php previous_post_link( '%link', wp_kses_post( $prev_arrow ) . '<span class="thim-ekit-single-post__navigation__link__content">' . wp_kses_post( $prev_label ) . wp_kses_post( $prev_title ) . '</span>', true, '' ); ?>
			</div>

			<div class="thim-ekit-single-post__navigation__next thim-ekit-single-post__navigation__link">
				<?php next_post_link( '%link', '<span class="thim-ekit-single-post__navigation__link__content">' . wp_kses_post( $next_label ) . wp_kses_post( $next_title ) . '</span>' . wp_kses_post( $next_arrow ), true, '' ); ?>
			</div>
		</div>

		<?php
		do_action( 'thim-ekit/modules/single-post/after-preview-query' );
	}
}
