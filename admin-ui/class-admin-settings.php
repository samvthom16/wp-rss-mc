<?php

namespace WP_RSS_MC;

class ADMIN_SETTINGS extends BASE{

  var $categories;
  var $feedlyAPIKey;

  function __construct(){
		$this->setNavigationTabs();
		add_action( 'admin_menu', [$this, 'registerMenu'] );


    $option = get_option( 'wp_rss_mc_settings' );

    $categories = array();
    if( isset( $option['categories'] ) ){
      $categories = explode( "\r\n", trim( $option['categories'] ) );
    }
    $this->setCategories( $categories );
    
    $this->setFeedlyAPIKey( isset( $option['feedlyAPIKey'] ) ? $option['feedlyAPIKey'] : '' );

	}

  function setFeedlyAPIKey( $feedlyAPIKey ){ $this->feedlyAPIKey = $feedlyAPIKey; }
  function getFeedlyAPIKey(){ return $this->feedlyAPIKey; }

  function setCategories( $categories ){ $this->categories = $categories; }
  function getCategories(){ return $this->categories; }


	/**
	 * Callback function for registering submenu
	 */
	public function registerMenu(){
		add_submenu_page(
			'rssmcfeeds',
			'Settings',
      'Settings',
      'manage_options',
      'rssmcfeeds_settings',
      [$this, 'settingsTemplateCallback']
	   );
	}


	/**
	 * Initialize options for Tabbed Navigation.
	 * Update this attribute if new tab needs to be added
	 * Match the 'section-page' value to 'page-slug' value of section-settings-attributes
	 */
	public function setNavigationTabs(){
		$this->navigationTabs = array(
      array(
        'slug'          => 'settings',
        'title'         => 'Settings',
        'section-page'  => 'rssmcfeeds_settings_section'
      )
    );
	}


	/*
	* Returns array config for TabbedNavigation
	*/
	public function getNavigationTabs(){ return $this->navigationTabs; }

	public function settingsTemplateCallback(){
	?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<?php
		  	$navigation_tabs = $this->getNavigationTabs();

				// CHECK IF ACTIVE TAB IS PASSED IN THE URL
				// OR ELSE THE SLUG OF THE FIRST TAB
		  	$active_tab = '';
				if( isset( $_GET['tab'] ) ){ $active_tab = $_GET['tab']; }
				elseif( count( $navigation_tabs ) ){
					$active_tab = $navigation_tabs[0]['slug'];
				}
	    ?>

		  <h2 class="nav-tab-wrapper">
			<?php
				foreach ($navigation_tabs as $tab) {
					$active_class = ($tab['slug'] == $active_tab) ? 'nav-tab-active' : '';

					$page = $_GET['page'];
					$tab_slug = $tab['slug'];
					$tab_title = $tab['title'];

					echo "<a href='?page=$page&tab=$tab_slug' class='nav-tab $active_class'>$tab_title</a>";
				}
			?>
		  </h2>


			<?php
				foreach ($navigation_tabs as $tab) {
					if( $active_tab == $tab['slug'] ) {
            include( 'templates/' . $tab['slug'] . '.php' );
          }
				}


			?>

		</div>
    <?php
	}





}


ADMIN_SETTINGS::getInstance();
