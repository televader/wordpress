<?php
/**
 * Section Course Single
 *
 * @package Eduma
 */

thim_customizer()->add_section(
	array(
		'id'       => 'course_single',
		'panel'    => 'course',
		'title'    => esc_html__( 'Single Pages', 'eduma' ),
		'priority' => 15,
	)
);
$callback_single ='';
if(class_exists( 'Thim_EL_Kit' )){
	$callback_single = array(
		'setting'  => 'thim_ekits_single_course_tpl',
		'operator' => '!=',
		'value'    => 'ekits_tpl',
	);

	thim_customizer()->add_field(
		array(
			'id'       => 'thim_ekits_single_course_tpl',
			'type'     => 'select',
			'label'    => esc_html__( 'Template', 'eduma' ),
  			'priority' => 11,
			'default'  => '',
 			'multiple' => 0,
			'section'  => 'course_single',
			'choices'  => array(
				'' 			=> esc_html__( 'Theme Template', 'eduma' ),
				'ekits_tpl' => esc_html__( 'ElementorKits Template', 'eduma' ),
			),
		)
	);

	thim_customizer()->add_field(
		array(
			'id'       => 'thim_desc_single_course_tpl',
			'type'     => 'tp_notice',
 			'description'=>  __('You can config and builder in <a href="'.admin_url('edit.php?post_type=thim_elementor_kit&thim_elementor_type=single-course').'" target="_blank"> Thim Elementor</a>','eduma'),
			'section'  => 'course_single',
			'priority' => 11,
			'active_callback' => array(array(
					'setting'  => 'thim_ekits_single_course_tpl',
					'operator' => '===',
					'value'    => 'ekits_tpl',
				)
			),
		)
	);
}

// Select All Content Page Layout
thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'thim_layout_content_page',
		'label'    => esc_html__( 'Single Course Layout', 'eduma' ),
		'default'  => 'normal',
		'section'  => 'course_single',
		'priority' => 11,
		'choices'  => array(
			'normal'         => esc_html__( 'Default', 'eduma' ),
			'new-1'          => esc_html__( 'Layout 1 - New Demo', 'eduma' ),
			'layout_style_2' => esc_html__( 'Layout 2', 'eduma' ),
			'layout_style_3' => esc_html__( 'Layout 3', 'eduma' ),
		),
		'active_callback' => array($callback_single),
	)
);

thim_customizer()->add_field(
	array(
		'type'      => 'multicolor',
		'id'        => 'top_info_course',
		'label'     => esc_html__( 'Top infor Course Colors', 'thim-startertheme' ),
		'section'   => 'course_single',
		'priority'  => 11,
		'choices'   => array(
			'background_color' => esc_html__( 'Background Color', 'thim-startertheme' ),
			'text_color'       => esc_html__( 'Text Color', 'thim-startertheme' ),
		),
		'default'   => array(
			'background_color' => '#273044',
			'text_color'       => '#fff',
 		),
		'transport' => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'thim_layout_content_page',
				'operator' => '==',
				'value'    =>  'layout_style_3',
			),
			$callback_single),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_learnpress_single_layout',
		'type'     => 'radio-image',
		'label'    => esc_html__( 'Layout', 'eduma' ),
		'tooltip'  => esc_html__( 'Allows you to choose a layout to display for all single course pages.', 'eduma' ),
		'section'  => 'course_single',
		'priority' => 12,
		'default'  => 'sidebar-right',
		'choices'  => array(
			'sidebar-left'  => THIM_URI . 'images/layout/sidebar-left.jpg',
			'full-content'  => THIM_URI . 'images/layout/body-full.jpg',
			'sidebar-right' => THIM_URI . 'images/layout/sidebar-right.jpg',
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_layout_content_page',
				'operator' => 'in',
				'value'    => array('normal','layout_style_2'),
			),
			$callback_single),
	)
);

// Enable or disable breadcrumbs
thim_customizer()->add_field(
	array(
		'id'       => 'thim_learnpress_single_hide_breadcrumbs',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hide Breadcrumbs?', 'eduma' ),
		'tooltip'  => esc_html__( 'Check this box to hide/show breadcrumbs.', 'eduma' ),
		'section'  => 'course_single',
		'default'  => false,
		'priority' => 15,
		'active_callback' => array($callback_single),
		'choices'  => array(
			true  => esc_html__( 'On', 'eduma' ),
			false => esc_html__( 'Off', 'eduma' ),
		),
	)
);

