<?php
/**
 * Plugin Name:       BuildByHS Read Time Indicator Everywhere
 * Plugin URI:        https://github.com/humayun-sarfraz/buildbyhs-read-time-indicator-everywhere
 * Description:       Calculates and displays an estimated reading time at the top of every post, page, or widget.
 * Version:           1.0
 * Author:            Humayun Sarfraz
 * Author URI:        https://github.com/humayun-sarfraz
 * Text Domain:       read-time-indicator-everywhere
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load textdomain for translations
if ( ! function_exists( 'rtie_load_textdomain' ) ) {
    function rtie_load_textdomain() {
        load_plugin_textdomain(
            'read-time-indicator-everywhere',
            false,
            dirname( plugin_basename( __FILE__ ) ) . '/languages'
        );
    }
    add_action( 'plugins_loaded', 'rtie_load_textdomain' );
}

// Calculate read time and prepend to content
if ( ! function_exists( 'rtie_calculate_read_time' ) ) {
    function rtie_calculate_read_time( $content ) {
        if ( is_admin() ) {
            return $content;
        }
        $text = wp_strip_all_tags( $content );
        $word_count = str_word_count( $text );
        $wpm = apply_filters( 'rtie_words_per_minute', 200 );
        $minutes = max( 1, ceil( $word_count / intval( $wpm ) ) );

        /* translators: %d: estimated minutes */
        $label = sprintf( esc_html__( '%d min read', 'read-time-indicator-everywhere' ), $minutes );
        $html  = '<span class="rtie-read-time">' . esc_html( $label ) . '</span>';

        return $html . wp_kses_post( $content );
    }
}
add_filter( 'the_content', 'rtie_calculate_read_time', 5 );
add_filter( 'widget_text', 'rtie_calculate_read_time', 5 );

// Inline CSS for styling the read-time indicator
if ( ! function_exists( 'rtie_inline_styles' ) ) {
    function rtie_inline_styles() {
        echo '<style>
            .rtie-read-time {
                display: block;
                font-size: 0.9rem;
                color: #555;
                margin-bottom: 0.5em;
            }
        </style>';
    }
}
add_action( 'wp_head', 'rtie_inline_styles' );
