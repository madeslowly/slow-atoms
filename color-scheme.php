<?php

// https://deluxeblogtips.com/add-color-schemes-wordpress-theme/

class slow_atoms_Color_Scheme {
    public function __construct() {    
        add_action( 'customize_register', array( $this, 'customizer_register' ) );
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_js' ) );
        add_action( 'customize_controls_print_footer_scripts', array( $this, 'color_scheme_template' ) );
        // TODO: do we need this add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'output_css' ) );
    }

    public function customizer_register( WP_Customize_Manager $wp_customize ) {}
    
    public function customize_js() {
        wp_enqueue_script( 'slow-atoms-color-scheme', get_template_directory_uri() . '/inc/js/color-scheme.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '', true );
        wp_localize_script( 'slow-atoms-color-scheme', 'SlowAtomsColorScheme', $this->get_color_schemes() );
     
    }
    public function color_scheme_template() {
        $colors = array(
            'slow_atoms_primary_theme_color'    => '{{ data.slow_atoms_primary_theme_color }}',
            'slow_atoms_secondary_theme_color'  => '{{ data.slow_atoms_secondary_theme_color }}',
            'slow_atoms_navbar_link_color'      => '{{ data.slow_atoms_navbar_link_color }}',
            'slow_atoms_accent_color'           => '{{ data.slow_atoms_accent_color }}',
            'footer_bg_color'                   => '{{ data.footer_bg_color }}',
            'highlight_color'                   => '{{ data.highlight_color }}',
        );
        ?>
        <script type="text/html" id="tmpl-slow-atoms-color-scheme">
            <?php echo $this->get_css( $colors ); ?>
        </script>
    <?php
    }
    public function customize_preview_js() {
        // TODO: do we need this wp_enqueue_script( 'slow-atoms-color-scheme-preview', get_template_directory_uri() . '/inc/js/color-scheme-preview.js', array( 'customize-preview' ), '', true );

    }
    public function output_css() {
        $colors = $this->get_color_scheme();
        if ( $this->is_custom ) {
            wp_add_inline_style( 'slow-atoms-style', $this->get_css( $colors ) );
        }
    }
    
    public $options = array(
        'slow_atoms_primary_theme_color',
        'slow_atoms_secondary_theme_color',
        'slow_atoms_navbar_link_color',
        'slow_atoms_accent_color',
        'footer_bg_color',
        'highlight_color',
    );

    public function get_color_schemes() {
        return array(
            'default' => array(
                'label'  => __( 'Classic', 'slow_atoms' ),
                'colors' => array(
                    '#333342',
                    '#003882',
                    '#ffffff',
                    '#ff00ee',
                    '#222b30',
                    '#e67e22',
                ),
            ),
            'green'    => array(
                'label'  => __( 'Green', 'slow_atoms' ),
                'colors' => array(
                    '#334c32',
                    '#845a50',
                    '#ffffff',
                    '#22e500',
                    '#9d5f00',
                    '#dd8500',
                ),
            ),
            'orange'    => array(
                'label'  => __( 'Orange', 'slow_atoms' ),
                'colors' => array(
                    '#dd8500',
                    '#845a50',
                    '#ffffff',
                    '#890024',
                    '#9d5f00',
                    '#dd8500',
                ),
            ),
            'red'    => array(
                'label'  => __( 'Red', 'slow_atoms' ),
                'colors' => array(
                    '#7f2a2a',
                    '#000033',
                    '#ffffff',
                    '#ff0044',
                    '#9d5f00',
                    '#dd8500',
                ),
            ),
            // Other color schemes
        );
    }

    public $is_custom = false;

    public function get_color_scheme() {
        $color_schemes = $this->get_color_schemes();
        $color_scheme  = get_theme_mod( 'color_scheme' );
        $color_scheme  = isset( $color_schemes[$color_scheme] ) ? $color_scheme : 'default';
    
        if ( 'default' != $color_scheme ) {
            $this->is_custom = true;
        }
    
        $colors = array_map( 'strtolower', $color_schemes[$color_scheme]['colors'] );
    
        foreach ( $this->options as $k => $option ) {
            $color = get_theme_mod( $option );
            if ( $color && strtolower( $color ) != $colors[$k] ) {
                $colors[$k] = $color;
                $this->is_custom = true;
            }
        }
        return $colors;
        //var_dump($colors);
    }


    public function get_css( $colors ) {
        $css = "
        a { color: }
        
        button, input[type=submit], .button {
            background: %2$s;
        }
        .section h2 span,
        .number {
            color: %6$s;
        }
        .section--dark,
        .services-1 {
            background-color: %4$s;
        }
        .footer {
            background: %5$s;
        }";
        // More CSS
        return vsprintf( $css, $colors );
    }


    
}