// Enable or disable title
thim_customizer()->add_field(
	array(
		'id'       => 'thim_learnpress_single_hide_title',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hide Title', 'eduma' ),
		'tooltip'  => esc_html__( 'Check this box to hide/show title.', 'eduma' ),
		'section'  => 'course_single',
		'default'  => false,
		'priority' => 18,
		'choices'  => array(
			true  => esc_html__( 'On', 'eduma' ),
			false => esc_html__( 'Off', 'eduma' ),
		),
		'active_callback' => array($callback_single),
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'text',
		'id'       => 'thim_learnpress_single_sub_title',
		'label'    => esc_html__( 'Sub Heading', 'eduma' ),
		'tooltip'  => esc_html__( 'Allows you can setup sub heading.', 'eduma' ),
		'section'  => 'course_single',
		'priority' => 20,
		'active_callback' => array($callback_single),
	)
);

thim_customizer()->add_field(
	array(
		'type'      => 'image',
		'id'        => 'thim_learnpress_single_top_image',
		'label'     => esc_html__( 'Top Image', 'eduma' ),
		'priority'  => 30,
		'transport' => 'postMessage',
		'section'   => 'course_single',
		'default'   => THIM_URI . "images/bg-page.jpg",
		'active_callback' => array($callback_single),
	)
);

// Page Title Background Color
thim_customizer()->add_field(
	array(
		'id'        => 'thim_learnpress_single_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background Color', 'eduma' ),
		'tooltip'   => esc_html__( 'If you do not use background image, then can use background color for page title on heading top. ', 'eduma' ),
		'section'   => 'course_single',
		'default'   => 'rgba(0,0,0,0.5)',
		'priority'  => 35,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'active_callback' => array($callback_single),
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main>.overlay-top-header',
				'property' => 'background',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_learnpress_single_title_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Title Color', 'eduma' ),
		'tooltip'   => esc_html__( 'Allows you can select a color make text color for title.', 'eduma' ),
		'section'   => 'course_single',
		'default'   => '#ffffff',
		'priority'  => 40,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'active_callback' => array($callback_single),
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main h1, .top_site_main h2',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_learnpress_single_sub_title_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Sub Title Color', 'eduma' ),
		'tooltip'   => esc_html__( 'Allows you can select a color make sub title color page title.', 'eduma' ),
		'section'   => 'course_single',
		'default'   => '#999',
		'priority'  => 45,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'active_callback' => array($callback_single),
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main .banner-description',
				'property' => 'color',
			)
		)
	)
);

if ( class_exists( 'LP_Addon_Announcements_Preload' ) ) {
	$course_tabs = apply_filters( 'thim_customize_course_tabs', array(
		'description'   => esc_html__( 'Description', 'eduma' ),
		'curriculum'    => esc_html__( 'Curriculum', 'eduma' ),
		'instructor'    => esc_html__( 'Instructors', 'eduma' ),
		'announcements' => esc_html__( 'Announcements', 'eduma' ),
		'students-list' => esc_html__( 'Student list', 'eduma' ),
		'review'        => esc_html__( 'Reviews', 'eduma' ),
	) );
} else {
	$course_tabs = apply_filters( 'thim_customize_course_tabs', array(
		'description'   => esc_html__( 'Description', 'eduma' ),
		'curriculum'    => esc_html__( 'Curriculum', 'eduma' ),
		'instructor'    => esc_html__( 'Instructors', 'eduma' ),
		'students-list' => esc_html__( 'Student list', 'eduma' ),
		'review'        => esc_html__( 'Reviews', 'eduma' ),
	) );
}
// Tab Course
thim_customizer()->add_field(
	array(
		'id'       => 'group_tabs_course',
		'type'     => 'sortable',
		'label'    => esc_html__( 'Sortable Tab Course', 'eduma' ),
		'tooltip'  => esc_html__( 'Click on eye icons to show or hide buttons. Use drag and drop to change the position of tabs...', 'eduma' ),
		'section'  => 'course_single',
		'active_callback' => array($callback_single),
		'priority' => 50,
		'choices'  => $course_tabs,
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'default_tab_course',
		'type'     => 'select',
		'label'    => esc_html__( 'Select Tab Default', 'eduma' ),
		'tooltip'  => esc_html__( 'Select tab you want set to default', 'eduma' ),
		'section'  => 'course_single',
		'priority' => 50,
		'active_callback' => array($callback_single),
		'choices'  => $course_tabs,
		'default'  => 'description',
	)
);
