<?php

if ( ! function_exists( 'ohio_setup' ) ) :

	function ohio_setup() {
		load_theme_textdomain( 'ohio', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );
		set_post_thumbnail_size( 200, 200, true );

        add_image_size( 'ohio_thumbnail_next_and_prev', 200, 140, true );

		add_image_size( 'ohio_full', 1920, 9999, false );

		add_image_size( 'ohio-shop-cropped', 500, 500, true );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'ohio' ),
		) );

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote' ) );

		$GLOBALS['content_width'] = apply_filters( 'ohio_content_width', 640 );

		$GLOBALS['ohio_google_fonts'] = array();
		$GLOBALS['ohio_icon_fonts'] = array();
		$GLOBALS['ohio_required_scripts'] = array();

		if ( ! get_option( 'ohio_version' ) || get_option( 'ohio_version' ) < 10 ) {
			add_option( 'ohio_version', 10, '', 'yes' );
		}

        // Adding support for core block visual styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for custom color scheme.
        // add_theme_support( 'disable-custom-colors' );

        // Fallback
        add_theme_support( 'editor-color-palette', array(
            array(
                'name'  => esc_html__( 'Brand color', 'ohio' ),
                'slug'  => 'brand-color',
                'color' => '#D90A2C',
            ),
            array(
                'name'  => esc_html__( 'Beige Dark', 'ohio' ),
                'slug'  => 'beige_dark',
                'color' => '#A1824F',
            ),
            array(
                'name'  => esc_html__( 'Dark Strong', 'ohio' ),
                'slug'  => 'dark_strong',
                'color' => '#24262B',
            ),
            array(
                'name'  => esc_html__( 'Dark Light', 'ohio' ),
                'slug'  => 'dark_light',
                'color' => '#32353C',
            ),
            array(
                'name'  => esc_html__( 'Grey Strong', 'ohio' ),
                'slug'  => 'grey_strong',
                'color' => '#838998',
            ),
        ) );

        // Add support for custom sizes
        // add_theme_support('disable-custom-font-sizes');
        add_theme_support( 'editor-font-sizes', array(
            array(
                'name' => esc_html__( 'Extra Small', 'ohio' ),
                'size' => 13,
                'slug' => 'extra-small'
            ),
            array(
                'name' => esc_html__( 'Small', 'ohio' ),
                'size' => 14,
                'slug' => 'small'
            ),
            array(
                'name' => esc_html__( 'Normal', 'ohio' ),
                'size' => 15,
                'slug' => 'normal'
            ),
            array(
                'name' => esc_html__( 'Large', 'ohio' ),
                'size' => 17,
                'slug' => 'large'
            ),
            array(
                'name' => esc_html__( 'Extra Large', 'ohio' ),
                'size' => 20,
                'slug' => 'larger'
            )
        ) );

        // Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

        // Add editor styles support
        add_editor_style( 'assets/style_editor/style-editor.css' );
		add_theme_support('editor-styles');

        remove_action('wp_head', 'rest_output_link_wp_head', 10);
	}

endif;

add_action( 'after_setup_theme', 'ohio_setup' );

function ohio_additional_setup() {
    $brand_color = OhioOptions::get_global( 'page_brand_color', '#D90A2C' );

    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => esc_html__( 'Brand color', 'ohio' ),
            'slug'  => 'brand-color',
            'color' => $brand_color,
        ),
        array(
            'name'  => esc_html__( 'Beige Dark', 'ohio' ),
            'slug'  => 'beige_dark',
            'color' => '#A1824F',
        ),
        array(
            'name'  => esc_html__( 'Dark Strong', 'ohio' ),
            'slug'  => 'dark_strong',
            'color' => '#24262B',
        ),
        array(
            'name'  => esc_html__( 'Dark Light', 'ohio' ),
            'slug'  => 'dark_light',
            'color' => '#32353C',
        ),
        array(
            'name'  => esc_html__( 'Grey Strong', 'ohio' ),
            'slug'  => 'grey_strong',
            'color' => '#838998',
        ),
    ) );
}

add_action( 'acf/init', 'ohio_additional_setup', 11 );

function ohio_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}

add_action( 'wp_head', 'ohio_pingback_header' );

function ohio_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
}

add_action( 'elementor/theme/register_locations', 'ohio_register_elementor_locations' );

function ohio_elementor_canvas_before_content() {
    get_template_part( 'parts/elements/preloader' );
    get_template_part( 'parts/headers/elements-bar' );
    get_template_part( 'parts/elements/custom_cursor');
}

add_action( 'elementor/page_templates/canvas/before_content', 'ohio_elementor_canvas_before_content' );

function ohio_elementor_canvas_after_content() {
    get_template_part( 'parts/elements/popup' );
    get_template_part( 'parts/elements/notification' );
    OhioLayout::get_footer_buffer_content( true );
    OhioHelper::calculate_custom_fonts_inline();
    OhioLayout::show_shortcodes_inline_css();
}

add_action( 'elementor/page_templates/canvas/after_content', 'ohio_elementor_canvas_after_content');

function add_custom_section_controls( $element ) {

	$element->start_controls_section(
		'background_lines',
		[
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			'label' => __( 'Background Lines', 'ohio' ),
		]
	);

	$element->add_control(
		'background_lines_enabled',
		[
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label' => __( 'Enable decoration lines?', 'ohio' ),
		]
	);

    $element->add_control(
        'background_lines_style',
        [
            'label' => __( 'Decoration lines style', 'ohio' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'light',
            'options' => [
                'light' => __( 'Light', 'ohio' ),
                'dark' => __( 'Dark', 'ohio' ),
            ],
            'condition' => [
                'background_lines_enabled' => 'yes'
            ]
        ]
    );

	$element->end_controls_section();

    $element->start_controls_section(
        'side_title',
        [
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'label' => __( 'Side Title', 'ohio' )
        ]
    );

    $element->add_control(
        'side_title_text',
        [
            'label' => __( 'Side Title', 'ohio' ),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]
    );

    $element->add_control(
        'side_title_position',
        [
            'label' => __( 'Side title position', 'ohio' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'left',
            'options' => [
                'left' => __( 'Left', 'ohio' ),
                'right' => __( 'Right', 'ohio' ),
            ],
            'condition' => [
                'side_title_text!' => ''
            ]
        ]
    );

    $element->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'side_title_typography',
            'label' => __( 'Side title typography', 'ohio' ),
            'selector' => '{{WRAPPER}} .row-bg-text',
            'condition' => [
                'side_title_text!' => ''
            ]
        ]
    );

    $element->end_controls_section();
}

add_action( 'elementor/element/section/section_typo/after_section_end', 'add_custom_section_controls', 10, 2 );
add_action( 'elementor/element/container/section_shape_divider/after_section_end', 'add_custom_section_controls', 10, 2 );

function custom_section_HTML_attributes( $element ) {
    $settings = $element->get_settings();
    
    if ( 'yes' === $settings['background_lines_enabled']) {
        $element->add_render_attribute( '_wrapper', [ 'ohio-background-lines' => $settings['background_lines_style'] ] );
    }
    
    if ( !empty( $settings['side_title_text'] ) ) {
        $element->add_render_attribute( '_wrapper', ['ohio-side-title-text' => $settings['side_title_text']] );
        $element->add_render_attribute( '_wrapper', ['ohio-side-title-position' => $settings['side_title_position']] );
    }
}

add_action( 'elementor/frontend/section/before_render', 'custom_section_HTML_attributes' );
add_action( 'elementor/frontend/container/before_render', 'custom_section_HTML_attributes' );
