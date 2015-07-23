<?php 

/*
Plugin Name: Date Filter for WP Job Manager
Plugin URI: http://www.kadimi.com/
Description: -
Version: 1.0.0
Author: Nabil Kadimi
Author URI: http://kadimi.com
License: GPL2
*/

add_action( 'job_manager_job_filters_search_jobs_end', 'wpjobmanager_date_filter_fields' );

/**
 * Outputs 'from' and 'to' fields HTML
 */
function wpjobmanager_date_filter_fields () {
	?><div class="search_date" style="margin-top: 20px">
		<div class="search_date_from_wrapper" style="float: left; padding-right: 0.5em; width: 50%;">
			<label for="search_date_from">Date from</label>
			<input type="text" name="search_date_from" id="search_date_from" placeholder="dd/mm/yyyy" />
		</div>
		<div class="search_date_to_wrapper" style="float: right; padding-left: 0.5em; width: 50%;">
			<label for="search_keywords">Date to</label>
			<input type="text" name="search_date_to" id="search_date_to" placeholder="dd/mm/yyyy" />
		</div>
	</div><?php
}
