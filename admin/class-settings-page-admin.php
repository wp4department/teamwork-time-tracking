<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Settings_Page
 * @subpackage Settings_Page/admin
 */
class Settings_Page_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = 'rdd-care-plan';
		$this->version = $version;
		add_action('admin_menu', array( $this, 'addPluginAdminMenu' ), 9);   

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/settings-page-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/settings-page-admin.js', array( 'jquery' ), $this->version, false );

	}
	public function addPluginAdminMenu() {
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		add_menu_page(  'RDD Care Plan', 'RDD Care Plan', 'administrator', $this->plugin_name, array( $this, 'displayPluginAdminDashboard' ), 'https://mainwp.raneydaydesign.com/wp-content/uploads/2020/07/cropped-Umbrella_Pink-32x32.png', 26 );
	}
	public function displayPluginAdminDashboard() {
		require_once 'partials/'.$this->plugin_name.'-dashboard.php';
  }
	public function displayPluginAdminSettings() {
		// set this var to be used in the settings-display view
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
		if(isset($_GET['error_message'])){
				add_action('admin_notices', array($this,'settingsPageSettingsMessages'));
				do_action( 'admin_notices', $_GET['error_message'] );
		}
		require_once 'partials/'.$this->plugin_name.'-settings.php';
	}
	public function settingsPageSettingsMessages($error_message){
		switch ($error_message) {
				case '1':
						$message = __( 'There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'rdd-care-plan' );                 
						$err_code = esc_attr( 'settings_page_example_setting' );                 
						$setting_field = 'settings_page_example_setting';                 
						break;
		}
		$type = 'error';
		add_settings_error(
					$setting_field,
					$err_code,
					$message,
					$type
			);
	}

	

}

