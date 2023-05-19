<?php
   /*
   Plugin Name: RSS Connector For Mailchimp
   Plugin URI:
   Description: A plugin to output RSS feed that Mailchimp can use
   Version: 1.0
   Author: Samuel Thomas
   Author URI:
   */

   add_action('init', function(){

    add_feed('mailchimp', function(){

      include('templates/rss.php');

    } );

   } );
