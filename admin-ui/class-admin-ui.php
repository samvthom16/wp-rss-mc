<?php

namespace WP_RSS_MC;

class ADMIN_UI extends BASE{

  function __construct(){

    add_action( 'admin_menu', array( $this, 'adminMenu' ) );

    /* ENQUEUE SCRIPTS ON ADMIN DASHBOARD */
		add_action( 'admin_enqueue_scripts', array( $this, 'assets') );

    add_action( 'wp_ajax_wp_rss_mc', function(){

      if( isset( $_GET['feedly'] ) && 'stream' == $_GET['feedly'] ){

        if( isset( $_GET['stream_id'] ) ){

          //echo $_GET['stream_id'];

          $feedly = FEEDLY_API::getInstance();

          $data = $feedly->getStream( $_GET['stream_id'] );

          wp_send_json( $data );

        }

      }

      wp_die();
    } );

	}

  function adminMenu(){
		add_menu_page( "RSS MC Feeds", "RSS MC Feeds", "manage_options", "rssmcfeeds", array( $this, 'displayMenuPage' ), 'dashicons-admin-links', 1 );
	}

	function displayMenuPage( $r ){
		include( 'templates/admin.php' );
	}

  function assets( $hook ) {


		if( 'toplevel_page_rssmcfeeds' == $hook ){

      /*
			wp_enqueue_style( 'tui-calendar', plugins_url( 'InPursuit/dist/css/tui-calendar.min.css' ), array(), INPURSUIT_VERSION );

			// CSS FOR CHOROPLETH MAP
			wp_enqueue_style( 'choropleth', plugins_url( 'InPursuit/dist/css/choropleth.css' ), array(), INPURSUIT_VERSION );

			wp_enqueue_style( 'inpursuit-dashboard', plugins_url( 'InPursuit/dist/css/dashboard.css' ), array(), INPURSUIT_VERSION );

			wp_enqueue_script( 'vue-related', plugins_url( 'InPursuit/dist/js/vue-related.js' ), array(), null, true );



			wp_localize_script( 'inpursuit-app', 'inpursuitSettings', array(
    		'root' 	=> esc_url_raw( rest_url() ),
    		'nonce' => wp_create_nonce( 'wp_rest' )
			) );
      */

      wp_enqueue_script( 'wp-rss-mc', plugins_url( 'wp-rss-mc/assets/js/admin.js' ), array( 'jquery' ), '1.0.1', true );

		}
	}

}

ADMIN_UI::getInstance();