class RDDCarePlanSettings {
	private $rdd_care_plan_settings_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'rdd_care_plan_settings_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'rdd_care_plan_settings_page_init' ) );
	}

	public function rdd_care_plan_settings_add_plugin_page() {
		add_submenu_page( 'rdd-care-plan', 'RDD Care Plan Settings', 'Settings', 'manage_options', 'rdd-care-plan-settings', array( $this, 'rdd_care_plan_settings_create_admin_page' ) );
	}

	public function rdd_care_plan_settings_create_admin_page() {
		$this->rdd_care_plan_settings_options = get_option( 'rdd_care_plan_settings' ); ?>

		<div class="wrap">
			<?php  $client_project_id = $this->rdd_care_plan_settings_options['client_project_id'];
				print_r($client_project_id);
			 ?>
			<h2>RDD Care Plan Settings</h2>
			<p>Option Page For Dashboard</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'rdd_care_plan_settings_option_group' );
					do_settings_sections( 'rdd-care-plan-settings-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function rdd_care_plan_settings_page_init() {
		register_setting(
			'rdd_care_plan_settings_option_group', // option_group
			'rdd_care_plan_settings', // option_name
			array( $this, 'rdd_care_plan_settings_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'rdd_care_plan_settings_setting_section', // id
			'Settings', // title
			array( $this, 'rdd_care_plan_settings_section_info' ), // callback
			'rdd-care-plan-settings-admin' // page
		);

		add_settings_field(
			'client_project_id', // id
			'Client Project ID', // title
			array( $this, 'client_project_id_callback' ), // callback
			'rdd-care-plan-settings-admin', // page
			'rdd_care_plan_settings_setting_section' // section
		);

		add_settings_field(
			'website_care_plans', // id
			'Website Care Plans', // title
			array( $this, 'website_care_plans_callback' ), // callback
			'rdd-care-plan-settings-admin', // page
			'rdd_care_plan_settings_setting_section' // section
		);

		add_settings_field(
			'google_drive_link', // id
			'Google Drive Link', // title
			array( $this, 'google_drive_link_callback' ), // callback
			'rdd-care-plan-settings-admin', // page
			'rdd_care_plan_settings_setting_section' // section
		);

		add_settings_field(
			'email_support', // id
			'Email Support', // title
			array( $this, 'email_support_callback' ), // callback
			'rdd-care-plan-settings-admin', // page
			'rdd_care_plan_settings_setting_section' // section
		);

		add_settings_field(
			'additional_info', // id
			'Additional Info', // title
			array( $this, 'additional_info_callback' ), // callback
			'rdd-care-plan-settings-admin', // page
			'rdd_care_plan_settings_setting_section' // section
		);
	}

	public function rdd_care_plan_settings_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['client_project_id'] ) ) {
			$sanitary_values['client_project_id'] = sanitize_text_field( $input['client_project_id'] );
		}

		if ( isset( $input['website_care_plans'] ) ) {
			$sanitary_values['website_care_plans'] = $input['website_care_plans'];
		}

		if ( isset( $input['google_drive_link'] ) ) {
			$sanitary_values['google_drive_link'] = sanitize_text_field( $input['google_drive_link'] );
		}

		if ( isset( $input['email_support'] ) ) {
			$sanitary_values['email_support'] = sanitize_text_field( $input['email_support'] );
		}

		if ( isset( $input['additional_info'] ) ) {
			$sanitary_values['additional_info'] = esc_textarea( $input['additional_info'] );
		}

		return $sanitary_values;
	}

	public function rdd_care_plan_settings_section_info() {
		
	}

	public function client_project_id_callback() {
		printf(
			'<input class="regular-text" type="text" name="rdd_care_plan_settings[client_project_id]" id="client_project_id" value="%s">',
			isset( $this->rdd_care_plan_settings_options['client_project_id'] ) ? esc_attr( $this->rdd_care_plan_settings_options['client_project_id']) : ''
		);
	}

	public function website_care_plans_callback() {
		?> 
		<select name="rdd_care_plan_settings[website_care_plans]" id="website_care_plans">
		<?php 
		$selected = (isset( $this->rdd_care_plan_settings_options['website_care_plans'] ) && $this->rdd_care_plan_settings_options['website_care_plans'] === 'Silver Care Plan') ? 'selected' : '' ; 
		?>
		<option <?php echo $selected; ?>>Silver Care Plan</option>
			<?php $selected = (isset( $this->rdd_care_plan_settings_options['website_care_plans'] ) && $this->rdd_care_plan_settings_options['website_care_plans'] === 'Gold Care Plan') ? 'selected' : '' ; ?>
		<option <?php echo $selected; ?>>Gold Care Plan</option>
			<?php $selected = (isset( $this->rdd_care_plan_settings_options['website_care_plans'] ) && $this->rdd_care_plan_settings_options['website_care_plans'] === 'Platinum Care Plan') ? 'selected' : '' ; ?>
		<option <?php echo $selected; ?>>Platinum Care Plan</option>			
		<?php $selected = (isset( $this->rdd_care_plan_settings_options['website_care_plans'] ) && $this->rdd_care_plan_settings_options['website_care_plans'] === 'No Care Plan') ? 'selected' : '' ; ?>
		<option <?php echo $selected; ?>>No Care Plan</option>

		</select> <?php
	}

	public function google_drive_link_callback() {
		printf(
			'<input class="regular-text" type="text" name="rdd_care_plan_settings[google_drive_link]" id="google_drive_link" value="%s">',
			isset( $this->rdd_care_plan_settings_options['google_drive_link'] ) ? esc_attr( $this->rdd_care_plan_settings_options['google_drive_link']) : ''
		);
	}

	public function email_support_callback() {
		printf(
			'<input class="regular-text" type="text" name="rdd_care_plan_settings[email_support]" id="email_support" value="%s">',
			isset( $this->rdd_care_plan_settings_options['email_support'] ) ? esc_attr( $this->rdd_care_plan_settings_options['email_support']) : ''
		);
	}

	public function additional_info_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="rdd_care_plan_settings[additional_info]" id="additional_info">%s</textarea>',
			isset( $this->rdd_care_plan_settings_options['additional_info'] ) ? esc_attr( $this->rdd_care_plan_settings_options['additional_info']) : ''
		);
	}

}
if ( is_admin() )
	$rdd_care_plan_settings = new RDDCarePlanSettings();


 // $rdd_care_plan_settings_options = get_option( 'rdd_care_plan_settings' ); // Array of All Options
/* 
 * Retrieve this value with:
 * $client_project_id = $rdd_care_plan_settings_options['client_project_id']; // Client Project ID
 * $website_care_plans = $rdd_care_plan_settings_options['website_care_plans']; // Website Care Plans
 * $google_drive_link = $rdd_care_plan_settings_options['google_drive_link']; // Google Drive Link
 * $email_support = $rdd_care_plan_settings_options['email_support']; // Email Support
 * $additional_info = $rdd_care_plan_settings_options['additional_info']; // Additional Info
 */