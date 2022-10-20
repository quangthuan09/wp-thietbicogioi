<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Easy Auto Reload
 * Plugin URI:        https://infinitumform.com
 * Description:       Auto refresh WordPress pages if there is no site activity after after any number of minutes.
 * Version:           1.0.5
 * Author:            Ivijan-Stefan Stipic
 * Author URI:        https://www.linkedin.com/in/ivijanstefanstipic/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       autorefresh
 * Domain Path:       /languages
 * Network:           true
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
 
// If someone try to called this file directly via URL, abort.
if ( ! defined( 'WPINC' ) ) { die( "Don't mess with us." ); }
if ( ! defined( 'ABSPATH' ) ) { exit; }

class WP_Auto_Refresh{
	/*
	 * Private cached class object
	 */
	private static $instance;
	private $options;
	
	/*
	 * Actions and filters
	 */
	private function __construct () {
		// Include textdomain and other plugin features
		add_action('plugins_loaded', [&$this, 'plugins_loaded'], 1, 0);
		// Add reload scripts to the site
		add_action('wp_head', [&$this, 'add_script'], 1, 0);
		if( $this->enable_in_admin() ) {
			add_action('admin_head', [&$this, 'add_script'], 1, 0);
		}
		// Admin functionalities
		add_action('admin_init', [&$this, 'admin_init'], 10, 0 );
		add_action('admin_menu', [&$this, 'admin_menu'], 10, 0);
		// Deactivation
		register_deactivation_hook(__FILE__, function(){
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}
			// Unload textdomain
			if ( is_textdomain_loaded( 'autorefresh' ) ) {
				unload_textdomain( 'autorefresh' );
			}
		});
	}
	
	/*
	 * load
	 */
	public function plugins_loaded(){
		if(!empty($this->options)) {
			$this->options = get_option('wp-autorefresh', array());
		}
		
		if ( !is_textdomain_loaded( 'autorefresh' ) ) {
			// Get locale
			$locale = apply_filters( 'cfgp_plugin_locale', get_locale(), 'autorefresh' );
			// We need standard file
			$mofile = sprintf( '%s-%s.mo', 'autorefresh', $locale );
			// Check first inside `/wp-content/languages/plugins`
			$domain_path = path_join( WP_LANG_DIR, 'plugins' );
			$loaded = load_textdomain( 'autorefresh', path_join( $domain_path, $mofile ) );
			// Or inside `/wp-content/languages`
			if ( ! $loaded ) {
				$loaded = load_textdomain( 'autorefresh', path_join( WP_LANG_DIR, $mofile ) );
			}
			// Or inside `/wp-content/plugin/cf-geoplugin/languages`
			if ( ! $loaded ) {
				$domain_path = __DIR__ . '/languages';
				$loaded = load_textdomain( 'autorefresh', path_join( $domain_path, $mofile ) );
				// Or load with only locale without prefix
				if ( ! $loaded ) {
					$loaded = load_textdomain( 'autorefresh', path_join( $domain_path, "{$locale}.mo" ) );
				}
				// Or old fashion way
				if ( ! $loaded && function_exists('load_plugin_textdomain') ) {
					load_plugin_textdomain( 'autorefresh', false, $domain_path );
				}
			}
		}
	}
	
	/*
	 * Initialize admin settings
	 */
	public function admin_init(){
		register_setting(
            'wp-autorefresh', // Option group
            'wp-autorefresh', // Option name
            [&$this, 'sanitize'] // Sanitize
        );

        add_settings_section(
            'wp-autorefresh', // ID
            esc_attr__('Auto-Refresh Settings','autorefresh'), // Title
            [&$this, 'print_section_info'], // Callback
            'wp-autorefresh' // Page
        );
		
		add_settings_field(
            'timeout', // ID
            esc_attr__('Auto-Refresh Timeout','autorefresh'), // Title 
            [&$this, 'input_timeout__callback'], // Callback
            'wp-autorefresh', // Page
            'wp-autorefresh' // Section           
        );
		
		add_settings_field(
            'clear_cache', // ID
            esc_attr__('Browser Cache','autorefresh'), // Title 
            [&$this, 'input_clear_cache__callback'], // Callback
            'wp-autorefresh', // Page
            'wp-autorefresh' // Section           
        );
		
		add_settings_field(
            'wp_admin', // ID
            esc_attr__('WP Admin','autorefresh'), // Title 
            [&$this, 'input_wp_admin__callback'], // Callback
            'wp-autorefresh', // Page
            'wp-autorefresh' // Section           
        );
	}
	
	/*
	 * Register admin menu pages
	 */
	public function admin_menu(){
		add_submenu_page(
			'options-general.php',
			esc_attr__('Auto-Refresh','autorefresh'),
			esc_attr__('Auto-Refresh','autorefresh'),
			'administrator',
			'wp-autorefresh',
			[&$this, 'options_page'],
			6
		);
	}
	
	 /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        
		if( isset( $input['timeout'] ) ) {
            $new_input['timeout'] = absint( $input['timeout'] );
		}
		
		if( isset( $input['clear_cache'] ) ) {
            $new_input['clear_cache'] = absint( $input['clear_cache'] );
		}
		
		if( isset( $input['wp_admin'] ) ) {
            $new_input['wp_admin'] = absint( $input['wp_admin'] );
		}

        return $new_input;
    }
	
	/*
	 * Create options page
	 */
	public function options_page(){
		if(!empty($this->options)) {
			$this->options = get_option('wp-autorefresh', array());
		}
        ?>
        <div class="wrap">
            <h1><?php _e('Auto-Refresh','autorefresh'); ?></h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'wp-autorefresh' );
                do_settings_sections( 'wp-autorefresh' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
	}
	
	/*
	 * Section
	 */
	public function print_section_info(){
		printf('<p>%s</p>', __('Automatically reloads web pages after any number of minutes if the user or visitor is not active on the site.','autorefresh'));
	}
	
	/*
	 * Timeout settings field
	 */
	public function input_timeout__callback(){
		printf(
            '<input type="number" min="1" step="1" id="timeout" name="wp-autorefresh[timeout]" value="%d" /><p class="description">%s</p>',
            $this->get_timeout(),
			__('Enter the number in minutes.','autorefresh')
        );
	}
	
	/*
	 * Clear Browser cahce
	 */
	public function input_clear_cache__callback(){
		printf(
            '<label for="clear_cache"><input type="checkbox" id="clear_cache" name="wp-autorefresh[clear_cache]" value="1"%s/>%s</label>',
            ($this->clear_cache() ? ' checked' : ''),
			__('Clear the browser cache during refresh.','autorefresh')
        );
	}
	
	/*
	 * Enable autoefresh inside WP Admin
	 */
	public function input_wp_admin__callback(){
		printf(
            '<label for="wp_admin"><input type="checkbox" id="wp_admin" name="wp-autorefresh[wp_admin]" value="1"%s/>%s</label>',
            ($this->enable_in_admin() ? ' checked' : ''),
			__('Enable autoefresh inside WP Admin.','autorefresh')
        );
	}
	
	/*
	 * Place JavaScript code inside `wp_head` to prevent brakeing by any other script.
	 * This must be placed inside document <head> area to working properly.
	 */
	public function add_script(){ ?>
	
<!-- <?php printf(__('Auto-reload WordPress pages after %d minutes if there is no site activity.','autorefresh'), $this->get_timeout()); ?> -->
<script>
/* <![CDATA[ */
(function(){		
	if(typeof wp == 'undefined'){
		var wp = {};
	}
	wp.autorefresh = {
		setTimeOutId : null,
		events : {'DOMContentLoaded':'document','keyup':'document','click':'document','past':'document','touchstart':'window','touchenter':'window','mousemove':'window','scroll':'window','scrollstart':'window'},
		callback : function(){
			if(wp.autorefresh.setTimeOutId){
				clearTimeout(wp.autorefresh.setTimeOutId);
			}
			wp.autorefresh.setTimeOutId = setTimeout(function(){
<?php if($this->clear_cache()) : ?>
				var head = document.getElementsByTagName('head')[0],
					script = document.createElement("script");
					
				script.src = "<?php echo rtrim(plugin_dir_url(__FILE__), '/') . '/assets/js/clear-browser-cache.js'; ?>";
				script.type = 'text/javascript';
				head.appendChild(script);
				head.insertBefore(script,head.childNodes[1]);
				script.onload = function(){
					if(typeof caches != 'undefined'){
						caches.keys().then((keyList) => Promise.all(keyList.map((key) => caches.delete(key))));
					}
				};
<?php endif; ?>
				location.reload();
			},(1e3*60*<?php echo $this->get_timeout(); ?>));
		}
	};
	
	for(event in wp.autorefresh.events){
		if(wp.autorefresh.events[event] == 'document'){
			document.addEventListener(event, wp.autorefresh.callback);
		} else if(wp.autorefresh.events[event] == 'window'){
			window.addEventListener(event, wp.autorefresh.callback);
		}
	}
}());
/* ]]> */
</script>
<noscript><meta http-equiv="refresh" content="<?php echo ($this->get_timeout()*60); ?>"></noscript>
	<?php }
	
	/*
	 * Get timeout option on the safe way
	 */
	private function get_timeout(int $default = 5){
		$wp_autorefresh = ( !empty($this->options) ? $this->options : get_option('wp-autorefresh', array()) );
		
		if(isset($wp_autorefresh['timeout']) && ($timeout=absint($wp_autorefresh['timeout']))){
			
			if( empty($timeout) || !is_numeric($timeout) ) {
				$timeout = $default;
			}
			
			if($timeout < 1) {
				$timeout = $default;
			}
			
			return absint($timeout);
		}
		
		return $default;
	}
	
	/*
	 * Is cache set for the clear
	 */
	private function clear_cache(){
		$wp_autorefresh = ( !empty($this->options) ? $this->options : get_option('wp-autorefresh', array()) );
		return (isset( $wp_autorefresh['clear_cache'] ) && $wp_autorefresh['clear_cache'] ? true : false);
	}
	
	/*
	 * Enable autoefresh inside WP Admin
	 */
	private function enable_in_admin(){
		$wp_autorefresh = ( !empty($this->options) ? $this->options : get_option('wp-autorefresh', array()) );
		return (isset( $wp_autorefresh['wp_admin'] ) && $wp_autorefresh['wp_admin'] ? true : false);
	}
	
	/*
	 * Instance
	 */
	public static function instance(){
		if(!self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}
}

/*
 * Run the plugin
 */
WP_Auto_Refresh::instance();