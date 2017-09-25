<?php
/**
 * dart-theme Theme Customizer
 *
 * @package dart-theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function dart_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'dart_theme_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'dart_theme_customize_partial_blogdescription',
		) );
	}

	// Text color customization
	$wp_customize->add_setting( 'text_color' , array(
	    'default' => '#00000'
	) );

	$wp_customize->add_control( 'text_color', array(
		'settings'	=> 'text_color',
		'label'		=> __('Text Color', 'dart-theme'),
		'section'	=> 'colors',
		'type'		=> 'color'
	) );
}
add_action( 'customize_register', 'dart_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function dart_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function dart_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dart_theme_customize_preview_js() {
	wp_enqueue_script( 'dart-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'dart_theme_customize_preview_js' );

/**
 * Output custom CSS to header
 */
function customize_header_css() {
	?>
		<style type="text/css">
			body { color: <?php echo get_theme_mod( 'text_color' ); ?>; }
		</style>
	<?php
}
add_action( 'wp_head', 'customize_header_css');