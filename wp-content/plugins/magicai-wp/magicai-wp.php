<?php
/**
 * Plugin Name: MagicAI for WordPress
 * Description: Powerful WordPress AI Tool.
 * Plugin URI: https://themeforest.net/user/liquidthemes
 * Version: 1.4
 * Author: Liquid Themes
 * Author URI: https://themeforest.net/user/liquidthemes
 * Text Domain: magicai-wp
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'MAGICAI_PATH', plugin_dir_path( __FILE__ ) );
define( 'MAGICAI_URL', plugin_dir_url( __FILE__ ) );
define( 'MAGICAI_VERSION', get_file_data( __FILE__, array('Version' => 'Version'), false)['Version'] );

require_once MAGICAI_PATH . 'includes/plugin.php';