<?php
/**
 * Plugin Name: Quote to Image
 * Description: Adds a button after each quote to convert the quote to an image and display it in a popup.
 * Version: 1.0
 * Author: Masum Billah
 */

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('QuoteToImage')) {
    class QuoteToImage {
        public function __construct() {
            add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
            add_filter('the_content', [$this, 'add_quote_button']);
        }

        public function enqueue_scripts() {
            wp_enqueue_script('html2canvas', 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js', [], null, true);
            wp_enqueue_script('quote-to-image-script', plugin_dir_url(__FILE__) . 'js/custom-script.js', ['jquery', 'html2canvas'], null, true);
            wp_enqueue_style('quote-to-image-style', plugin_dir_url(__FILE__) . 'css/custom-style.css');
        }

        public function add_quote_button($content) {
            if (is_single()) {
                $button_html = '<button class="convert-to-image">Convert to Image</button>';
                $pattern = '/(<blockquote[^>]*>.*?<\/blockquote>)/is';
                $replacement = '$1' . $button_html;
                $content = preg_replace($pattern, $replacement, $content);
            }
            return $content;
        }
    }

    new QuoteToImage();
}
