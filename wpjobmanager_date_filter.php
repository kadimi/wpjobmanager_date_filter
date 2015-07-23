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
add_filter( 'job_manager_get_listings', 'filter_by_date_query_args', 10, 2 );

/**
 * Outputs 'from' and 'to' fields HTML
 */
function wpjobmanager_date_filter_fields () {
	?><div class="search_date" style="margin-top: 20px">
		<div class="search_date_from_wrapper" style="float: left; padding-right: 0.5em; width: 50%;">
			<label for="search_date_from">Date from</label>
			<input type="text" name="search_date_from" id="search_date_from" placeholder="mm/dd/yyyy" />
		</div>
		<div class="search_date_to_wrapper" style="float: right; padding-left: 0.5em; width: 50%;">
			<label for="search_date_to">Date to</label>
			<input type="text" name="search_date_to" id="search_date_to" placeholder="mm/dd/yyyy" />
		</div>
	</div>

	<script>
		jQuery( document ).ready( function( $ ) {

			$( '#search_date_from,#search_date_to' )
				.change( function() { $('#search_keywords').change(); } )
				.keyup( function( e ) {
					13 === e.which && $(this).trigger("change")
				} )
			;
		} );
	</script>

	<?php
}

/**
 * Adds date_query to $query_args
 */
function filter_by_date_query_args( $query_args, $args ) {
	if ( isset( $_POST['form_data'] ) ) {

		parse_str( $_POST['form_data'], $form_data );

		if ( ! empty( $form_data[ 'search_date_from' ] ) && trim( $form_data[ 'search_date_from' ] ) ) {

			preg_match( '/^(?<month>\d{1,2})\/(?<day>\d{1,2})\/(?<year>\d{4})$/'
				, $form_data[ 'search_date_from' ]
				, $date
			);

			if ( $date ) {

				$query_args[ 'date_query' ]['after'] = array(
					'month' => $date[ 'month' ],
					'day'   => $date[ 'day' ],
					'year'  => $date[ 'year' ],
				);
			}

			// Show the 'reset' link
			add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
		}

		if ( ! empty( $form_data[ 'search_date_to' ] ) && trim( $form_data[ 'search_date_to' ] ) ) {

			preg_match( '/^(?<month>\d{1,2})\/(?<day>\d{1,2})\/(?<year>\d{4})$/'
				, $form_data[ 'search_date_to' ]
				, $date
			);

			if ( $date ) {

				$query_args[ 'date_query' ]['after'] = array(
					'month' => $date[ 'month' ],
					'day'   => $date[ 'day' ],
					'year'  => $date[ 'year' ],
				);
			}

			// Show the 'reset' link
			add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
		}
	}
	return $query_args;
}