<?php
/*
Plugin Name: Twig Helpers
Plugin URI: https://github.com/luizbills/wp-twig-helpers
Description: Introduces helper functions to easy and fast theme development with Twig
Version: 2.0.0
Author: Luiz Bills
Author URI: https://luizpb.com/en
Text Domain: twig-helpers
Domain Path: /languages
License: GPL-3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
*/

if ( ! defined( 'WPINC' ) ) die();

if ( ! class_exists( 'Twig_Helpers' ) ) :

class Twig_Helpers {

	const VERSION = '2.0.0';
	const FILE = __FILE__;
	const DIR = __DIR__;
	const PREFIX = 'twig_helpers_';

	protected static $_instance = null;

	protected function __construct () {
		if ( ! defined( 'TIMBER_LOADED' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice' ] );
			return;
		}

		$this->includes();
	}

	protected function includes () {
		require_once __DIR__ . '/includes/functions.php';
		require_once __DIR__ . '/includes/shortcode.php';
	}

	public function admin_notice () {
		$message = sprintf(
			__( 'Please, install %s plugin.', 'wp-helpers' ),
			'<a target="_blank" href="https://wordpress.org/plugins/timber-library/">Timber</a>'
		); ?>
		<div class="notice notice-error is-dismissible">
			<p><?php echo $message; ?></p>
		</div>
		<?php
	}

	public static function get_instance () {
		if ( null === self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

function Twig_Helpers () {
	return Twig_Helpers::get_instance();
}

add_action( 'plugins_loaded', 'Twig_Helpers' );

endif;
