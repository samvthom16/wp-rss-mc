<?php
  /*
  Plugin Name: RSS Connector For Mailchimp
  Plugin URI:
  Description: A plugin to output RSS feed that Mailchimp can use
  Version: 1.0
  Author: Samuel Thomas
  Author URI: https://sputznik.com
  */

  $inc_files = array(
		'class-base.php',
		'admin-ui/admin-ui.php',
    'API/API.php'
	);

	foreach( $inc_files as $inc_file ){
		require_once( $inc_file );
	}


  add_action('init', function(){

    add_feed('mailchimp', function(){

      include('templates/rss.php');

    } );

   } );

   function turn_off_feed_caching( $feed ) {
    $feed->enable_cache( false );
}
add_action( 'wp_feed_options', 'turn_off_feed_caching' );

add_filter('wp_feed_cache_transient_lifetime', function () {
  return 900;
});
