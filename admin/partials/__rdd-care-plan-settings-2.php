<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       plugin_name.com/team
 * @since      1.0.0
 *
 * @package    PluginName
 * @subpackage PluginName/admin/partials
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
		        <div id="icon-themes" class="icon32"></div>  
		        <h2>RDD Care Plan Settings</h2>  
		         <!--NEED THE settings_errors below so that the errors/success messages are shown after submission - wasn't working once we started using add_menu_page and stopped using add_options_page so needed this-->
				<?php settings_errors(); ?>  
		        <form method="POST" action="options.php">  
<!-- 		            <?php 
		                settings_fields( 'settings_page_general_settings' );
		                do_settings_sections( 'settings_page_general_settings' ); 

		            ?>   -->
		            <table class="form-table">
		            <tr valign="top">
		            	<th scope="row">Client Project ID: </th>
	    				<td>
	    				<input type="text" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				</td>
    				</tr>		           
    				<tr valign="top">
		            	<th scope="row">Plan: </th>
	    				<td>
	    					<select name="cars" id="cars">
  <option value="volvo">Silver</option>
  <option value="saab">Gold</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select>
	    				</td>
    				</tr>		           
    				 <tr valign="top">
		            	<th scope="row">Google Drive Link	</th>
	    				<td>
	    				<input type="text" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				</td>
    				</tr>    				 
    				<tr valign="top">
		            	<th scope="row">Your Care Plan includes:</th>
	    				<td>
	    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Software Core Upgrades</label><br>
	    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Software Plugin Upgrades</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Woocommerce Updates & Support
</label><br>
	    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Manage Spam</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Weekly Website Backups w/ Restore (Daily for Gold and Platinum)
</label><br>
	    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Optimize Google Analytics Reporting</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Enterprise Grade Network Security</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Site Optimization</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Cancel Anytime, No Long term contracts</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Software Core Upgrades</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Uptime Monitoring & Performance Scans</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Training Video Updates</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Monthly Maintenance Report</label><br>
	    					    				<input type="checkbox" name="extra_post_info" value="<?php echo get_option( 'extra_post_info' ); ?>"/>
	    				<label>Access to Quarterly Webinars</label><br>

	    				</td>
    				</tr>
    		</table>           
		            <?php submit_button(); ?>  
		        </form> 
</div>