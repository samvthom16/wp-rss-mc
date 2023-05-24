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
